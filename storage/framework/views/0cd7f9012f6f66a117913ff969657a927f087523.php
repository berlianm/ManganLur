<?php
    $title = 'Home';
    $restorans = DB::table('rating')
        ->join('restorans', 'rating.restoran_id', '=', 'restorans.id')
        ->select(['restorans.*', DB::raw('AVG(rating.rating) as rating')])
        ->groupBy('rating.restoran_id')
        ->orderByDesc('rating')
        ->limit(1)
        ->get();
?>



<?php $__env->startSection('hero'); ?>
    <img src="<?php echo e(asset('images/logoHead.png')); ?>" alt="Logo">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('contact'); ?>
    <p>
        <a class="btn tombol fs-4 mx-3" data-bs-toggle="collapse" href="#contact" role="button" aria-expanded="false"
            aria-controls="contact">Contact
        </a>
        <button class="btn tombol fs-4 mx-3" type="button" data-bs-toggle="collapse" data-bs-target="#about"
            aria-expanded="false" aria-controls="about">About Us
        </button>


    </p>
    <div class="row">
        <div class="col">
            <div class="collapse multi-collapse" id="contact">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <a
                                href="https://api.whatsapp.com/send?phone=6282324802523&text=Hallo%20ManganLur!!!%0AAplikasi%20Review%20Restoran%20Terbaik."><button
                                    class="btn tombol btn-wa w-100 mx-3 fs-5"><i class="bi bi-whatsapp"></i>
                                    WhatsApp</button></a>
                        </div>
                        <div class="col-md-6">
                            <a href="https://www.instagram.com/Mangan.Lur.project/"><button
                                    class="btn tombol btn-ig w-100 mx-3 fs-5"><i class="bi bi-instagram"></i>
                                    Instagram</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="collapse multi-collapse" id="about">
                <div class="card card-body">
                    <h4 class="text-center">About Us</h4>
                    <p>Dalam membuat bisnis restoran kita harus mengetahui kekurangan dari
                        restoran yang kita miliki. Bagi pecinta kuliner harus tahu mana restoran yang bagus,
                        menarik dan tentunya cocok dengan selera kita. Oleh karena itu kami membuat web aplikasi
                        untuk menilai kekurangan dan kelebihan dari restoran. Untuk membantu restoran agar lebih baik
                        dan lebih menarik pelanggan baru dari review pelanggan yang pernah berkunjung ke restoran tersebut.
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="row justify-content-between my-5 ">
        <div class="col-md-4">
            <a class="text-decoration-none" href="<?php echo e(url('cari-resto')); ?>">
                <div class="card text-center p-2 mb-3" style="width: 250px; height:250px">
                    <img class="img-fluid mx-auto" width="200px" height="200px" src="<?php echo e(asset('images/restaurant.png')); ?>"
                        alt="">
                    <h3 class="text-black px-3" class=>Cari Resto</h3>
                </div>
            </a>
            <a class="text-decoration-none" href="<?php echo e(url('rating-resto')); ?>">
                <div class="card text-center p-2 mt-5" style="width: 250px; height:250px; margin-left: 215px">
                    <img class="img-fluid mx-auto" width="200px" height="200px" src="<?php echo e(asset('images/rating.png')); ?>"
                        alt="">
                    <h3 class="text-black px-3" class=>Review</h3>
                </div>
            </a>

        </div>
        <div class="col-md-4 ">
            <a class="text-decoration-none" href="<?php echo e(url('cari-makan')); ?>">
                <div class="card text-center p-2 mb-3" style="width: 250px; height:250px">
                    <img class="img-fluid mx-auto" width="200px" height="200px" src="<?php echo e(asset('images/fast-food.png')); ?>"
                        alt="">
                    <h3 class="text-black px-3" class=>Cari Makanan</h3>
                </div>
            </a>

        </div>
        <div class="col-md-4 mb-3">
            <div class="card p-3">
                <h5 class="text-black">Resto Terpopuler</h5>
                <?php $__currentLoopData = $restorans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="row">
                        <img src="<?php echo e(asset('data_file/' . $item->gambar)); ?>" class="rounded mb-1" width="300px"
                            height="200px" alt="">
                        <h4><?php echo e($item->nama_resto); ?></h4>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="col-10 info">
                                <h6><?php echo e($item->alamat); ?></h6>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <i class="bi bi-clock"></i>
                            </div>
                            <div class="col-10 info">
                                <h6><?php echo e($item->jam_buka); ?> - <?php echo e($item->jam_tutup); ?></h6>
                            </div>
                        </div>
                        <div class="row justify-content-start">
                            <div class="col-2">
                                <i class="fas fa-star text-warning"></i>
                            </div>
                            <div class="col-10 info">
                                <?php
                                    $rating = $item->rating;
                                    $rating = number_format($rating, 1);
                                ?>
                                <h6><?php echo e($rating); ?></h6>
                            </div>
                        </div>
                        <div class="text-end">
                            <a href="<?php echo e($item->lokasi_map); ?>" target="_blank"><button
                                    class="btn tombol">Location</button></a>
                            <a href="<?php echo e(url('restoran/menu/' . $item->id)); ?>"><button class="btn tombol">See
                                    Resto</button></a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(session()->has('success')): ?>
        <script>
            Swal.fire({
                title: 'Selamat Datang, <?php echo e(Auth::user()->name); ?>',
                text: `Anda <?php echo e(session('success')); ?>`,
                icon: 'success',
                confirmButtonText: 'Oke'
            })
        </script>
    <?php endif; ?>
    <?php if(session()->has('logout')): ?>
        <script>
            Swal.fire({
                title: 'Sukses!!',
                text: `<?php echo e(session('logout')); ?>`,
                icon: 'success',
                confirmButtonText: 'Oke'
            })
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/home.blade.php ENDPATH**/ ?>