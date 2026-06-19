

<?php $__env->startSection('title', 'Tambah Data Sensor'); ?>

<?php $__env->startPush('styles'); ?>
    <style>
  
.create-wrapper {
    max-width: 720px;
    margin-top: 40px;
    padding: 40px;
    background: rgba(10, 14, 39, 0.75);
    backdrop-filter: blur(12px);
    border: 2px solid rgba(0, 255, 136, 0.25);
    border-radius: 12px;
    box-shadow:
        0 0 25px rgba(0, 255, 136, 0.15),
        inset 0 0 20px rgba(0, 255, 255, 0.03);
    position: relative;
    animation: fadeIn 0.8s ease-out;
}

.create-wrapper::before,
.create-wrapper::after {
    content: '';
    position: absolute;
    width: 60px;
    height: 60px;
    border: 2px solid rgba(0, 255, 136, 0.35);
}

.create-wrapper::before {
    top: 12px;
    left: 12px;
    border-right: none;
    border-bottom: none;
}

.create-wrapper::after {
    bottom: 12px;
    right: 12px;
    border-left: none;
    border-top: none;
}

.create-wrapper h1 {
    font-family: 'Orbitron', sans-serif;
    font-size: 52px;
    font-weight: 900;
    color: #00ff88;
    text-transform: uppercase;
    letter-spacing: 3px;
    margin-bottom: 35px;
    line-height: 1.2;
    text-shadow:
        0 0 12px #00ff88,
        0 0 24px rgba(0, 255, 136, 0.5);
    animation: textGlow 2s ease-in-out infinite;
}

.create-wrapper h1::before {
    content: '[ ';
    color: #00ffff;
}

.create-wrapper h1::after {
    content: ' ]';
    color: #00ffff;
}

.form-group {
    margin-bottom: 28px;
    position: relative;
}

.form-group label {
    display: block;
    margin-bottom: 10px;
    font-family: 'Orbitron', sans-serif;
    font-size: 18px;
    font-weight: 700;
    color: #00ffff;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 18px 20px;
    background: rgba(0, 10, 30, 0.9);
    border: 2px solid rgba(0, 255, 136, 0.3);
    color: #00ff88;
    font-size: 18px;
    font-family: 'Rajdhani', sans-serif;
    font-weight: 600;
    outline: none;
    transition: all 0.3s ease;
    box-shadow: inset 0 0 10px rgba(0, 255, 136, 0.05);
}

.form-group textarea {
    min-height: 140px;
    resize: vertical;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: #00ffff;
    box-shadow:
        0 0 20px rgba(0, 255, 255, 0.25),
        inset 0 0 10px rgba(0, 255, 255, 0.08);
    color: #00ffff;
    transform: scale(1.01);
}

.form-group input:hover,
.form-group select:hover,
.form-group textarea:hover {
    border-color: rgba(0, 255, 255, 0.5);
}

.error-alert {
    margin-bottom: 25px;
    padding: 16px 20px;
    background: rgba(255, 0, 76, 0.08);
    border: 1px solid rgba(255, 0, 76, 0.4);
    color: #ff4d6d;
    font-weight: 700;
    border-radius: 6px;
    box-shadow: 0 0 15px rgba(255, 0, 76, 0.15);
}

.error-alert div {
    margin-bottom: 6px;
}

.error-alert div:last-child {
    margin-bottom: 0;
}

.success-alert {
    margin-bottom: 25px;
    padding: 16px 20px;
    background: rgba(0, 255, 136, 0.08);
    border: 1px solid rgba(0, 255, 136, 0.4);
    color: #00ff88;
    font-weight: 700;
    border-radius: 6px;
    box-shadow: 0 0 15px rgba(0, 255, 136, 0.15);
}

.create-wrapper .btn {
    margin-top: 10px;
    min-width: 220px;
    font-size: 20px;
    padding: 16px 30px;
    display: inline-block;
    text-align: center;
}

.create-wrapper .btn:hover {
    transform: translateY(-3px) scale(1.02);
}

