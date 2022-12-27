<div aria-live="polite" aria-atomic="true" class="l_navbar show flex-column flex-shrink-0 p-3 bg-light overflow-auto"
    id="notifications_container" style="max-height: 95vh">
</div>
<div id="leftbar" class="flex-column flex-shrink-0 p-3 bg-light">

    <ul class="nav nav-pills flex-column mb-auwidth: 8emto">

        <a href="/home" class=" btn mb-3 mt-4 d-flex align-items-center justify-content-around">
            <i class="fa-solid fa-house fa-2x"></i>
            <span style="width: 8em;font-size:1.2em" class="enc">Home</span>
        </a>

        @auth

            <a href={{ url('/user/friends/requests') }} class="btn mb-3 d-flex align-items-center justify-content-around"
                aria-current="page">
                <i class="fa-solid fa-user-group fa-2x"></i>
                <span style="width: 8em;font-size:1.2em" class="enc">Friends Requests</span>

            </a>

            <a href="/group_list/{{ Auth::user()->username }}"
                class=" btn mb-3 drop_my_group d-flex align-items-center justify-content-around" aria-current="page">
                <i class="fa-solid fa-people-group fa-2x"></i>
                <span style="width: 8em;font-size:1.2em" class="enc">My Groups</span>
            </a>

            <a href="" class="btn mb-3 d-flex align-items-center justify-content-around" aria-current="page"
                id="notification_icon">
                <span class="position-relative">
                    <i class="fa-solid fa-bell fa-2x"></i>
                    <span
                        class="position-absolute top-0 start-70 translate-middle badge rounded-pill badge-notification bg-danger"
                        id="notf_nr" hidden>1</span>
                </span>
                <span style="width: 8em;font-size:1.2em" class="enc">Notifications</span>
            </a>

            <a href={{ url('/messages/') }} class="btn mb-3 d-flex align-items-center justify-content-around">
                <span class="position-relative">
                    <i class="fa-solid fa-envelope fa-2x"></i>
                    <span
                        class="position-absolute top-0 start-70 translate-middle badge rounded-pill badge-notification bg-danger"
                        hidden>1</span>
                </span>
                <span style="width: 8em;font-size:1.2em" class="enc">Messages</span>
            </a>

            @if (Auth::user()->isAdmin)
                <a href="{{ url('/admin') }}"
                    class=" btn mt-2 mb-3 drop_my_group d-flex align-items-center justify-content-around"
                    aria-current="page">
                    <i class="fa-solid fa-sliders fa-2x"></i>
                    <span style="width: 8em;font-size:1.2em" class="enc">Admin Console</span>
                </a>
            @endif


            <button id="popup_btn_post" class="mt-5 make_post_popup form_button btn btn-primary enc" type="submit">
                <span style="font-size:1.7em" class="me-4">Post</span>
                <i class="fa-regular fa-square-plus fa-2x"></i>

            </button>


        @endauth

        @guest

            <a href="{{ url('/about') }}"
                class=" btn mt-3 mb-3 drop_my_group d-flex align-items-center justify-content-around" aria-current="page">
                <i class="fa-solid fa-info-circle fa-2x"></i>
                <span style="width: 8em;font-size:1.2em" class="enc">About</span>
            </a>

            <a href="{{ url('/contacts') }}"
                class=" btn mb-3 drop_my_group d-flex mt-3 align-items-center justify-content-around" aria-current="page">
                <i class="fa-solid fa-people-group fa-2x"></i>
                <span style="width: 8em;font-size:1.2em" class="enc">Contacts</span>
            </a>


            <a href="{{ url('/features') }}"
                class=" btn mt-3 mb-3 drop_my_group d-flex align-items-center justify-content-around" aria-current="page">
                <i class="fa-solid fa-lightbulb fa-2x"></i>
                <span style="width: 8em;font-size:1.2em" class="enc">Features</span>
            </a>


            <hr>

            <h3 class="mt-3 text-center">Your not logged in!</h3>
            <h5 class="mb-3 mt-3 text-center">Create an account to access most features</h5>
        @endguest


    </ul>
</div>



<div id="small_leftbar" class=" flex-shrink-0 bg-light pt-2">

    <ul class="d-flex nav nav-pills mb-auto align-items-center justify-content-around">


        @auth

            <a href="/home" class="btn">
                <i class="fa-solid fa-house fa-2x"></i>
                <p style="padding: 0;margin:0">Home</p>
            </a>

            <a href={{ url('/user/friends/requests') }} class="btn">
                <i class="fa-solid fa-user-group fa-2x"></i>
                <p style="padding: 0;margin:0;">Friend Requests</p>
            </a>

            <a href="/group_list/{{ Auth::user()->username }}" class="btn">
                <i class="fa-solid fa-people-group fa-2x"></i>
                <p style="padding: 0;margin:0;">My Groups</p>
            </a>


            <a href="{{ url('/notifications') }}" class="btn">
                <span class="position-relative">
                    <i class="fa-solid fa-bell fa-2x"></i>
                    <span
                        class="position-absolute top-0 start-70 translate-middle badge rounded-pill badge-notification bg-danger"
                        id="notf_nr2" hidden>1</span>
                </span>
                <p style="padding: 0;margin:0;">Notifications</p>
            </a>

            <a href={{ url('/messages') }} class="btn">
                <span class="position-relative">
                    <i class="fa-solid fa-envelope fa-2x"></i>
                    <span
                        class="position-absolute top-0 start-70 translate-middle badge rounded-pill badge-notification bg-danger"
                        hidden>1</span>
                </span>
                <p style="padding: 0;margin:0;">Messages</p>
            </a>

            @if (Auth::user()->isAdmin)
                <a href="{{ url('/admin') }}" class=" btn" aria-current="page">
                    <span class="position-relative">
                        <i class="fa-solid fa-sliders fa-2x"></i>
                    </span>
                    <p style="padding: 0;margin:0;">Admin Console</p>
                </a>
            @endif

            <a class="text-primary btn" aria-current="page" id="popup_btn_post">
                <span class="position-relative">
                    <i class="fa-regular fa-square-plus fa-2x"></i>
                </span>
                <p style="padding: 0;margin:0;">Post</p>
            </a>


        @endauth


        @guest

            <a href="/home" class="btn">
                <i class="fa-solid fa-house fa-2x"></i>
                <p style="padding: 0;margin:0">Home</p>
            </a>

            <a href={{ url('/about') }} class="btn">
                <i class="fa fa-info-circle fa-2x"></i>
                <p style="padding: 0;margin:0;">About</p>
            </a>

            <a href="{{ url('/contacts') }}" class="btn">
                <i class="fa-solid fa-people-group fa-2x"></i>
                <p style="padding: 0;margin:0;">Contacts</p>
            </a>

            <a href="{{ url('/features') }}" class="btn">
                <i class="fa-solid fa-lightbulb fa-2x"></i>
                <p style="padding: 0;margin:0;">Features</p>
            </a>
        @endguest


    </ul>
</div>
