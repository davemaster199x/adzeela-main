@extends('layouts.app')

@section('content')
<section class="bg-account-pages">
    <div class="container">
        <div class="row login-container">
            <div class="col-7" style="padding:0;">
                <div class="wrapper-page">
                    <div class="account-pages">
                        <div class="account-box" style="padding: 60px 130px 50px 50px;margin:0;">
                            <div class="account-logo-box mb-5">
                                <h2 class="text-center">
                                    <div class="h2 font-w600 push-30-t push-5 center">
                                        {{ HTML::image('img/cso-dark-logo.png', 'CSO Logo', array('style' => 'display:block;width:50%')) }}
                                    </div>
                                </h2>
                            </div>
                            <div class="account-content">
                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send Password Reset Link') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <p class="text-muted mb-0">Don't have an account? <a href="{{ route('register') }}" class="text-dark ml-1"><b>Sign Up</b></a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-5" style="padding:0;">
                <div class="wrapper-page">
                    <div class="account-pages">
                        <div class="account-box" style="padding: 0 130px 50px 50px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
