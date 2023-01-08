<?php
    $title = 'User Restoran - Menu List';
    $restoran = DB::table('restorans')
        ->where('id', '=', $id)
        ->first();
    
    $jenis_menu = DB::table('jenis_menu')->get();
    
    $review = DB::table('review_resto')
        ->join('users', 'review_resto.user_id', '=', 'users.id')
        ->join('restorans', 'restorans.id', '=', 'review_resto.restoran_id')
        ->where('review_resto.restoran_id', '=', $id)
        ->select('*')
        ->get();
    
    $ratings = DB::table('rating')
        ->join('restorans', 'rating.restoran_id', '=', 'restorans.id')
        ->select(['restorans.id as id', 'restorans.nama_resto as nama', 'restorans.gambar as gambar', DB::raw('AVG(rating.rating) as rating')])
        ->where('rating.restoran_id', '=', $id)
        ->groupBy('rating.restoran_id')
        ->orderByDesc('rating')
        ->limit(1)
        ->get();
    
?>


<?php $__env->startSection('content'); ?>
    <div class="container-fluid header">
        <div class="container p-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <img src="<?php echo e(asset('data_file/' . $restoran->gambar)); ?>" class="img-thumbnail"
                                alt="<?php echo e($restoran->gambar); ?>">
                        </div>
                        <div class="col-md-7">
                            <h3 class="card-title"><?php echo e($restoran->nama_resto); ?></h3>
                            <div class="row justify-content-center">
                                <div class="col-1">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="col-11">
                                    <h5 class="info"><?php echo e($restoran->alamat); ?></h5>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-1">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div class="col-11">
                                    <h5 class="info"><?php echo e($restoran->jam_buka); ?> - <?php echo e($restoran->jam_tutup); ?></h5>
                                </div>
                            </div>
                        </div>

                        <?php $__currentLoopData = $ratings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $rating = $item->rating;
                                $rating = number_format($rating, 1);
                            ?>
                            <div class="col-md-2">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="text-center">Rating</h5>
                                    </div>
                                    <div class="col-md-12">
                                        <h1 class="text-center"><i class="fas fa-star text-warning"></i> <?php echo e($rating); ?></h1>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <div class="col-md-2">
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(Auth::user()->role == 'restoran'): ?>
                                    <div class="text-center">
                                        <i type="button" class="bi bi-plus-circle text-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal" style="font-size: 5rem;"></i>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <button class="btn btn-success float-end mx-2" data-bs-toggle="modal" data-bs-target="#cariMenu"> <i
            class="fas fa-search"></i> Cari Menu</button>
    <button class="btn btn-dark float-end mx-2" data-bs-toggle="modal" data-bs-target="#reviewResto"> <i
            class="fas fa-users"></i> Review Resto</button>
    <button class="btn tombol float-end mx-2" data-bs-toggle="modal" data-bs-target="#komenResto"> <i
            class="fas fa-plus"></i> Tambah Komen</button>
    <?php if(auth()->guard()->check()): ?>
        <?php if(Auth::user()->role == 'user'): ?>
            <button class="btn btn-warning float-end mx-2" data-bs-toggle="modal" data-bs-target="#ratingResto"> <i
            class="fas fa-star"></i> Beri Rating</button>
        <?php endif; ?>
    <?php endif; ?>
    <?php if(auth()->guard()->guest()): ?>
        <button class="btn btn-warning float-end mx-2" onclick="cekLogin()"> <i
            class="fas fa-star"></i> Beri Rating</button>
    <?php endif; ?>

    <br><br>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-3">
                <div class="card p-3">

                    <?php if(auth()->guard()->check()): ?>
                        <?php if(Auth::user()->role == 'restoran'): ?>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#jenisMenu"> <i
                                    class="fas fa-plus"></i> Jenis Menu</button>
                        <?php endif; ?>
                    <?php endif; ?>

                    <br>
                    <?php $__currentLoopData = $jenis_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row">
                            <div class="col-md-9">
                                <h5 class="float-start"><?php echo e($r->nama); ?></h5>
                            </div>
                            <div class="col-md-3 float-end">
                                <?php if(auth()->guard()->check()): ?>
                                    <?php if(Auth::user()->role == 'restoran'): ?>
                                        <form action="<?php echo e(url('restoran/menu/jenis-menu/hapus/' . $r->id)); ?>" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Apakah anda yakin MENGHAPUS Menu ini ?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger btn-sm float-end"><i
                                                    class="fas fa-trash"></i></button>
                                        </form>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 float-start">

                                <?php
                                    $list_menu = DB::table('menus')
                                        ->where('restoran_id','=', $id)
                                        ->where('jenis_menu_id','=',$r->id)
                                        ->where('jenis_menu_id','!=',NULL)
                                        ->get();
                                ?>
                                <ul>
                                    <?php $__currentLoopData = $list_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jMenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li><?php echo e($jMenu->nama_menu); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
            <div class="col-md-9">
                <div class="row row-cols-1 row-cols-md-3 g-4">

                    <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="<?php echo e(asset('images/menu/' . $item->gambar)); ?>" class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($item->nama_menu); ?></h5>
                                    <p class="card-text">Rp.<?php echo e($item->harga); ?></p>

                                    <center>
                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(Auth::user()->role == 'restoran'): ?>
                                                <a href="<?php echo e(url('restoran/menu/edit/' . $item->id . '/' . $id)); ?>"
                                                    class="btn btn-warning"><i class="fas fa-edit"></i> Edit
                                                </a>
                                                <form action="<?php echo e(url('restoran/menu/hapus/' . $item->id)); ?>" method="POST"
                                                    class="d-inline"
                                                    onsubmit="return confirm('Apakah anda yakin MENGHAPUS data ini ?')">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i>
                                                        Hapus
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <a href="<?php echo e(url('restoran/menu/detail/' . $item->id . '/' . $id)); ?>"
                                            class="btn btn-info"><i class="fas fa-info-circle"></i> Review
                                        </a>

                                    </center>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
            </div>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="jenisMenu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Jenis Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('restoran/menu/jenis-menu')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Jenis Menu</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="nama"
                                name="nama">
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


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?php echo e(url('restoran/menu/upload-menu')); ?>" method="post" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
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
                                <option selected>Pilih ----</option>
                                <?php $__currentLoopData = $jenis_menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($item->id); ?>"><?php echo e($item->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="menu" class="form-label">Nama Menu</label>
                            <input type="text" class="form-control <?php $__errorArgs = ['menu'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="menu"
                                name="menu" placeholder="Masukan menu ..." value="<?php echo e(old('menu')); ?>">
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
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="harga" name="harga" placeholder="Masukan harga ..."
                                value="<?php echo e(old('harga')); ?>">
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
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                id="gambar" name="gambar" placeholder="Masukan gambar ..."
                                value="<?php echo e(old('gambar')); ?>">
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
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="deskripsi" name="deskripsi"
                                placeholder="Masukan deskripsi Restoran..." value="<?php echo e(old('deskripsi')); ?>"></textarea>

                        </div>
                        <input type="hidden" name="restoran_id" value="<?php echo e($id); ?>">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade modal-lg" id="cariMenu" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Daftar Menu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="example" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama Menu</th>
                                <th>Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(url('restoran/menu/edit/' . $item->id . '/' . $id)); ?>">
                                            <?php echo e($item->nama_menu); ?>

                                        </a>
                                    </td>
                                    <td>Rp. <?php echo e($item->harga); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-lg" id="reviewResto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Review Restaurant</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="review" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nama User</th>
                                <th>Review</th>
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade modal-lg" id="komenResto" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Komen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('review-resto/' . $id)); ?>" method="post">
                        <?php echo csrf_field(); ?>
                        <label for="review" class="form-label fw-bold fs-5">Review Restoran</label>
                        <textarea class="form-control" name="review" id="review" placeholder="Enter Your Review..."></textarea>
                        <?php if(auth()->guard()->check()): ?>
                            <input type="hidden" name="user_id" id="" value="<?php echo e(Auth::user()->id); ?>">
                        <?php endif; ?>
                        <div class="text-end mt-3">

                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
    <!-- Modal -->
    <div class="modal fade" id="ratingResto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Rating</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?php echo e(url('restoran/menu/rating/' . $id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="mb-3">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="1">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="2">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="3">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="4">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 4</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="rating" id="rating1"
                                    value="5">
                                <label class="form-check-label" for="rating1"><i class="fas fa-star"></i> 5</label>
                            </div>
                            <?php if(auth()->guard()->check()): ?>
                                <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>">
                            <?php endif; ?>



                        </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <?php if(auth()->guard()->check()): ?>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    <?php endif; ?>
                    <?php if(auth()->guard()->guest()): ?>
                        <button class="btn btn-secondary" onclick="cekLogin()"> Submit</button>
                    <?php endif; ?>
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
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#review').DataTable();
        });
    </script>

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

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/menu/menuRestoran.blade.php ENDPATH**/ ?>