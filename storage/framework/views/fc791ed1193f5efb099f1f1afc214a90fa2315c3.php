<?php
    $title = 'User Restoran - List';
?>



<?php $__env->startSection('content'); ?>
    <h3>List Restoran</h3>
    <a href="/tambah-resto" class="btn btn-success float-end">Tambah <i class="fas fa-plus"></i></a>
    <br>
    <br>
    <table class="table table-hover bg-light rounded-3" id="example">
        <thead class="">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Aksi</th>
                <th scope="col">Nama Restoran</th>
                <th scope="col">Alamat</th>
                <th scope="col">Jam Buka</th>
                <th scope="col">Jam Tutup</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th scope="row"><?php echo e($loop->iteration); ?></th>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="restoran/menu/<?php echo e($item->id); ?>" class="btn  btn-info"><i
                                    class="fas fa-book"></i></a>
                            <form action="restoran/hapus/<?php echo e($item->id); ?>" method="POST" class="d-inline"
                                onsubmit="return confirm('Apakah Anda Yakin Mengahus Data Ini ?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                            </form>
                            <a href="restoran/edit/<?php echo e($item->id); ?>" class="btn  btn-warning"><i
                                    class="fas fa-edit"></i></a>

                        </div>

                    </td>
                    <td><?php echo e($item->nama_resto); ?></td>
                    <td><?php echo e($item->alamat); ?></td>
                    <td><?php echo e($item->jam_buka); ?></td>
                    <td><?php echo e($item->jam_tutup); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/restoran/tabelRestoran.blade.php ENDPATH**/ ?>