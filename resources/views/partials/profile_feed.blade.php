<div id="feed_filter">
    <label for="feed_radio_post">Posts</label>
    <input type="radio" name="feed_filter" id="feed_radio_post" checked>

    <label for="feed_radio_comment">Comments</label>
    <input type="radio" name="feed_filter" id="feed_radio_comment">

    <label for="feed_radio_group">Groups</label>
    <input type="radio" name="feed_filter" id="feed_radio_group">

    <label for="feed_radio_likes">Likes</label>
    <input type="radio" name="feed_filter" id="feed_radio_likes">
</div>



<div id="timeline">
    @foreach ($user->posts as $post)
        @include('partials.post_item', ['post' => $post])
    @endforeach

</div>
