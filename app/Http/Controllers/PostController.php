<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Group;
use App\Models\Image;
use App\Models\User;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{

    public static function areFriends(User $user1, User $user2)
    {
        return DB::table('friend_request')
            ->where('id_user_sender', $user1->id)
            ->where('id_user_receiver', $user2->id)->where('acceptance_status', 'Accepted')->exists() ||
            DB::table('friend_request')
            ->where('id_user_sender', $user2->id)
            ->where('id_user_receiver', $user1->id)->where('acceptance_status', 'Accepted')->exists();
    }

    public function show($id)
    {
        // TODO: use id to get post from database
        $post   = Post::withCount('likes', 'comments')->find($id);

        if ($post == null)
            return view('pages.404');

        // policy, nr_comments_post
        if (!$post->owner->visibility) {
            $this->authorize('view', $post);
        }
        return view('pages.post', ['post' => $post]);
    }

    public function feed(Request $request)
    {
        $posts = [];

        if ($request->route('type_feed') === "for_you") {
            //$this->authorize('feed', $posts);
            $posts = $this->feed_for_you();
        } else if ($request->route('type_feed') === "friends") {
            //$this->authorize('feed', $posts);
            $posts = $this->feed_friends();
        } else if ($request->route('type_feed') === "groups") {
            //$this->authorize('feed', $posts);
            $posts = $this->feed_groups();
        } else if ($request->route('type_feed') === "viral") {
            $posts = $this->feed_viral();
        }


        // TODO: pass the current log in user to js in order to know if the post is theirs or not

        $posts = $posts->limit(20)->get();

        foreach ($posts as $post) {
            $post->images = Image::select('path')->where('id_post', $post->id)->get();
            if ($post->owner === Auth::user()->username) {
                $post->isOwner = true;
            } else {
                $post->isOwner = false;
            }

            $post->hasLiked = false;
            $like = Like::where('id_post', $post->id)->where('id_user', Auth::user()->id)->get();
            if ($like) {
                $post->hasLiked = true;
            }
            
            if (Auth::check()) {
                $post->auth = Auth::user()->id;
            } else {
                $posts->auth = 0;
            }

        }

        return json_encode($posts);
    }


    public function create(Request $request)
    {
        DB::beginTransaction();
        $post = new Post();
        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        $out->writeln($request->input('text'));
        if ($request->input('group_name') != null) {
            $post->id_group = Group::where('name', $request->input('group_name'))->first()->id;
        }
        //TODO
        $this->authorize('create', $post);

        $post->text = $request->input('text');
        $post->id_poster = Auth::user()->id;

        $post->save();

        $this->upload_img($request, $post);

        DB::commit();
    }

    public function upload_img(Request $request, Post $post)
    {
        if ($request->hasFile('photos')) {
            $i = 0;
            foreach ($request->photos as $imagefile) {
                $image = new Image;
                $path = 'image/img' . $post->id . '_' . $i . '.jpg';
                $image->path = $path;
                $image->id_post = $post->id;
                $image->save();
                try {
                    $imagefile->move(public_path('image/'), 'img' . $post->id . '_' . $i . '.jpg');
                } catch (Exception $e) {
                    DB::rollBack();
                }
                $i++;
            }
        }
    }

    public function delete($id)
    {
        $post = Post::find($id);
        $this->authorize('delete', $post);
        DB::table('post')->where('id', $id)->delete();
        return $post;
    }

    public function edit(Request $request, $id)
    {

        DB::beginTransaction();

        $post = Post::find($id);

        $this->authorize('update', $post);

        $post->text = $request->input('text');

        File::delete($post->images->pluck('path')->toArray());
        $post->images()->delete();
        $post->save();

        $this->upload_img($request, $post);

        DB::commit();
    }

    private function feed_friends()
    {

        if (!Auth::check()) {
            return response()->json(['Please login' => 401]);
        }

        $posts = Post::join('user', 'user.id', '=', 'post.id_poster')
            ->with('images')
            ->whereIn('id_poster', function ($query) {
                $id = Auth::user()->id;
                $query1 = DB::table('friend_request')
                    ->selectRaw('id_user_sender as friend')
                    ->from('friend_request')
                    ->where('id_user_receiver', $id)
                    ->where('acceptance_status', 'Accepted');

                $query->select('id_user_receiver as friend')
                    ->from('friend_request')
                    ->where('id_user_sender', $id)
                    ->where('acceptance_status', 'Accepted')
                    ->union($query1);
            })
            ->select('post.id', 'post.text', 'post_date', 'username as owner', 'photo')
            ->withCount('likes', 'comments');

        return $posts;
    }

    private function feed_groups()
    {
        if (!Auth::check()) {
            return response()->json(['Please login' => 401]);
        }

        $posts = Post::whereIn('id_group', function ($query) {
            $id = Auth::user()->id;
            $query->select('id_group')
                ->from('group_join_request')
                ->where('id_user', $id)
                ->where('acceptance_status', 'Accepted');
            })
            ->join('user', 'user.id', '=', 'post.id_poster')
            ->select('post.id', 'post.text', 'post_date', 'username as owner', 'photo')
            ->withCount('likes', 'comments');

        return $posts;
    }

    private function feed_viral()
    {  
        
        $posts_filtered = Post::join('user', 'user.id', '=', 'post.id_poster')
            ->join('like_post', 'like_post.id_post', '=', 'post.id')
            ->where('visibility', true)
            ->select('post.id', 'post.text', 'post_date', 'username as owner', 'photo', DB::raw('count(like_post.id_user) as likes_count'))
            ->withCount('comments')
            ->groupBy('post.id', 'user.id');

        $posts = DB::table(DB::raw("({$posts_filtered->toSql()}) as sub"))
            ->mergeBindings($posts_filtered->getQuery()) // you need to get underlying Query Builder
            ->selectRaw(' *, (likes_count /EXTRACT(epoch FROM (CURRENT_DATE - post_date))) as ranking')
            ->orderBy('ranking', 'desc');
    
            

        //->join('image', 'image.id_post', '=', 'post.id')
        //, string_agg (path, ',') image,
        // string_agg(path, ',') as images

        return $posts;
    }

    private function feed_for_you()
    {
        if (!Auth::check()) {
            return response()->json(['Please login' => 401]);
        }

        $posts_filtered_groups = $this->feed_groups();
        $posts_groups = DB::table(DB::raw("({$posts_filtered_groups->toSql()}) as sub"))
            ->mergeBindings($posts_filtered_groups->getQuery()) // you need to get underlying Query Builder
            ->selectRaw(' *, (likes_count /EXTRACT(epoch FROM (CURRENT_DATE - post_date))) as ranking');

        $posts_filtered_friends = $this->feed_friends();
        $posts_friends = DB::table(DB::raw("({$posts_filtered_friends->toSql()}) as sub"))
            ->mergeBindings($posts_filtered_friends->getQuery()) // you need to get underlying Query Builder
            ->selectRaw(' *, (likes_count /EXTRACT(epoch FROM (CURRENT_DATE - post_date))) as ranking');

        $posts = $this->feed_viral()
            ->union($posts_groups)
            ->union($posts_friends)
            ->distinct()
            ->orderBy('ranking', 'desc');

        return $posts;
    }
}
