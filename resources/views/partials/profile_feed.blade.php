<div class="list-group list-group-checkable form-check d-flex p-3 flex justify-content-between text-bg-light"
    id="feed_filter">

    <input class="list-group-item-check pe-none" onclick="updateFeed('Posts')" type="radio" name="feed_filter"
        id="feed_radio_posts" value="" checked="">
    <label class="list-group-item rounded-3 py-3" for="feed_radio_posts">
        Posts
    </label>

    <input class="list-group-item-check pe-none" onclick="updateFeed('Comments')" type="radio" name="feed_filter"
        id="feed_radio_comments" value="">
    <label class="list-group-item rounded-3 py-3" for="feed_radio_comments">
        Comments
    </label>

    <input class="list-group-item-check pe-none" onclick="updateFeed('Groups')" type="radio" name="feed_filter"
        id="feed_radio_groups" value="">
    <label class="list-group-item rounded-3 py-3" for="feed_radio_groups">
        Groups
    </label>

    <input class="list-group-item-check pe-none" onclick="updateFeed('Likes')" type="radio" name="feed_filter"
        id="feed_radio_likes" value="">
    <label class="list-group-item rounded-3 py-3" for="feed_radio_likes">
        Likes
    </label>

</div>


<div id="timeline">
    @foreach ($user->posts as $post)
        @include('partials.post_item', ['post' => $post])
    @endforeach
</div>

<!-- Edit Profile Popup -->
@include('partials.edit_profile_popup', ['user' => $user])
