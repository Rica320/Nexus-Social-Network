<div class="container mt-5 mb-5 post_item " id="post_main_page">
    <div class="row d-flex align-items-center justify-content-center ">
        <div>
            <div class="card post_card p-0">

                <div class="card-header d-flex justify-content-between p-2 px-3">

                    <a href={{ url('/profile/' . $post->owner->username) }}
                        class="text-decoration-none d-flex flex-row align-items-center">
                        <img src="{{ asset($post->owner->photo) }}" width="60" class="rounded-circle me-3">
                        <strong class="font-weight-bold">{{ $post->owner->username }}</strong>
                    </a>

                    <small class="me-5">{{ $post->post_date }}</small>

                    <div class="dropdown">
                        <button class="btn dropdownPostButton" type="button">&vellip;</button>
                        <div class="dropdown_menu" style="z-index: 200000" hidden>
                            <a class="dropdown-item" href="{{ url('/profile/' . $post->owner->username) }}">Go to
                                Profile</a>

                            @auth
                                @if (Auth::user()->id == $post->owner->id)
                                    @isset($showComments)
                                        <a class="dropdown-item" id="popup_btn_post_edit" href="#">Edit
                                            post</a>
                                    @else
                                        <a class="dropdown-item" href="/post/{{ $post->id }}">See
                                            Post</a>
                                    @endisset
                                @else
                                    @isset($showComments)
                                        <a href="#!" class="dropdown-item" id="popup_btn_report_post_create">Report
                                            Post </a>
                                    @endisset
                                    <a class="dropdown-item" href="{{ url('/messages/' . $post->owner->username) }}">Send
                                        Message</a>
                                @endif
                            @endauth
                        </div>
                    </div>

                </div>


                <a href="/post/{{ $post->id }}" class="text-decoration-none" style="color: black">
                    @if (!$post->images->isEmpty())
                        @include('partials.post_carousel_image')
                    @endif


                    <div>
                        <p class="text-justify p-2" style="margin-bottom:0em ">{{ $post->text }}</p>

                        <div>
                            @foreach ($post->topics as $post_topic)
                                <a href="/search/{{ $post_topic->topic->topic }}"
                                    class="btn btn-primary me-2 mb-3 ms-2">#{{ $post_topic->topic->topic }}</a>
                            @endforeach
                        </div>
                    </div>

                </a>



                <div class="card-footer d-flex justify-content-evenly pb-3">

                    @auth

                        <?php
                        $userLiked = false;
                        foreach ($post->likes as $like) {
                            if (Auth::user()->id == $like->id_user) {
                                $userLiked = true;
                            }
                        }
                        ?>

                        <a class="text-decoration-none " data-uid={{ Auth::user()->id }}
                            onclick="sendLikePostRequest(event)" data-id={{ $post->id }}
                            data-liked="{{ $userLiked }}" href="#!">

                            <span class="me-3 text-dark" style="font-size:1.2em;">{{ $post->likes->count() }}</span>


                            @if ($userLiked)
                                <span style="font-size: 1.3em">
                                    <i class="fa-solid fa-heart text-danger"></i>
                                </span>
                            @else
                                <span style="font-size: 1.3em">
                                    <i class="fa-regular fa-heart"></i>
                                </span>
                            @endif
                        </a>


                        <a class="ms-5 text-decoration-none" href="/post/{{ $post->id }}">

                            <span class="mt-1 me-3 text-dark" style="font-size:1.2em">{{ sizeof($post->comments) }}</span>

                            <span class="me-3" style="font-size: 1.3em">
                                <i class="ms-3 fa-regular fa-comment-dots"></i>
                            </span>


                        </a>
                    @else
                        <a class="text-decoration-none">
                            <span style="font-size: 1.3em">
                                <i class="fa-regular fa-heart"></i>
                            </span>
                        </a>

                        <a class="text-decoration-none">
                            <span style="font-size: 1.3em">
                                <i class="ms-3 fa-regular fa-comment-dots"></i>
                            </span>
                        @endauth



                </div>


                @isset($showComments)
                    @auth
                        <div class="card_footer form-control d-flex align-items-center">
                            <input type="text" name="comment_post" data-uid={{ Auth::user()->id }}
                                data-pid={{ $post->id }} id="comment_post_input" class="me-2 form-control mt-3 mb-2"
                                placeholder="Make a comment">
                            <a href="#!" class="btn btn-primary" id="comment_post_send">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                    class="bi bi-send" viewBox="0 0 16 16">
                                    <path
                                        d="M15.854.146a.5.5 0 0 1 .11.54l-5.819 14.547a.75.75 0 0 1-1.329.124l-3.178-4.995L.643 7.184a.75.75 0 0 1 .124-1.33L15.314.037a.5.5 0 0 1 .54.11ZM6.636 10.07l2.761 4.338L14.13 2.576 6.636 10.07Zm6.787-8.201L1.591 6.602l4.339 2.76 7.494-7.493Z" />
                                </svg>
                            </a>
                        </div>
                    @endauth
                @endisset

            </div>

        </div>
    </div>
</div>
