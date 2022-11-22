<nav id="rightbar" class="text-bg-light">
    <h2>Reports</h2>
    <hr>

    <h3>Statistics</h3>


    <ul>
        <li>{{$statistics['posts_c']}} Posts</li>
        <li>{{$statistics['users_c']}} Users</li>
        <li>{{$statistics['groups_c']}} Groups</li>
        <li>{{$statistics['comments_c']}} Comments</li>
        <li>{{$statistics['likes_c']}} Likes</li>
    </ul>



    </div>

    <h3>Your Last Reports</h3>
    <div class="list-group align-items-center d-flex mb-5 mt-4">

        <div class="list-group-item">
            <img class="me-3" src="{{ asset('user/user.png')}}" alt="user_avatar" width="50">
            <a class="me-3" href={{ url('/profile/username') }}>Username</a>
            <a href="#" class=" btn btn-danger">INF</a>
        </div>

        <div class="list-group-item">
            <img class="me-3" src="{{ asset('user/user.png')}}" alt="user_avatar" width="50">
            <a class="me-3" href={{ url('/profile/username') }}>Username</a>
            <a href="#" class=" btn btn-warning">07d</a>
        </div>

        <div class="list-group-item">
            <img class="me-3" src="{{ asset('user/user.png')}}" alt="user_avatar" width="50">
            <a class="me-3" href={{ url('/profile/username') }}>Username</a>
            <a href="#" class=" btn btn-warning">30d</a>
        </div>

        <div class="list-group-item">
            <img class="me-3" src="{{ asset('user/user.png')}}" alt="user_avatar" width="50">
            <a class="me-3" href={{ url('/profile/username') }}>Username</a>
            <a href="#" class=" btn btn-success">REJ</a>
        </div>

        <div class="list-group-item">
            <img class="me-3" src="{{ asset('user/user.png')}}" alt="user_avatar" width="50">
            <a class="me-3" href={{ url('/profile/username') }}>Username</a>
            <a href="#" class=" btn btn-warning">07d</a>
        </div>


        <div class="list-group-item">
            <img class="me-3" src="{{ asset('user/user.png')}}" alt="user_avatar" width="50">
            <a class="me-3" href={{ url('/profile/username') }}>Username</a>
            <a href="#" class=" btn btn-success">REJ</a>
        </div>

    </div>

    <a href="#" class="btn">See Other Reports</a>



</nav>
