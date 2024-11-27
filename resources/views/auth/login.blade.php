@extends('layouts.app')

@section('content')
<section class="bg-account-pages">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-sm-10 left_container">
                <div class="wrapper-page form-container">
                    <div class="account-pages">
                        <div class="account-box">
                            <div class="account-logo-box text-center">
                                <h2>Welcome back!</h2>
                            </div>
                            <div class="account-content">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email" class="font-weight-medium">Username</label>
                                        <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" id="email" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="font-weight-medium">Password</label>
                                        <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" type="password" required id="password">
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group text-center mt-4">
                                        <button class="btn btn-block btn-primary" type="submit">Login</button>
                                    </div>
                                </form>
                                <div class="row">
                                    <div class="col-12 text-center">
                                        <p class="font-20">Don't have an account? <a href="{{ route('register') }}" class="ml-1"><b>Sign Up</b></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="account-box-bottom text-center">
                            <h3>Transform your advertising </br> campaigns <span class="text-primary">from ordinary to </br>extraordinary</span> with Adzeela!</h3>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-2 right_container mt-4 mt-lg-0">
                <div class="wrapper-background">
                    {{ HTML::image('img/login-banner.svg', 'Player', ['class' => 'img-fluid']) }}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
