@extends('layouts.app')

@section('content')


    <h2 class="mt-5">User Report</h2>
    <div class="d-flex justify-content-center">


        <div class="mt-4 p-4 card text-bg-light" style="width:50%;max-width:35em">
            <h3 id="username"><a class="text-decoration-none"
                    href="/profile/{{ $user->username }}">{{ $user->username }}</a>
            </h3>
            <img class="profile_img rounded-circle" src="{{ asset($user->photo) }}" alt="" width="250">

            <div class="mt-1 mb-5 d-flex justify-content-evenly flex-wrap me-2">

                @if ($user->ban_date === null)
                    <a id="reject_all_reports" href="#!" class="btn btn-warning" data-userid="{{ $user->id }}">
                        <h5>Reject all reports</h5>
                    </a>
                    <div>
                        <a id="ban_user_btn" href="#!" class="mt-1 btn btn-danger">
                            <h5>Ban User</h5>
                        </a>
                        <select class="p-3" id="ban_time_select" data-userid="{{ $user->id }}">
                            <option selected value="1">7 days</option>
                            <option value="2">15 days</option>
                            <option value="3">30 days</option>
                            <option value="4">3 months</option>
                            <option value="5">6 months</option>
                            <option value="6">1 year</option>
                            <option value="7">Permanent</option>
                        </select>
                    </div>
                @else
                    <a id="unban_user_btn" href="#!" class="mt-1 btn btn-warning" data-userid="{{ $user->id }}">
                        <h5>Unban User</h5>
                    </a>
                @endif
            </div>

            <h3>Bio</h3>
            <p class="card-text">{{ $user->bio }}</p>
        </div>

        <div class="mt-4 p-4 card text-bg-light" style="width:50%;max-width:35em">
            <?php $ban_date = $user->ban_date ?? 'N/A'; ?>
            <h4>Information</h4>

            <div class="list-group align-items-center mb-3 mt-3">

                <div class="d-flex list-group-item w-100">
                    <p class="pt-3">{{ $statistics['post_num'] }} Posts</p>
                </div>

                <div class="d-flex list-group-item w-100">
                    <p class="pt-3">{{ $statistics['friends_num'] }} Friends</p>
                </div>

                <div class="d-flex list-group-item w-100">
                    <p class="pt-3">{{ $statistics['group_num'] }} Groups</p>
                </div>

                <div class="d-flex list-group-item w-100">
                    <p class="pt-3">{{ $statistics['like_comment_num'] + $statistics['like_post_num'] }}
                        Likes</p>
                </div>

                <div class="d-flex list-group-item w-100">
                    <p class="pt-3">{{ $statistics['comment_num'] }} Comments</p>
                </div>

            </div>

            <hr>
            <p>Birthdate: {{ $user->birthdate }}</p>
            <p>Email: {{ $user->email }}</p>
            <p>Banned until: {{ $ban_date }}</p>
        </div>


    </div>



    <div class="mt-4 d-flex justify-content-center">
        <h4 class="me-3">Pendent Reports</h4>
        <label class="switch">
            <input type="checkbox" id="report_toggle">
            <span class="slider round"></span>
        </label>
        <h4 class="ms-3">Past Reports</h4>
    </div>

    <div id="pendent_report_list" class="mt-5 text-bg-light p-4" style="margin:auto;max-width:50em">
        <h3 class="mb-3">Pendent Reports</h3>

        @if (count($reports) === 0)
            <p class="text-center">No pending reports to view</p>
        @endif

        @foreach ($reports as $report)
            <div class="card p-3 mb-4">
                <h5 class="mb-4">Report description:</h5>
                <p>{{ $report->description }}</p>
                <a href="#!" class="position-absolute btn btn-outline-danger reject_user_report_btn" style="width: 20%;right:2em"
                    data-reportid="{{ $report->id }}">Reject</a>


                <p><b>Made by: </b> <a class="text-decoration-none"
                        href="/profile/{{ $report->reporter->username }}">{{ $report->reporter->username }}</a> on
                    {{ $report->report_date }}</p>


                <h5 class="mt-3">Reported content:</h5>

                @if ($report->id_post === null)
                    @include('partials.comment_item', ['comment' => $report->comment])
                @else
                    @include('partials.post_item', ['post' => $report->post])
                @endif

            </div>
        @endforeach
    </div>


    <div id="past_report_list" hidden class="mt-5 text-bg-light p-4" style="margin:auto;max-width:50em">
        <h3 class="mb-3">Past Reports</h3>

        @if (count($decided_reports) === 0)
            <p class="text-center">No past reports to view</p>
        @endif

        @foreach ($decided_reports as $report)
            <div class="card p-3 mb-4">
                <h5 class="mb-4">Report description:</h5>
                <p>{{ $report->description }}</p>


                <p><b>Made by: </b> <a class="text-decoration-none"
                        href="/profile/{{ $report->reporter->username }}">{{ $report->reporter->username }}</a> on
                    {{ $report->report_date }}</p>

                <h5>Decision information:</h5>
                <ul>
                    <li>Decision: {{ $report->decision }}</li>
                    <li>Decision date: {{ $report->decision_date ?? 'N/A' }}</li>
                    <li>Decision made by: {{ $report->avaliator->username ?? 'N/A' }}</li>
                </ul>

                <h5 class="mt-3">Reported content:</h5>

                @if ($report->id_post === null)
                    @include('partials.comment_item', ['comment' => $report->comment])
                @else
                    @include('partials.post_item', ['post' => $report->post])
                @endif




            </div>
        @endforeach
    </div>
@endsection
