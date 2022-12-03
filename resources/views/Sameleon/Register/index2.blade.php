<!DOCTYPE html>
<html lang="fr">

<head>

    <meta charset="utf-8" />
    <title>Crée vote compte | SAMELEON EXPRESS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow" />
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }}">
    <meta content="app_creator" name="Elmarzougui Abdelghafour" />
    <meta content="app_version" name="v 1.1" />

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('css/mix/app.css') }}?ver={{ rand(1, 852) }}" rel="stylesheet" type="text/css" />

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
                                        <h5 class="text-primary">Crée vote compte </h5>
                                        <p class="text-muted">ça nous fait plaisir d'être avec nous</p>

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
                                            <img src="{{ asset('images/logo.png') }}" alt=""
                                                class="rounded-circle" height="34">
                                        </span>
                                    </div>
                                </a>

                                <a href="https://sameleon-express.ma/" class="auth-logo-dark">
                                    <div class="avatar-md profile-user-wid mb-4">
                                        <span class="avatar-title rounded-circle bg-light">
                                            <img src="{{ asset('images/logo.png') }}" alt=""
                                                class="rounded-circle" height="80">
                                        </span>
                                    </div>
                                </a>
                            </div>
                            <div class="p-2">
                                @include('layouts._parts.__messages')
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
                                            class="form-control @error('prenom') is-invalid @enderror" id="prenom"
                                            value="{{ old('prenom') }}" placeholder="Entrer votre prénom" required>
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
                                            class="form-control  @error('email') is-invalid @enderror" id="useremail"
                                            value="{{ old('email') }}" placeholder="Entrer votre e-mail" required>
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
                                        <select class="form-select @error('type') is-invalid @enderror" name="type"
                                            required>
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
                                            <a href="https://sameleon-express.ma/" target="_blank"
                                                class="text-primary">Terms of Use</a>
                                        </p>
                                    </div>

                                    <div class="mt-4 d-grid">
                                        <button class="btn btn-primary waves-effect waves-light"
                                            type="submit">Register</button>
                                    </div>

                                    <div class="mt-4 text-center">
                                        {{-- <h5 class="font-size-14 mb-3">Sign up using</h5> --}}

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
