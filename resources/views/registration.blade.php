@extends('template')

@section('content')
<div class="container">
    <form action="registration-action" method="POST">
        @csrf
        <h3 style="text-align: center; color: #ffff; font-weight: 700; font-size: 30px; font-family: 'Trebuchet MS';">
            Registration</h3>
        <div class="position-registr">
            <div>
                <input type="email" name="email" class="default-input-registration"
                    style="font-family: 'Trebuchet MS'; font-weight: 700" placeholder="email" required>

                    @if (session()->get('error.email'))
                        <div class="email-message">
                            {{ session()->get('error.email') }}
                        </div>
                    @endif

                <div>
                    <input type="text" name="username" class="default-input-registration"
                        style="font-family: 'Trebuchet MS';font-weight: 700" placeholder="username" required>

                    @if (session()->get('error.username'))
                        <div class="username-message">
                            {{ session()->get('error.username') }}
                        </div>
                    @endif

                </div>
                <input type="password" name="password" class="default-input-registration"
                    style="font-family: 'Trebuchet MS';font-weight:700" placeholder="password" required>

                    @if (session()->get('error.password'))
                        <div class="password-message">
                            {{ session()->get('error.password') }}
                        </div>
                    @endif

                <input type="password" name="confirmation_password" class="default-input-registration"
                    style="font-family: 'Trebuchet MS';font-weight: 700" placeholder="confirm password" required>

                    @if (session()->get('error.confirmation_password'))
                        <div class="confirmation-message">
                            {{ session()->get('error.confirmation_password') }}
                            {{ session()->get('error.check_email') }}
                        </div>
                    @endif

                <input id='click' type="submit" name="submitButton" class="registration-button">
            </div>
    </form>
    <br>
    <div class="position-registr">
        <a href="/authorization" class="nav_livk" style="color: #ffff";>Уже зарегистрированы?</a>
    </div>
</div>

@if (session()->get('error'))
    {{session_unset()}}
@endif

<script>
    document.body.style = 'background-color: slategray;'
</script>
@endsection
