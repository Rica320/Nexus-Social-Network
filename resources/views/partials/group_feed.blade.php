<div id="timeline">

    <!-- TODO make posts for groups and make POST_ITEM receive the post correctly  -->
    @foreach ($group->posts as $post)
        @include('partials.post_item', ['post' => $post])
    @endforeach

</div>

@include('partials.make_post_popup', ['popup_id' => 'popup_show_group_post', 'group_name' => $group->name])
@include('partials.make_group_popup', ['group' => $group])
