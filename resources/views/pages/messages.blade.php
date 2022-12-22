@extends('layouts.app')

@section('content')
    <div id="message_frame" class="card">
        @if ($sender != null)
            <div class="message_head card-header text-bg-primary">
                <a class="white_span_a" href="/profile/{{ $sender->username }}" id='sms_rcv' data-id="{{ $sender->id }}">
                    <img id="sms_photo" src="/{{ $sender->photo }}" alt="" width="50" class="me-4 rounded-circle">
                    <span>{{ $sender->username }}</span>
                </a>
            </div>

            @include('partials.messages_list')

            <div class="card-footer text-bg-light d-flex ">
                <input type="text" id="sms_input" class="form-control me-5" placeholder="Type something...">
                <a href="#" id="sms_send_btn">
                    <i class="fa-solid fa-paper-plane"></i>
                </a>
            </div>
        @else
            <img src="/Illustration 18.png" width="50%">
        @endif

    </div>
@endsection

@section('rightbar')
    @include('partials.sidebar.messages_sidebar')
@endsection
