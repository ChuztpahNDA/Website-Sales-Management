<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/clients/css/styles.css') }}">
    <title>Register</title>
</head>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4" action="{{ route('UsersRegister') }}" method="POST">
                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label">Họ và tên</label>
                                                <input type="text" name="RegisterName" class="form-control"
                                                    value="{{ old('RegisterName') ?? '' }}" />
                                                @error('RegisterName')
                                                    <span style="color: red"> {{ $message }} </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label">Email</label>
                                                <input type="email" name="RegisterEmail" class="form-control"
                                                    {{ old('RegisterEmail') ?? '' }} />
                                                @error('RegisterEmail')
                                                    <span style="color: red"> {{ $message }} </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-calendar fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label">Ngày sinh</label>
                                                <input type="date" name="RegisterBirthday" class="form-control"
                                                    {{ old('RegisterBirthday') ?? '' }} />
                                                @error('RegisterBirthday')
                                                    <span style="color: red"> {{ $message }} </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label">Mật khẩu</label>
                                                <input type="password" name="RegisterPass" class="form-control" />
                                                @error('RegisterPass')
                                                    <span style="color: red"> {{ $message }} </span>
                                                @enderror
                                            </div>

                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fa fa-key fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label">Xác nhận mật khẩu</label>
                                                <input type="password" name="RegisterPass_confirmation"
                                                    class="form-control" />
                                                @error('RegisterPass_confirmation')
                                                    <span style="color: red"> {{ $message }} </span>
                                                @enderror
                                            </div>

                                        </div>
                                        @if (!empty($error))
                                            <div class="alert alert-danger">
                                                {{ $error }}
                                            </div>
                                        @endif
                                        <div class="form-check d-flex justify-content-center mb-5">
                                            <label style="color: red">

                                            </label>
                                            <input class="form-check-input me-2" type="checkbox" value="True"
                                                name="RegisterCheck" />
                                            <label class="form-check-label">
                                                I agree all statements in <a href="#!">Terms of service</a>
                                            </label>
                                        </div>
                                        
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg"
                                                name="btnRegister">Register</button>
                                        </div>
                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                                        class="img-fluid" alt="Sample image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
