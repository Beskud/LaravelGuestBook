@extends('template')

@section('content')
    @if (session()->get('auth'))
        {{ header('Location: /authorization') }}
    @endif

    <header>
        <div style='display: flex;
    align-items: center;
    justify-content: space-between;margin:0px 15px;'>
            <img src="https://www.veryicon.com/download/png/internet--web/iview-3-x-icons/logo-apple?s=256"
                style="width: 52px;">
            <div
                style="display: flex;
            align-items: center;
            color: teal;
            font-family: monospace;
            margin-left: 25%;">
                <h5 style="margin:0">

                    @if (session()->get('auth'))
                        {{ session()->get('user_data')['username'] }}
                    @else
                        <a href="/authorization"
                            style="
                                                margin-left: 20%;
                                                text-decoration: none;
                                                font-size: xx-large;
                                                font-family: monospace;
                                                color: teal;">Authorization</a>
                        <a href="/registration"
                            style="  
                                                margin-left: 10%;
                                                text-decoration: none;
                                                font-size: xx-large;
                                                font-family: monospace;
                                                color: teal;">Registration</a>
                    @endif
                </h5>
                <button class="circle" id="open-model-btn">
                    {{-- @dd(session()->get('user_data')['avatar_id']) --}}
                    <img src="/images/{{ session()->get('user_data')['avatar_id'] }}.png" class="none-icon">
                </button>

                <button type="button" class="btn btn-warning" style="margin-left: 10px;" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">
                    Chose your avatar
                </button>
                <a href="/logout" class="btn btn-outline-danger" style="margin-left:     10px;">
                    Logout
                </a>
            </div>
        </div>
    </header>
    <hr>
    <div id="comment_container">
    </div>
    <div>
        <p style="margin-left: 5px;">
            <label>Комментарий:</label>
            <br />
            <textarea id="text" name="text_comment" cols="30" rows="50"
                style="width: 475px;height: 110px;border-color:black" required></textarea>
            <br />

            <button id="button-js" type="button" class="btn btn-outline-info"> Отправить</button>
    </div>
    <hr>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Select avatar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex justify-content-between">
                        <img class="avatar-item p-2" id="4" src="/images/4.png" alt="">
                        <img class="avatar-item p-2" id="5" src="/images/5.png" alt="">
                        <img class="avatar-item p-2" id="6" src="/images/6.png" alt="">
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
@endsection
