<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/clients/css/styles.css') }}">
    <title>Login</title>
</head>

<body>
    @if (!empty($messageForgot))
        <div class="alert alert-success" style="text-align: center">{{ $messageForgot }}</div>
    @endif
    <section class="vh-100" style="background-color: #9A616D;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem">
                        <div class="row g-0">
                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-2 order-lg-1">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                    alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem" />
                            </div>
                            <div class="col-md-10 col-lg-6 col-xl-5 order-1 order-lg-2">
                                <form action="{{ route('indexLogin') }}" method="POST">
                                    @csrf
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0">Logo</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                        account</h5>
                                    @if (!empty($error))
                                        <div class="alert alert-danger">{{ $error }}</div>
                                    @endif
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Email address</label>
                                        <input type="text" id="form2Example17" class="form-control form-control-lg"
                                            name="Users_ID" />
                                        @error('Users_ID')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-outline mb-4">
                                        <label class="form-label">Password</label>
                                        <input type="password" id="form2Example27" class="form-control form-control-lg"
                                            name="Users_Password" />
                                        @error('Users_Password')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit"
                                            name="btnLogin">Login</button>
                                    </div>

                                    <a class="small text-muted" href="{{route('ForgotPassword')}}">Forgot password?</a>
                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                            href="{{route('UsersRegister')}}" style="color: #393f81;">Register here</a></p>
                                    <a href="#!" class="small text-muted">Terms of use.</a>
                                    <a href="#!" class="small text-muted">Privacy policy</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</body>
