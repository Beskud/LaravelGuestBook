@extends('template')

@section('content')
    

<div class="container">
    <form action="/authorization-action" method="POST">
        @csrf
        <h3 style="text-align: center; color: #ffff; font-weight: 700; font-size: 30px; font-family: 'Trebuchet MS';">Authorization</h3>
        <div class="position-registr">
            <input type="email" name="email" class="default-input-registration"
                style="-family: 'Trebuchet MS'; font-weight: 700" placeholder="email" required>
            <input type="password" name="password" class="default-input-autorization"
                style="font-family: 'Trebuchet MS';font-weight:700" placeholder="password" required>
            <div class="message">
            
                @if(session()->get('error'))
                    <div style="color: red">{{ session()->get('error') }} </div>
                @endif

            </div>
            <input id='click' type="submit" name="submitButton" class="registration-button">
            <br>
        </div>
    </form>
    <div class="position-registr">
        <a href="/registration" class="nav_livk" style="color: #ffff">Еще не зарегистрированы?</a>
    </div>
</div>
<script>
document.body.style = 'background-color: slategray;'
</script>
@endsection
