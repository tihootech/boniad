<!DOCTYPE html>
<html lang="fa">
    <head>
        <meta charset="utf-8">
        <title> ورود به حساب کاربری </title>
        <link rel="stylesheet" href="{{asset('general/fonts.css')}}">
        <link rel="stylesheet" href="{{asset('general/green.css')}}">
    </head>
    <body>
        <div class="login-page">
            <div class="form">
                <h3> سامانه ارزیابی شعب بنیاد شهید استان کرمانشاه </h3>
                @include('includes.errors')
                <form class="login-form" method="post" action="{{route('login')}}">
                    @csrf
                    <input type="text" name="name" placeholder="نام کاربری"/>
                    <input type="password" name="password" placeholder="رمزعبور"/>
                    <button>ورود به حساب کاربری</button>
                </form>
            </div>
        </div>
    </body>
</html>
