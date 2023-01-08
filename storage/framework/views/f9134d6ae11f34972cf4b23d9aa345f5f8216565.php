 <nav class="navbar navbar-expand-lg navbar-light bg-light">
     <div class="container">
         <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
             <img src="<?php echo e(asset('images/logoTitle.png')); ?>" alt="logo" width="30" height="24"
                 class="d-inline-block align-text-top">
             ManganLur
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav ms-auto">
                 <?php if(auth()->guard()->guest()): ?>
                     <li class="nav-item">
                         <a class="nav-link active" aria-current="page" href="<?php echo e(url('/')); ?>">Home</a>
                     </li>
                 <?php endif; ?>
                 <?php if(auth()->guard()->check()): ?>
                     <?php if(Auth::user()->role == 'user'): ?>
                         <li class="nav-item">
                             <a class="nav-link active" aria-current="page" href="<?php echo e(url('/')); ?>">Home</a>
                         </li>
                     <?php endif; ?>
                 <?php endif; ?>
                 <?php if(auth()->guard()->check()): ?>
                     <?php if(Auth::user()->role == 'restoran'): ?>
                         <li class="nav-item ">
                             <a class="nav-link " href="<?php echo e(url('/restoranku')); ?>">Restoranku</a>
                         </li>
                     <?php endif; ?>
                 <?php endif; ?>
                 <li class="nav-item">
                     <?php if(auth()->guard()->guest()): ?>
                         <div class="dropdown">
                             <button class=" btn btn-secondary dropdown-toggle tombol" type="button"
                                 id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-sign-in-alt"></i> Login
                             </button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                 <li>
                                     <a class="dropdown-item" href="<?php echo e(url('/login')); ?>">Sign in</a>

                                 </li>
                                 <li>
                                     <a class="dropdown-item" href="<?php echo e(url('/register')); ?>">Registrasi</a>
                                 </li>

                             </ul>
                         </div>
                     <?php endif; ?>
                     <?php if(auth()->guard()->check()): ?>
                         <div class="dropdown">
                             <button class="btn btn-secondary dropdown-toggle tombol" type="button"
                                 id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                 <i class="fas fa-User"></i> <?php echo e(Auth::user()->name); ?>

                             </button>
                             <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                 
                                 <li>
                                     <a class="dropdown-item" href="<?php echo e(url('/logout')); ?>">Logout</a>
                                 </li>

                             </ul>
                         </div>
                     <?php endif; ?>


                 </li>

             </ul>
         </div>
     </div>
 </nav>
<?php /**PATH E:\laragon\www\JOKI\manganlur\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>