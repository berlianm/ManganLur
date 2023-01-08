<?php
    $previous = 'javascript:history.go(-1)';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    $title = 'User Restoran - Edit Menu';
    $jenis_menu = DB::table('jenis_menu')->get();
?>


<?php $__env->startSection('content'); ?>
    <form action="<?php echo e(url('/restoran/menu/update/'.$menu->id)); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="row">

            <div class="col-6">
                <img src="<?php echo e(asset('images/menu/' . $menu->gambar)); ?>" alt="" width="75%">
                <br>
                <div class="mb-3">
                    <label for="gambar" class="form-label mt-2 "> Ganti gambar </label>
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
unset($__errorArgs, $__bag); ?> w-75"
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
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                    <label for="menu" class="form-label">Nama Menu</label>
                    <input type="text"
                        class="form-control <?php $__errorArgs = ['menu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        is-invalid
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="menu" name="menu" placeholder="Masukan menu menu..." value="<?php echo e($menu->nama_menu); ?>">
                    <?php $__errorArgs = ['menu'];
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
                    <label for="harga" class="form-label">harga</label>
                    <input type="text"
                        class="form-control <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        is-invalid
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="harga" name="harga" placeholder="Masukan harga menu..." value="<?php echo e($menu->harga); ?>">
                    <?php $__errorArgs = ['harga'];
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
                    <label for="jenis_menu" class="form-label">Jenis Menu</label>
                    <select class="form-select <?php $__errorArgs = ['jenis_menu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        aria-label="Default select example" id="jenis_menu" name="jenis_menu">
                        <option value="<?php echo e($menu->jenis_menu_id); ?>">
                            <?php echo e(DB::table('jenis_menu')->where('id', $menu->jenis_menu_id)->value('nama')); ?>

                        </option>
                        <?php $__currentLoopData = $jenis_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($item->id); ?>"><?php echo e($item->nama); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan</label>
                    <textarea class="form-control <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        is-invalid
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                        id="keterangan" name="keterangan" rows="3"><?php echo e($menu->keterangan); ?></textarea>
                    <?php $__errorArgs = ['keterangan'];
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
                    <input type="hidden" name="restoran_id" id="" value="<?php echo e($idR); ?>">
                </div>
                <a href="<?php echo e($previous); ?>" class="btn btn-light">Kembali</a>
                <button type="submit" class="btn btn-primary float-end">Update</button>
            </div>
        </div>
    </form>
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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/menu/editMenu.blade.php ENDPATH**/ ?>