

<?php $__env->startSection('title', 'Data Device'); ?>

<?php $__env->startSection('content'); ?>

<div class="header">
    <h1>Data Device</h1>

    <?php if(Auth::user()->role === 'admin'): ?>
        <a href="<?php echo e(route('device.create')); ?>" class="btn">
            Tambah Device
        </a>
    <?php endif; ?>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Serial Number</th>
            <th>Topik</th>
            <th>Dibuat</th>

            <?php if(Auth::user()->role === 'admin'): ?>
                <th>Aksi</th>
            <?php endif; ?>
        </tr>
    </thead>

    <tbody>
        <?php $__empty_1 = true; $__currentLoopData = $devices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $device): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($device->id); ?></td>
                <td><?php echo e($device->serial_number); ?></td>
                <td><?php echo e($device->topik); ?></td>
                <td><?php echo e($device->created_at->format('d-m-Y H:i')); ?></td>

                <?php if(Auth::user()->role === 'admin'): ?>
                    <td class="action-cell">
                        <div class="action-group">
                            <a href="<?php echo e(route('device.edit', $device->id)); ?>" class="action-btn btn-edit">
                                Edit
                            </a>

                            <form action="<?php echo e(route('device.destroy', $device->id)); ?>" method="POST" onsubmit="return confirm('Hapus device ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>

                                <button type="submit" class="action-btn btn-delete">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="<?php echo e(Auth::user()->role === 'admin' ? 5 : 4); ?>" style="text-align:center; color:#00ffff;">
                    Belum ada device
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zaysm\Pictures\myIot\resources\views/device/index.blade.php ENDPATH**/ ?>