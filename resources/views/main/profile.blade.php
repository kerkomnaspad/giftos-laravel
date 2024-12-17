@extends('main.main')

@section('content')

<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}");
        @endforeach
    @endif

    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif

    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
</script>

<section class="contact_section layout_padding">
    <div class="container px-0">
        <div class="heading_container ">
            <h2 class="">
                Profile page
            </h2>
        </div>
    </div>
    <div class="container container-bg d-flex justify-content-center align-items-center">

        <div class="col-md-6 col-lg-5 px-0">
        <form method="POST" action="{{ route('updateProfile',['id' => auth()->id()]) }}" >
        @csrf
        @method('PUT')
                <div>
                    <label for="name" class="col-form-label text-md-end">{{ __('Name') }}</label>

                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                        value="{{ $user->name }}" required autocomplete="name" autofocus placeholder="John Doe">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="email" class="col-form-label text-md-end">{{ __('Email Address') }}</label>

                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                        name="email" value="{{ $user->email}}" required autocomplete="email" autofocus placeholder="example@email.com">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="col-form-label text-md-end">{{ __('New Password') }}</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" autocomplete="new-password" autofocus placeholder="Password" >

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>
                <div>
                    <label for="password-confirm"
                        class=" col-form-label text-md-end">{{ __('Confirm New Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                         autocomplete="new-password" autofocus placeholder="Confirm Password" >

                    <label id="formError" style="display: none; color: red;"></label>
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
</section>


@endsection