<?php
    $previous = 'javascript:history.go(-1)';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    $title = 'Edit - Gambar';
?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col">
            <center>
                <img src="<?php echo e(asset('images/menu/' . $gambar->gambar)); ?>" alt="" width="50%">
                <br>
                <div class="mb-3">
                    <form action="<?php echo e(url('update/gambar/' . $gambar->id)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <input type="file"
                            class="form-control <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    is-invalid
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> w-50 mt-2"
                            id="gambar" name="gambar">
                        <?php $__errorArgs = ['gambar'];
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
                        <input type="hidden" name="menu_id" value="<?php echo e($idM); ?>">
                        <a href="<?php echo e($previous); ?>" class="btn btn-light mt-2">Kembali</a>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </center>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <?php if(count($errors) > 0): ?>
        <script>
            toastr.error(`<?php echo e($errors->first()); ?>`);
        </script>
    <?php endif; ?>
    <?php if(session()->has('status')): ?>
        <script>
            toastr.success(`<?php echo e(session('message')); ?>`);
        </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/menu/editGambar.blade.php ENDPATH**/ ?>