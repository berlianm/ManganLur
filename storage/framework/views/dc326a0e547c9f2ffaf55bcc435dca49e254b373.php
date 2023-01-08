<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/StyleSignin.css')); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="icon" href="<?php echo e(asset('images/logoTitle.png')); ?>">
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
                                        <img src="<?php echo e(asset('images/logo.png')); ?>" style="width: 300px;" alt="logo">
                                    </div>

                                    <form class="my-3">
                                        <h6 class="text-center">Please login to your account</h6>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="username">Username</label>
                                            <input type="text" id="username" class="form-control" name="username"
                                                placeholder="Enter Your Email or Username..." required/>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Password</label>
                                            <input type="password" id="password" class="form-control" name="password"
                                                placeholder="Enter your Password..." required/>
                                        </div>
                                        <button type="submit" class="btn btn-login w-100 mb-3">Log in</button>
                                    </form>
                                    <div class="d-flex align-items-center justify-content-center pb-4">
                                        <p class="mb-0 me-2">Don't have an account?</p>
                                        <a href="/register">
                                            <button type="button" class="btn btn-outline-login">Register Now</button>
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
    
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>
<?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/loginUser.blade.php ENDPATH**/ ?>