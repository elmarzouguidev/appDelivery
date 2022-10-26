<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login Livreur | SAMELEON Express</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <meta name="author" content="Elmarzougui Abdelghafour">
    <meta name="app_version" content="1.0.0" />
    <meta name="app_devlopper" content="Elmarzougui Abdelghafour" />
    <meta name="app_devlopper_website"  content="https://elmarzougui.com" />
    <meta name="app_devlopper_facebook" content="https://www.facebook.com/devscript" />
    <meta name="app_devlopper_linkedin" content="https://www.linkedin.com/in/devscript/" />
    <meta name="app_devlopper_twitter"  content="https://twitter.com/devscriptt" />
    <meta name="app_devlopper_github"   content="https://github.com/devscript-abdo" />

    @include('layouts._parts.__sec_meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts._parts.__og_meta')
    <link href="{{ asset('css/mix/app.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>
    <div class="account-pages my-5 pt-sm-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary bg-soft">
                            <div class="row">
                                <div class="col-7">
                                    <div class="text-primary p-4">
                                        <h5 class="text-primary">Se connecter</h5>

                                    </div>
                                </div>
                                <div class="col-5 align-self-end">
                                    <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="auth-logo">
                                <a href="{{ route('home') }}" class="auth-logo-light">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('images/logo.png') }}" alt="" class="rounded-circle"
                                                height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="{{ route('home') }}" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('images/logo.png') }}" alt="" class="rounded-circle"
                                                height="80">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endforeach
                                @endif
                                <form  class="form-horizontal"
                                    action="{{ route('delivery:auth:loginPost') }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="form-label">E-mail</label>
                                        <input type="email" name="email"
                                            class="form-control  @error('email') is-invalid @enderror" id="email"
                                            value="{{old('email')}}"
                                            placeholder="Entrer votre email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <div class="input-group auth-pass-inputgroup">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="Entrer votre mot de pass"  aria-label="Password"
                                                aria-describedby="password-addon">
                                            <button class="btn btn-light " type="button" id="password-addon"><i
                                                    class="mdi mdi-eye-outline"></i></button>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>
                                    </div>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            id="remember-check" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember-check">
                                            se souvenir de moi
                                        </label>
                                    </div>

                                    <div class="mt-3 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light" type="submit">Log In
                                        </button>
                                    </div>

                                    {{--@if (Route::has('forgotpassword'))
                                        <div class="mt-4 text-center">
                                            <a href="{{ route('forgotpassword') }}" class="text-muted">
                                                <i class="mdi mdi-lock me-1"></i>
                                                Mot de passe oublié ?
                                            </a>
                                        </div>
                                    @endif--}}
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="mt-5 text-center">

                        <div>

                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            SAMELEON GROUP

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end account-pages -->

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
