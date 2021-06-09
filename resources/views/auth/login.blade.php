@extends('layouts.auth-app')

@section('title', 'Login')

@section('content')
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{asset('templates/auth')}}/images/signin-image.jpg" alt="sing up image"></figure>
                <a href="{{route('register')}}" class="signup-image-link">Belum punya akun? Registrasi sekarang</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Login</h2>
                <form method="POST" class="register-form" id="login-form" action="{{route('login')}}">
                    @csrf
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" />
                        @error('email')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password" />
                        @error('password')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in" />
                    </div>
                </form>
                <div class="social-login">
                    <a href="{{route('beranda')}}" class="signup-image-link">Kembali ke beranda</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
