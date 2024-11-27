@extends('layouts.app')

@section('content')
<section class="bg-account-pages">
    <div class="container">
        <div class="row">
            <div class="col-5">
                <div class="wrapper-page form-container">
                    <div class="account-pages">
                        <div class="account-box">
                            <div class="account-logo-box">
                                <h2 class="text-center">
                                    {{ HTML::image('img/logo.svg', 'Logo', array('style' => 'width:50%')) }}
                                </h2>
                            </div>
                            <div class="account-content">
                                <form method="POST" action="{{ route('register') }}" class="register-form-container">
                                    @csrf

                                    <div class="form-group">
                                        <label for="username" class="col-form-label text-md-right">{{ __('Username') }}</label>
                                        <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                    </div>

                                    <div class="form-group">
                                        <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    </div>

                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-md-right">{{ __('Name') }}</label>
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm" class="col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <div class="form-group mb-0 mt-4">
                                        <div class="">
                                            <button type="submit" class="btn btn-primary register-btn">
                                                {{ __('Register') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <p class="text-muted mb-0 text-center">Already have an account? <a href="{{ route('login') }}" class="text-primary ml-1"><b>Log In</b></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7" style="padding-left: 100px;">
                <div class="wrapper-page content-container">
                    <h2 class="text-primary header">Want to be an ADZilla?</h2>
                    <p class="text-primary content">Advertising is vital in modern business. As an advertiser, your goal is to create captivating campaigns that engage audiences and boost sales.</p>
                    <div class="player-container mt-2 text-center">
                        {{ HTML::image('img/login-player.svg', 'Player', array('style' => 'width:80%;')) }}
                    </div>
                    <h3 class="text-primary text-center mt-4">we are with them...</h3>
                    <div class="logo-container mt-2 text-center">
                        {{ HTML::image('img/login-logo.svg', 'Logo', array()) }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
