<?php
    $previous = 'javascript:history.go(-1)';
    if (isset($_SERVER['HTTP_REFERER'])) {
        $previous = $_SERVER['HTTP_REFERER'];
    }
    $title = 'User Restoran - Edit Menu';
    $jenis_menu = DB::table('jenis_menu')->get();
    $review = DB::table('review_menu')
        ->join('users', 'review_menu.user_id', '=', 'users.id')
        ->join('menus', 'menus.id', '=', 'review_menu.menu_id')
        ->where('review_menu.menu_id', '=', $menu->id)
        ->select('*')
        ->get();
    
    $gambar_menu = DB::table('gambar_menu')
        ->where('menu_id', '=', $menu->id)
        ->get();
?>


<?php $__env->startSection('content'); ?>
    <div class="container-fluid header">
        <div class="container p-3">
            <div class="row">
                <?php $__currentLoopData = $gambar_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col">
                        <img src="<?php echo e(asset('images/menu/' . $item->gambar)); ?>" class="img-thumbnail" alt="">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if(Auth::user()->role == 'restoran'): ?>
                                <a href="<?php echo e(url('edit-gambar/menu/' . $item->id . '/' . $menu->id)); ?>" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a>
                                <form action="<?php echo e(url('hapus/gambar/' . $item->id)); ?>" method="POST" class="d-inline"
                                    onsubmit="return confirm('Apakah anda yakin MENGHAPUS data ini ?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <div class="col">
                    <img src="<?php echo e(asset('images/menu/' . $menu->gambar)); ?>" class="img-thumbnail" alt="">
                </div>

                <div class="col">
                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->role == 'restoran'): ?>
                            <div class="text-center mb-3">
                                <i type="button" class="bi bi-plus-circle text-white" data-bs-toggle="modal"
                                    data-bs-target="#exampleModal" style="font-size: 6rem;"></i>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-6">
                <div class="card p-3 mb-3">
                    <h4><?php echo e($menu->nama_menu); ?></h4>
                    <p>
                        <?php echo e($menu->keterangan); ?>

                    </p>
                </div>
                <div class="card p-3">
                    <table>
                        <thead>
                            <tr>
                                <th class="fw-bold">User</th>
                                <th class="fw-bold">Komen</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $review; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <?php echo e($item->name); ?>

                                    </td>
                                    <td><?php echo e($item->review); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-3 ">
                    <form action="<?php echo e(url('review-menu/' . $menu->id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <label for="review" class="form-label fw-bold fs-5">Review Food</label>
                        <textarea class="form-control" name="review" id="review" placeholder="Enter Your Review..."></textarea>
                        <?php if(auth()->guard()->check()): ?>
                            <input type="hidden" name="user_id" id="" value="<?php echo e(Auth::user()->id); ?>">
                        <?php endif; ?>
                        <div class="text-end mt-3">
                            <?php if(auth()->guard()->check()): ?>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            <?php endif; ?>
                            <?php if(auth()->guard()->guest()): ?>
                                <button type="button" class="btn btn-secondary" onclick="cekLogin()">Submit</button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Gambar Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('tambah-gambar/' . $menu->id)); ?>" method="post" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="image" class="form-label">Gambar</label>
                            <input class="form-control" type="file" name="gambar" id="image">
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
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
    <script>
        function cekLogin() {

            swal.fire({
                title: 'Login Dulu',
                text: 'Anda harus login terlebih dahulu untuk memberikan review',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Login'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "<?php echo e(route('login')); ?>"
                }
            })
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/menu/detailMenu.blade.php ENDPATH**/ ?>