<?php
    $title = 'Cari Restoran';
    
    $restoran = DB::table('rating')
        ->join('restorans', 'rating.restoran_id', '=', 'restorans.id')
        ->select(['restorans.*', DB::raw('AVG(rating.rating) as rating')])
        ->groupBy('rating.restoran_id')
        ->orderByDesc('rating')
        ->get();
?>


<?php $__env->startSection('content'); ?>
    <div class="container">
        <center>
            <button type="button" class="btn btn-success " data-bs-toggle="modal" data-bs-target="#exampleModal"><i
                    class="fas fa-search"></i> Cari Restoran
            </button>
        </center>
        <div class="row my-5">
            <?php $__currentLoopData = $restoran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card card-resto" style="width: 300px; height: 200px;">
                                <img class="m-auto" width="280px" height="180px"
                                    src="<?php echo e(asset('data_file/' . $item->gambar)); ?>" alt="">
                            </div>
                        </div>
                        <div class="col-md-6 my-auto">
                            <div class="card card-detail p-3">
                                <h4><?php echo e($item->nama_resto); ?></h4>
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <i class="bi bi-geo-alt-fill"></i>
                                    </div>
                                    <div class="col-10">
                                        <h6><?php echo e($item->alamat); ?></h6>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <i class="bi bi-clock"></i>
                                    </div>
                                    <div class="col-10">
                                        <h6><?php echo e($item->jam_buka); ?> - <?php echo e($item->jam_tutup); ?></h6>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-2">
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                    <div class="col-10">
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
                                    <a href="<?php echo e(url('restoran/menu/' . $item->id)); ?>"><button class="btn btn-primary">See
                                            Resto</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">List Restoran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table id="example" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Restoran</th>
                                    <th>Jam Buka</th>
                                    <th>Jam Tutup</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $restoran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td>
                                            <a href="<?php echo e(url('restoran/menu/' . $item->id)); ?>">
                                                <?php echo e($item->nama_resto); ?>

                                            </a>
                                        </td>
                                        <td><?php echo e($item->jam_buka); ?></td>
                                        <td><?php echo e($item->jam_tutup); ?></td>
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
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/content/restoran/restoRating.blade.php ENDPATH**/ ?>