@extends('layout')

@section('Isal')


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<form method="POST" action="{{route('login.auth')}}">
    @csrf
    @if (session('success'))
        <div class="alert alert-warning">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </ul>
    </div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-5">
                <div class="">
                    <div class="">
                        <div class="login text-center">
                           @if (Session::get('errorLogin'))
                            <div class="alert alert-warning">
                                {{ Session::get('errorLogin') }}
                            </div>
                            @endif
                            @if (Session::get('notAllowed'))
                            <div class="alert alert-warning">
                                {{ Session::get('notAllowed') }}
                            </div>
                            @endif
                            @if (Session::get('Success'))
                            <div class="alert alert-warning">
                                {{ Session::get('Success') }}
                            </div>
                            @endif

                        </div>
                    </div>
                    <div class="login-box">
                    <h3>Login</h3>
                        <div class="user-box">
                            <label for="exampleInputText" class="form-label">Username</label>
                            <input type="text" class="form-control" placeholder="" id="username" name="username">
                        </div>
                        <div class="user-box">
                            <label for="exampleInputPassword1" class="form-label" name="password">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                        </div>
                        <a href="#">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                         <button type="submit" class="btn" style="color : #fff">Login</button>
                        </a>
                         <div class="sigUp justify-content-center">
                            <p class="text-center mt-3" style="color : #fff">Belum memiliki akun?<a href="{{route('register-page')}}" style="color :#fff">register</a></p>
                        </div>
                    </div>
               </div>
            </div>
        </div>
    </div>
</form>
</body>
</html>
@endsection