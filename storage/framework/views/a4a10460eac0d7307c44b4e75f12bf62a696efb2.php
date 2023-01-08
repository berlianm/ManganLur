<?php
    $title = 'User Restoran - Tambah Resto';
?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-6">
            <a class="text-decoration-none" href="#">
                <div class="card text-center p-2 mb-3" style="width: 300px; height:300px">
                    <img class="img-fluid mx-auto" width="250px" height="250px" src="<?php echo e(asset('images/restaurant.png')); ?>"
                        alt="">

                </div>
            </a>
        </div>
        <div class="col-6">
            <form action="/upload-resto" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Restoran</label>
                    <input type="text"
                        class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        is-invalid
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="nama" name="nama" placeholder="Masukan Nama Restoran..." value="<?php echo e(old('nama')); ?>">
                    <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text"
                        class="form-control <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        is-invalid
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="alamat" name="alamat" placeholder="Masukan Alamat Restoran..." value="<?php echo e(old('alamat')); ?>">
                    <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label for="buka" class="form-label">Jam Buka</label>
                    <input type="time"
                        class="form-control <?php $__errorArgs = ['buka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        is-invalid
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="buka" name="buka"  value="<?php echo e(old('buka')); ?>">
                    <?php $__errorArgs = ['buka'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="mb-3">
                    <label for="tutup" class="form-label">Jam Tutup</label>
                    <input type="time"
                        class="form-control <?php $__errorArgs = ['tutup'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        is-invalid
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="tutup" name="tutup"  value="<?php echo e(old('tutup')); ?>">
                    <?php $__errorArgs = ['tutup'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="invalid-feedback">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <a href="/tabel-restoranku" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary float-end">Submit</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php if(count($errors) > 0): ?>
        <script>
            toastr.error(`<?php echo e($errors->first()); ?>`);
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/restoran/tambahResto.blade.php ENDPATH**/ ?>