<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sparkout - Signup</title>
    @include('admin.layouts.top_links')
</head>

<body>
    <main>
        <div class="container">
            <section
                class="section register section-div min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="{{ url('/') }}" class="logo d-flex align-items-center w-auto">
                                    <img src="{{ asset('admin/assets/img/logo-image.svg') }}" alt="logo">
                                </a>
                            </div>

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-2 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                    </div>
                                    <form method="POST" class="g-3 needs-validation" action="{{ route('register') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="name" class="col-form-label">{{ __('Name') }}</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror" name="name"
                                                value="{{ old('name') }}" required autocomplete="off" autofocus>
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="row">
                                            <label for="email"
                                                class="col-form-label">{{ __('Email Address') }}</label>

                                            <div class="col-md-12">
                                                <input id="email" type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    name="email" value="{{ old('email') }}" required
                                                    autocomplete="off">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row">
                                            <label for="password" class="col-form-label">{{ __('Password') }}</label>

                                            <div class="col-md-12">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="off">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password-confirm"
                                                class="col-form-label">{{ __('Confirm Password') }}</label>

                                            <div class="col-md-12">
                                                <input id="password-confirm" type="password" class="form-control"
                                                    name="password_confirmation" required autocomplete="off">
                                            </div>
                                        </div>

                                        <div class="row mb-0">
                                            <div class="col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Sign Up') }}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0 mt-3">Already have an account? <a
                                                    href="{{ route('login') }}">Log in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </div>
    </main>
</body>

</html>
