@extends('layouts.auth')

@section('content')
<div class="wrapper-page">

    <div class="card">
        <div class="card-body">
            <h3 class="text-center m-0">
                <a href="index.html" class="logo logo-admin"><img src="{{ asset('images/logo.png') }}" height="30" alt="logo"></a>
            </h3>

            <div class="p-3">
                <form class="form-horizontal m-t-30" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input id="email" type="email" placeholder="Enter email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="userpassword">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required autocomplete="current-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group row{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <div class="col-6">
                            {!! app('captcha')->display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block">
                                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row m-t-20">
                        <div class="col-6">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="customControlInline" {{ old('remember') ? 'checked' : '' }}>
                                
                                <label class="custom-control-label" for="customControlInline">
                                    {{ __('Remember Me') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-6 text-right">
                            <button type="submit" class="btn btn-primary w-md waves-effect waves-light">
                                {{ __('Login') }}
                            </button>
                        </div>
                    </div>

                    <div class="form-group m-t-10 mb-0 row">
                        <div class="col-12 m-t-20">
                            @if (Route::has('password.request'))
                                <a class="text-muted" href="{{ route('password.request') }}">
                                    <i class="mdi mdi-lock"></i> {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                            <p class="text-muted">Don't have an account ? <a href="{{ route('register') }}" class="text-muted"> <b>Signup Now</b> </a>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
@endsection
