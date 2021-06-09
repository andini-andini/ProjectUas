@extends('layouts.auth-app')

@section('title', 'Register')

@section('content')
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Register</h2>
                <form method="POST" class="register-form" id="register-form">
                    @csrf
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Your Name" value="{{old('name')}}" />
                        @error('name')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" value="{{old('email')}}" />
                        @error('email')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                        <input type="number" name="phone" id="phone" placeholder="Your Phone" value="{{old('phone')}}" />
                        @error('phone')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="address"><i class="zmdi zmdi-account"></i></label>
                        <input type="text" name="address" id="address" placeholder="Your address" />
                        @error('address')
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
                    <div class="form-group">
                        <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password" />
                        @error('password_confirmation')
                        <small style="color: red">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register" />
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{asset('templates/auth')}}/images/signup-image.jpg" alt="sing up image"></figure>
                <a href="{{route('login')}}" class="signup-image-link">Sudah punya akun? Login sekarang</a>
            </div>
        </div>
    </div>
</section>

@endsection
