@extends('main.main')

@section('content')

<div class="container">
    <section class="contact_section layout_padding">
        <div class="container px-0">
            <div class="heading_container ">
                <h2 class="">
                    Login form
                </h2>
            </div>
        </div>
        <div class="container container-bg d-flex justify-content-center">

            <!-- Right side with form -->
            <div class="col-md-6 col-lg-6 px-0">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div>
                    <label for="email"
                    class=" col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="example@email.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                    <label for="password"
                                class="col-form-label text-md-end">{{ __('Password') }}</label>
                    
                    <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror my-0" name="password"
                                    required autocomplete="current-password" autofocus placeholder="Password">
                                    <!-- @if (Route::has('password.request'))
                                    <div class="text-end">
                                    <a class="btn btn-link px-0" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                    </div> -->
                                @endif
                    </div>
                    
                    <div class="checkbox-wrapper mt-2">
                        <!-- <input type="checkbox" id="rememberMe">
                        <label for="rememberMe">Remember Me</label> -->
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                    </div>
                    <!-- <div>
                        <label id="formError" style="display: none; color: red;"></label>
                    </div> -->
                    <div>
                   
                    <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                
                    </div>
                </form>
            </div>
        </div>
</div>

</section>

<!-- end contact section -->
<!-- </div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email"
                                class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password"
                                class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control @error('password') is-invalid @enderror" name="password"
                                    required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
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
</div> -->
@endsection