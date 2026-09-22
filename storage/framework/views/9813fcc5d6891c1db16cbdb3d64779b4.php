<?php $__env->startSection('title', 'Daftar Publikasi - BPS Sulawesi Selatan'); ?>

<?php $__env->startSection('content'); ?>
<main>
    <div class="page-header d-flex justify-content-between align-items-end gap-3 flex-wrap">
        <div>
            <span class="eyebrow">DATABASE WEBSITE</span>
            <h1>Daftar Publikasi</h1>
            <p>Publikasi BPS Provinsi Sulawesi Selatan yang tersimpan pada database website.</p>
        </div>
        <a href="<?php echo e(route('publikasi.create')); ?>" class="btn btn-primary">+ Tambah Publikasi</a>
    </div>

    <form method="GET" action="<?php echo e(route('publikasi.index')); ?>" class="mb-4">
        <div class="input-group">
            <input type="text" name="q" value="<?php echo e($keyword); ?>" class="form-control" placeholder="Cari judul publikasi..." aria-label="Cari judul publikasi">
            <button class="btn btn-outline-primary" type="submit">Cari</button>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tanggal Rilis</th>
                    <th>Sampul</th>
                    <th>Link</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $publikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($item->no ?? $item->id); ?></td>
                    <td>
                        <strong style="color:#263b5d"><?php echo e($item->judul); ?></strong>
                    </td>
                    <td><?php echo e(optional($item->tanggal_rilis)->format('d/m/Y')); ?></td>
                    <td style="width:110px">
                        <?php if($item->sampul): ?>
                            <img src="<?php echo e(asset('storage/'.$item->sampul)); ?>" alt="<?php echo e($item->judul); ?>" style="width:70px;height:92px;object-fit:cover">
                        <?php else: ?>
                            <span style="color:#8a9aab">Tidak ada</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($item->link): ?>
                            <a href="<?php echo e($item->link); ?>" target="_blank" rel="noopener" class="section-link">Buka ↗</a>
                        <?php else: ?>
                            <span style="color:#9aa8b7">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="text-nowrap">
                        <a href="<?php echo e(route('publikasi.edit',$item)); ?>" class="btn btn-warning btn-sm">Edit</a>
                        <form action="<?php echo e(route('publikasi.destroy',$item)); ?>" method="POST" style="display:inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus publikasi ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-5">Belum ada publikasi.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo e($publikasi->links()); ?>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\webbps_laravel_bps_p\resources\views/publikasi/index.blade.php ENDPATH**/ ?>