

<?php $__env->startSection('title', 'Data Sensor'); ?>

<?php $__env->startSection('content'); ?>
    <div class="header">
        <h1>Data Sensor</h1>
        <?php if(Auth::user()->role === 'admin'): ?>
        <a href="<?php echo e(route('sensor.create')); ?>" class="btn">Tambah Data</a>
        <?php endif; ?>
    </div>

    <!-- table -->
     <table>
            <thead>
                <tr>
                    <th>Nama Sensor</th>
                    <th>Data</th>
                    
                    <?php if(Auth::user()->role === 'admin'): ?>
                <th>Aksi</th>
            <?php endif; ?>

                </tr>
            </thead>
          <tbody>
<?php $__empty_1 = true; $__currentLoopData = $sensors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sensor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <tr>
        <td><?php echo e($sensor->nama_sensor); ?></td>
        <td><?php echo e($sensor->data); ?></td>
            
        <?php if(Auth::user()->role === 'admin'): ?>
            <td class="action-cell">
                <div class="action-group">
                    <a href="<?php echo e(route('sensor.edit', $sensor->id)); ?>"
                       class="action-btn btn-edit">
                        Edit
                </a>

                <form action="<?php echo e(route('sensor.destroy', $sensor->id)); ?>"
                      method="POST"
                      onsubmit="return confirm('Yakin hapus data ini?')">
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
                    Belum ada data sensor
                </td>
    </tr>
<?php endif; ?>
</tbody>

        </table>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zaysm\Pictures\myIot\resources\views/sensor/index.blade.php ENDPATH**/ ?>