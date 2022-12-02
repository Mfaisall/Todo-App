@extends('layout')

@section('Isal')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
<form method="POST" action="{{route('register.input')}}">
    <div class="container mt-5 ">

        <div class="row justify-content-center">
            <div class="col-5">
            <div class="">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-info">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @csrf
                <div class="login-box">
                    <h3>Register</h3>
                <div class="user-box">
                    <label for="exampleInputText" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="username" name="name">
                  </div>
                <div class="user-box">
                    <label for="exampleInputEmail" class="form-label">Email</label>
                    <input type="Email" class="form-control" id="username" name="email">
                  </div>
                  <div class="user-box">
                    <label for="exampleInputText" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                  </div>
                  <div class="user-box">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                  </div>
                  <button type="submit" class="btn btn-info">Submit</button>
                  <div class="sigUp justify-content-center">
                    <p class=" mt-3"><a href="{{route('index')}}" style="color :#fff">Login</a></p>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
@endsection