@media (max-width: 768px) {
    .create-wrapper {
        padding: 28px;
        margin-top: 20px;
    }

    .create-wrapper h1 {
        font-size: 34px;
        letter-spacing: 2px;
    }

    .form-group label {
        font-size: 15px;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        font-size: 16px;
        padding: 14px 16px;
    }

    .create-wrapper .btn {
        width: 100%;
        min-width: unset;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="create-wrapper">
    <h1>Tambah Data Sensor</h1>
<?php if($errors->any()): ?>
    <div class="error-alert">
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div><?php echo e($error); ?></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php endif; ?>

       <form action="<?php echo e(route('sensor.store')); ?>" method="POST" id="sensorForm">
    <?php echo csrf_field(); ?>

    <div class="form-group">
        <label>Nama Sensor</label>
        <input type="text" name="nama_sensor" required placeholder="Masukkan nama sensor...">
    </div>

    <div class="form-group">
        <label>Data</label>
        <input type="number" name="data" required placeholder="Masukkan nilai data...">
    </div>

    <button type="submit" class="btn" id="submitBtn">Submit</button>
</form>

    </div>

    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
           
            const inputs = document.querySelectorAll('input');
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    if (this.value) {
                        this.style.borderColor = '#00ffff';
                        this.style.boxShadow = '0 0 15px rgba(0, 255, 255, 0.2)';
                    } else {
                        this.style.borderColor = 'rgba(0, 255, 136, 0.3)';
                        this.style.boxShadow = 'none';
                    }
                });

             
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                    this.parentElement.style.transition = 'transform 0.3s ease';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

           
            const form = document.getElementById('sensorForm');
            const submitBtn = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                submitBtn.classList.add('loading');
                submitBtn.textContent = 'PROCESSING...';
                submitBtn.disabled = true;
            });

            const navLinks = document.querySelectorAll('.navbar a');
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    navLinks.forEach(l => l.style.color = '#00ff88');
                    this.style.color = '#00ffff';
                });
            });

 
            const title = document.querySelector('h1');
            setInterval(() => {
                if (Math.random() > 0.95) {
                    title.style.transform = 'translate(' + (Math.random() * 4 - 2) + 'px, ' + (Math.random() * 4 - 2) + 'px)';
                    setTimeout(() => {
                        title.style.transform = 'translate(0, 0)';
                    }, 50);
                }
            }, 100);

            document.addEventListener('mousemove', function(e) {
                if (Math.random() > 0.9) {
                    const trail = document.createElement('div');
                    trail.style.position = 'fixed';
                    trail.style.width = '4px';
                    trail.style.height = '4px';
                    trail.style.borderRadius = '50%';
                    trail.style.background = 'rgba(0, 255, 136, 0.6)';
                    trail.style.left = e.clientX + 'px';
                    trail.style.top = e.clientY + 'px';
                    trail.style.pointerEvents = 'none';
                    trail.style.zIndex = '9999';
                    trail.style.boxShadow = '0 0 10px rgba(0, 255, 136, 0.8)';
                    document.body.appendChild(trail);
                    
                    setTimeout(() => {
                        trail.style.transition = 'all 0.5s ease-out';
                        trail.style.opacity = '0';
                        trail.style.transform = 'scale(2)';
                    }, 10);
                    
                    setTimeout(() => {
                        trail.remove();
                    }, 510);
                }
            });

            
            inputs.forEach(input => {
                input.addEventListener('keydown', function(e) {
                
                    const flash = document.createElement('div');
                    flash.style.position = 'absolute';
                    flash.style.width = '100%';
                    flash.style.height = '100%';
                    flash.style.background = 'rgba(0, 255, 136, 0.1)';
                    flash.style.pointerEvents = 'none';
                    flash.style.top = '0';
                    flash.style.left = '0';
                    flash.style.zIndex = '-1';
                    
                    this.parentElement.style.position = 'relative';
                    this.parentElement.appendChild(flash);
                    
                    setTimeout(() => {
                        flash.remove();
                    }, 100);
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\zaysm\Pictures\myIot\resources\views/sensor/create.blade.php ENDPATH**/ ?>