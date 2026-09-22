<?php $__env->startSection('title', 'Galeri - BPS Provinsi Sulawesi Selatan'); ?>

<?php $__env->startSection('content'); ?>
<main class="gallery-page">
    <div class="gallery-header">
        <span class="eyebrow">DOKUMENTASI</span>
        <h1>Galeri BPS Provinsi Sulawesi Selatan</h1>
        <p>Dokumentasi kegiatan dan aktivitas BPS Provinsi Sulawesi Selatan.</p>
    </div>

    <div class="gallery-grid">
        <?php $__currentLoopData = ['gambar5.jpg','gambar6.jpg','gambar7.jpg','gambar8.jpg','gambar9.jpg','gambar10.jpg']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="gallery-card">
                <img src="<?php echo e(asset('assets/img/'.$image)); ?>" alt="Dokumentasi BPS <?php echo e($index + 1); ?>" loading="lazy">
                <div class="gallery-card-body">
                    <h3>Dokumentasi BPS</h3>
                    <p>BPS Provinsi Sulawesi Selatan</p>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\webbps_laravel_bps_p\resources\views/galeri/index.blade.php ENDPATH**/ ?>