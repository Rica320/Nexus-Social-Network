<div aria-live="polite" aria-atomic="true" class="l_navbar show flex-column flex-shrink-0 p-3 bg-light"
    id="notifications_container">
</div>
<div id="leftbar" class="flex-column flex-shrink-0 p-3 bg-light">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">

        <span class="fs-4">Home</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auwidth: 8emto">

        <a href="/home" class=" btn mb-3 d-flex align-items-center justify-content-around">
            <i class="fa-solid fa-house fa-2x"></i>
            <span style="width: 8em;font-size:1.2em">Home</span>
        </a>

        @auth

            <a href={{ url('/user/friends/requests') }} class="btn mb-3 d-flex align-items-center justify-content-around"
                aria-current="page">
                <i class="fa-solid fa-user-group fa-2x"></i>
                <span style="width: 8em;font-size:1.2em">Friends Requests</span>

            </a>

            <a href="" class=" btn mb-3 drop_my_group d-flex align-items-center justify-content-around"
                aria-current="page">
                <i class="fa-solid fa-people-group fa-2x"></i>
                <span style="width: 8em;font-size:1.2em">My Groups</span>

            </a>

            <a href="" class=" btn mb-3 d-flex align-items-center justify-content-around" aria-current="page"
                id="notification_icon">
                <i class="fa-solid fa-bell fa-2x"></i>
                <span class="badge rounded-pill badge-notification bg-danger" hidden>1</span>

                <span style="width: 8em;font-size:1.2em">Notifications</span>
            </a>

            @include('partials.participating_groups')

            <a href={{ url('/messages/sender_username') }}
                class=" btn mb-3 d-flex align-items-center justify-content-around">
                <i class="fa-solid fa-envelope fa-2x"></i>
                <span class="badge rounded-pill badge-notification bg-danger" hidden>1</span>

                <span style="width: 8em;font-size:1.2em">Messages</span>
            </a>

        @endauth

        @auth
            <button id="popup_btn_post" class="mt-5 make_post_popup form_button btn btn-primary enc" type="submit">
                <span style="font-size:1.7em" class="me-4">Post</span>
                <i class="fa-regular fa-square-plus fa-2x"></i>

            </button>

            @if (Auth::user()->isAdmin)
                <a href="/admin" class=" btn btn-outline-primary mt-3 mb-3 enc">Admin Console</a>
                <a href="/admin/statistics" class=" btn btn-outline-primary mt-3 mb-3 enc">Admin Stats</a>
            @endif
        @endauth


        @guest
            <hr class="mt-4">

            <h3>Your not logged in!</h3>
            <p>Create an account to access most features</p>

            <a href={{ url('/about') }} class=" btn btn-outline-primary mb-3">About</a>
            <a href={{ url('/contacts') }} class=" btn btn-outline-primary mb-3">Contacts </a>
            <a href={{ url('/features') }} class=" btn btn-outline-primary mb-3">Features</a>
        @endguest


    </ul>
</div>



<div id="small_leftbar" class=" flex-shrink-0 p-3 bg-light">

    <ul class="d-flex nav nav-pills mb-auto align-items-center justify-content-around">

        <a href="/home" class=" btn btn-outline-primary">Home </a>

        @auth
            <a href="" class=" btn btn-outline-primary drop_my_group" aria-current="page">My Groups</a>
            @include('partials.participating_groups')

            <a href="#" id="popup_btn_post" class=" btn btn-primary">Post</a>

            <a href={{ url('/messages/sender_username') }} class=" btn btn-outline-primary">Messages</a>

            @if (Auth::user()->isAdmin)
                <a href="/admin" class="btn btn-outline-primary">Admin Console</a>
            @endif
        @endauth


        @guest
            <a href={{ url('/about') }} class=" btn btn-outline-primary">About</a>
            <a href={{ url('/contacts') }} class=" btn btn-outline-primary">Contacts </a>
            <a href={{ url('/features') }} class=" btn btn-outline-primary">Features</a>
        @endguest


    </ul>
</div>
