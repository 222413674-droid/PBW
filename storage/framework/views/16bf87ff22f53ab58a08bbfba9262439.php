<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'BPS Provinsi Sulawesi Selatan'); ?></title>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/myCSS.css')); ?>">
    <?php echo app('Illuminate\Foundation\Vite')(['resources/sass/app.scss', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body>
<header>
    <img src="<?php echo e(asset('assets/img/bps.jpg')); ?>" alt="Logo BPS">
    <div class="judulweb">BPS PROVINSI SULAWESI SELATAN</div>
    <nav>
        <a class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>" href="<?php echo e(route('home')); ?>">Home</a>
        <a class="<?php echo e(request()->routeIs('publikasi.*') ? 'active' : ''); ?>" href="<?php echo e(route('publikasi.index')); ?>">Daftar Publikasi</a>
        <a href="<?php echo e(route('publikasi.create')); ?>">Tambah Publikasi</a>
        <a class="<?php echo e(request()->routeIs('galeri.*') ? 'active' : ''); ?>" href="<?php echo e(route('galeri.index')); ?>">Galeri</a>
       <form action="<?php echo e(route('logout')); ?>" method="POST" class="logout-form">
    <?php echo csrf_field(); ?>
    <button type="submit" class="nav-logout">Logout</button>
</form>    </nav>
</header>

<?php if(session('success')): ?>
    <div class="container mt-3"><div class="alert alert-success"><?php echo e(session('success')); ?></div></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="container mt-3"><div class="alert alert-danger"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div></div>
<?php endif; ?>

<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\webbps_laravel_bps\resources\views/layouts/app.blade.php ENDPATH**/ ?>