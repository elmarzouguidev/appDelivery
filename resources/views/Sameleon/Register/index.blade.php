<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8" />
    <title>Crée vote compte | SAMELEON GROUP</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
    <meta content="app_creator" name="Elmarzougui Abdelghafour" />
    <meta content="app_version" name="v 1.1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link href="{{ asset('css/mix/app.css') }}?ver={{ rand(1, 852) }}" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">

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
                                                        class="text-primary">23</span>+ Satisfied clients</h4>

                                                <div dir="ltr">
                                                    <div class="owl-carousel owl-theme auth-review-carousel"
                                                        id="auth-review-carousel">
   
                                                        <div class="item">
                                                            <div class="py-3">
                                                                <p class="font-size-16 mb-4">" If Every Vendor on Envato
                                                                    are as supportive as Themesbrand, Development with
                                                                    be a nice experience. You guys are Wonderful. Keep
                                                                    us the good work. "</p>

                                                                <div>
                                                                    <h4 class="font-size-16 text-primary">nezerious</h4>
                                                                    <p class="font-size-14 mb-0">- Skote User</p>
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
                        </div>
                    </div>
                </div>
                <!-- end col -->

                <div class="col-xl-3">
                    <div class="auth-full-page-content p-md-5 p-4">
                        <div class="w-100">

                            <div class="d-flex flex-column h-100">
                                <div class="mb-4 mb-md-5">
                                    <a href="index.html" class="d-block auth-logo">
                                        <img src="assets/images/logo-dark.png" alt="" height="18"
                                            class="auth-logo-dark">
                                        <img src="assets/images/logo-light.png" alt="" height="18"
                                            class="auth-logo-light">
                                    </a>
                                </div>
                                <div class="my-auto">

                                    <div>
                                        <h5 class="text-primary">Crée vote compte </h5>
                                        <p class="text-muted">ça nous fait plaisir d'être avec nous</p>
                                    </div>

                                    <div class="mt-4">

                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                      
                                        <form class="needs-validation" novalidate
                                            action="{{ route('admin:auth:register.post') }}" method="post">
                                            @csrf
                                        
                                            <x-honeypot />
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom *</label>
                                                <input type="text" name="nom"
                                                    class="form-control @error('nom') is-invalid @enderror" id="nom"
                                                    value="{{ old('nom') }}" placeholder="Entrer votre nom" required>

                                                @error('nom')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="mb-3">
                                                <label for="prenom" class="form-label">Prénom *</label>
                                                <input type="text" name="prenom"
                                                    class="form-control @error('prenom') is-invalid @enderror"
                                                    id="prenom" value="{{ old('prenom') }}"
                                                    placeholder="Entrer votre prénom" required>
                                                @error('prenom')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="telephone" class="form-label">Tél *</label>
                                                <input type="text" name="telephone"
                                                    class="form-control  @error('telephone') is-invalid @enderror"
                                                    id="telephone" value="{{ old('telephone') }}"
                                                    placeholder="Entrer votre téléphone" required>
                                                @error('telephone')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="useremail" class="form-label">E-mail *</label>
                                                <input type="email" name="email"
                                                    class="form-control  @error('email') is-invalid @enderror"
                                                    id="useremail" value="{{ old('email') }}"
                                                    placeholder="Entrer votre e-mail" required>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="userpassword" class="form-label">Mot de pass</label>
                                                <input type="password" name="password"
                                                    class="form-control  @error('password') is-invalid @enderror"
                                                    id="userpassword" placeholder="Entrer votre mot de pass" required>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="type" class="form-label">Vous etes ?</label>
                                                <select class="form-select @error('type') is-invalid @enderror" name="type" required>
                                                    <option value=""></option>
                                                    <option value="particulier">particulier</option>
                                                    <option value="entreprise">entreprise</option>
                                                </select>
                                                @error('type')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>

                                            <div>
                                                <p class="mb-0">By registering you agree to the Sameleon GROUP
                                                    <a href="https://sameleon-express.ma/" target="_blank" class="text-primary">Terms of Use</a>
                                                </p>
                                            </div>

                                            <div class="mt-4 d-grid">
                                                <button class="btn btn-primary waves-effect waves-light"
                                                    type="submit">Register</button>
                                            </div>

                                            <div class="mt-4 text-center">
                                                {{--<h5 class="font-size-14 mb-3">Sign up using</h5>--}}

                                                {{-- <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <a href="javascript::void()"
                                                            class="social-list-item bg-primary text-white border-primary">
                                                            <i class="mdi mdi-facebook"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript::void()"
                                                            class="social-list-item bg-info text-white border-info">
                                                            <i class="mdi mdi-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a href="javascript::void()"
                                                            class="social-list-item bg-danger text-white border-danger">
                                                            <i class="mdi mdi-google"></i>
                                                        </a>
                                                    </li>
                                                </ul> --}}

                                            </div>

                                        </form>

                                        <div class="mt-5 text-center">
                                            <p>si vous avez déjà un compte <a href="{{ route('admin:auth:login') }}"
                                                    class="fw-medium text-primary"> identifiez-vous</a> </p>
                                        </div>

                                    </div>
                                </div>

                                <div class="mt-4 mt-md-5 text-center">
                                    <p class="mb-0">©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                        Sameleon GROUP <i class="mdi mdi-heart text-danger"></i> {{--by Elmarzougui.net--}}
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
               
            </div>
      
        </div>
    
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
