<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login | SameleonExpress</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <meta name="author" content="Elmarzougui Abdelghafour">
    <meta name="app_version" content="1.0.0" />
    <meta name="app_devlopper" content="Elmarzougui Abdelghafour" />
    <meta name="app_devlopper_website" content="https://elmarzougui.com" />
    <meta name="app_devlopper_facebook" content="https://www.facebook.com/devscript" />
    <meta name="app_devlopper_linkedin" content="https://www.linkedin.com/in/devscript/" />
    <meta name="app_devlopper_twitter" content="https://twitter.com/devscriptt" />
    <meta name="app_devlopper_github" content="https://github.com/elmarzouguidev" />

    @include('layouts._parts.__sec_meta')

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('layouts._parts.__og_meta')

    <link href="{{ asset('css/mix/app.css') }}" rel="stylesheet" type="text/css" />


</head>

<body>
    <div>
        <div class="container-fluid p-0">
            <div class="row g-0">

                <div class="col-xl-9">
                    <div class="auth-full-bg pt-lg-5 p-4">
                        <div class="w-100">
                            <div class="bg-overlay"></div>
                            <div class="d-flex h-100 flex-column">

                                <div class="p-4 mt-auto">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-7">
                                            <div class="text-center">

                                                <h4 class="mb-3"><i
                                                        class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span
                                                        class="text-primary"></span>clients satisfaits</h4>

                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel"
                                                        id="auth-review-carousel">




                                                        @foreach($testimonials as $test)
                                                        <div class="item">
                                                            <div class="py-3">
                                                    
                                                                <p class="font-size-16 mb-4">{!! $test->content !!}</p>
                                                            

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">{{$test->client?->full_name}}</h4>
                                                                    
                                                            
                                                                </div>
                                                            </div>
                                                            </div>

                                                        </div>
                                                        @endforeach

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="{{ route('home') }}" class="d-block auth-logo">
                                        <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                            height="18" class="auth-logo-dark">
                                        <img src="{{ asset('assets/images/profile-img.png') }}" alt=""
                                            height="18" class="auth-logo-light">
                                    </a>
                                </div>
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-primary">Welcome Back !</h5>
                                        <p class="text-muted">Se connecter</p>
                                    </div>

                                    <div class="mt-4">
                                        <form class="form-horizontal" action="{{ route('admin:auth:loginPost') }}"
                                            method="post">
                                            @csrf
                                            <x-honeypot />
                                            <div class="mb-3">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input type="email" name="email"
                                                    class="form-control  @error('email') is-invalid @enderror"
                                                    id="email" value="{{ old('email') }}"
                                                    placeholder="Entrer votre email">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror

                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Mot de pass</label>
                                                <div class="input-group auth-pass-inputgroup">
                                                    <input type="password" name="password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        placeholder="Entrer votre mot de pass" aria-label="Password"
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
                                                <button class="btn btn-primary waves-effect waves-light"
                                                    type="submit">Log In
                                                </button>
                                            </div>
       
                                            @if (Route::has('forgotpassword'))
                                                <div class="mt-4 text-center">
                                                    <a href="{{ route('forgotpassword') }}" class="text-muted">
                                                        <i class="mdi mdi-lock me-1"></i>
                                                        Mot de passe oublié ?
                                                    </a>
                                                </div>
                                            @endif
                                        </form>
                                        <div class="mt-5 text-center">
                                            <p>Vous n’avez pas encore de compte ?<a href="{{route('admin:auth:register')}}"
                                                    class="fw-medium text-primary"> S’inscrire

                                                </a> </p>
                                        </div>
                                        <br>
                                        <hr>
                                        <div class="mt-3 d-grid">
                                            <a target="_blank" href="{{route('delivery:auth:login')}}" class="btn btn-primary waves-effect waves-light">
                                                Espace livreur 
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                        SameleonExpress
                                    </p>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container-fluid -->
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
