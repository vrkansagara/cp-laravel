@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
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

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer')
    <script>
        jQuery(document).ready(function(){
            $("#loginForm").each(function() {
                $(this).validate({
                    errorElement: 'span',
                    errorClass: 'invalid-feedback',

                    errorPlacement: function (error, element) {
                        if (element.parent('.input-group').length ||
                            element.prop('type') === 'checkbox' || element.prop('type') === 'radio') {
                            error.insertAfter(element.parent());
                            // else just place the validation message immediately after the input
                        } else {
                            error.insertAfter(element);
                        }
                    },
                    highlight: function (element) {
                        $(element).closest('.form-control').removeClass('is-valid').addClass('is-invalid'); // add the Bootstrap error class to the control group
                    },



                    unhighlight: function(element) {
                        $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid');
                    },

                    success: function (element) {
                        $(element).closest('.form-control').removeClass('is-invalid').addClass('is-valid'); // remove the Boostrap error class from the control group
                    },

                    focusInvalid: false, // do not focus the last invalid input

                    rules: {"email":{"laravelValidation":[["Required",[],"The email field is required.",true],["String",[],"The email must be a string.",false]]},"password":{"laravelValidation":[["Required",[],"The password field is required.",true],["String",[],"The password must be a string.",false]]}}            });
            });
        });
    </script>
{{--{!! $validator->selector('#loginForm') !!}--}}
@endsection
