<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('css/StyleSignin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="{{ asset('images/logoTitle.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://kit.fontawesome.com/a7f0d4dd4e.js" crossorigin="anonymous"></script>
</head>

<body>

    <section class="h-100 gradient-form" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('images/logo.png') }}" style="width: 300px;" alt="logo">
                                    </div>
                                    <form action="/registrasi" method="POST" class="my-3">
                                        @csrf
                                        <h6 class="text-center">Please login to your account</h6>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="nama">Nama</label>
                                            <input type="text" id="nama"
                                                class="form-control 
                                            @error('nama')
                                                    is-invalid
                                                @enderror"
                                                name="nama" placeholder="Enter Your Name" value="{{ old("nama") }}"/>
                                            @error('nama')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" id="email"
                                                class="form-control   @error('email')
                                                    is-invalid
                                                @enderror"
                                                name="email" placeholder="Enter Your Email" value="{{ old("email") }}"/>
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" id="username" class="form-control  @error('username')
                                                    is-invalid
                                                @enderror" name="username"
                                                placeholder="Enter Your Username..." value="{{ old("username") }}"
                                                />
                                            @error('username')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="role">Pilih Akun</label>
                                            <select class="form-select @error('role')
                                                    is-invalid
                                                @enderror" id="role" name="role"
                                                aria-label="Default select example">
                                                <option selected>Pilih Akun</option>
                                                <option value="restoran">Pemilik Restoran</option>
                                                <option value="user">Pengunjung</option>
                                            </select>
                                              @error('role')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" class="form-control @error('password')
                                                    is-invalid
                                                @enderror" name="password"
                                                placeholder="Enter your Password..."
                                                 />
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-outline mb-4">
                                            <label class="form-label"
                                                for="password_confirmation">password_confirmation</label>
                                            <input type="password" id="password_confirmation" class="form-control 
                                            @error('password_confirmation')
                                                    is-invalid
                                                @enderror"
                                                name="password_confirmation" placeholder="password_confirmation..."
                                               />
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-login w-100 mb-3">Registrasi</button>
                                    </form>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Have an account?</p>
                                        <a href="/login">
                                            <button type="button" class="btn btn-outline-login">Login Now</button>
                                        </a>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4 text-center">ManganLur</h4>
                                    <p class="small mb-0">Dalam membuat bisnis restoran kita harus mengetahui kekurangan
                                        dari
                                        restoran yang kita miliki. Bagi pecinta kuliner harus tahu mana restoran yang
                                        bagus,
                                        menarik dan tentunya cocok dengan selera kita. Oleh karena itu kami membuat web
                                        aplikasi
                                        untuk menilai kekurangan dan kelebihan dari restoran. Untuk membantu restoran
                                        agar lebih baik
                                        dan lebih menarik pelanggan baru dari review pelanggan yang pernah berkunjung ke
                                        restoran tersebut.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    {{-- sweetalert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @if (count($errors) > 0)
        <script>
            toastr.error(`{{ $errors->first() }}`);
        </script>
    @endif

</body>

</html>
