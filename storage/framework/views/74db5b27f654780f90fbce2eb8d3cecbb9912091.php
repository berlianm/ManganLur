<?php
    $title = 'Halaman User Restoran';
    $restoran = DB::table('restorans')
        ->where('user_id', '=', Auth::user()->id)
        ->first();
?>



<?php $__env->startSection('content'); ?>
    <div class="row justify-content-between ">
        <div class="col-md-6">
            <a class="text-decoration-none" href="/tabel-restoranku">
                <div class="card text-center p-2 mb-3" >
                    <img class="img-fluid mx-auto" width="70%" height="70%" src="<?php echo e(asset('images/restaurant.png')); ?>"
                        alt="">
                    <h3 class="text-black px-3">Setting</h3>
                </div>
            </a>


        </div>

        <?php if($restoran == null): ?>
            <div class="col-md-6">
                <a class="text-decoration-none" href="/tambah-resto">
                    <div class="card text-center p-2 mb-3" >
                        <i class="bi bi-plus" style="font-size: 15rem;"></i>
                        
                        <h3 class="text-black px-3">Tambah Restoran</h3>
                    </div>
                </a>
            </div>
        <?php else: ?>
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-black">Restoranku</h5>
                <div class="row">
                    <?php if($restoran->gambar == NULL): ?>
                        <img src="<?php echo e(asset('images/restaurant.png')); ?>" class="rounded mb-1" width="300px" height="200px"
                            alt="">
                        <?php else: ?>
                        <img src="<?php echo e(asset('data_file/'.$restoran->gambar)); ?>" class="rounded mb-1" width="300px" height="200px"
                        alt="">
                    <?php endif; ?>
                    <h4><?php echo e($restoran->nama_resto); ?></h4>
                    <div class="row justify-content-start">
                        <div class="col-1">
                            <i class="bi bi-geo-alt-fill" style="font-size: 25px;"></i>
                        </div>
                        <div class="col-10 info">
                            <h6><?php echo e($restoran->alamat); ?></h6>
                        </div>
                    </div>
                    <div class="row justify-content-start">
                        <div class="col-1">
                            <i class="bi bi-clock" style="font-size: 25px;"></i>
                        </div>
                        <div class="col-10 info">
                            <h6><?php echo e($restoran->jam_buka); ?> - <?php echo e($restoran->jam_tutup); ?></h6>
                        </div>
                    </div>
                    <div class="text-end">
                        <a href="<?php echo e($restoran->lokasi_map); ?>"><button class="btn tombol">Location</button></a>
                        <a href="<?php echo e(url('restoran/menu/' . $restoran->id)); ?>"><button class="btn tombol">See Resto</button></a>
                    </div>
                </div>
            </div>
        </div>
            
        <?php endif; ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/restoran/index.blade.php ENDPATH**/ ?>