<!-- resources/views/layout/main.blade.php -->

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo $__env->yieldContent('title', 'MyIoT Dashboard'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Gaming Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700;900&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">
 <style>

           * { box-sizing: border-box; margin: 0; padding: 0; } body { font-family: 'Rajdhani', sans-serif; background: linear-gradient(135deg, #0a0e27 0%, #1a1a2e 50%, #16213e 100%); color: #00ff88; min-height: 100vh; position: relative; overflow-x: hidden; } /* Animated Background Grid */ body::before { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-image: linear-gradient(rgba(0, 255, 136, 0.03) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 255, 136, 0.03) 1px, transparent 1px); background-size: 50px 50px; animation: gridMove 20s linear infinite; pointer-events: none; z-index: 0; } @keyframes gridMove { 0% { transform: translate(0, 0); } 100% { transform: translate(50px, 50px); } } /* Glowing particles effect */ body::after { content: ''; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-image: radial-gradient(circle at 20% 30%, rgba(0, 255, 255, 0.1) 0%, transparent 30%), radial-gradient(circle at 80% 70%, rgba(255, 0, 255, 0.1) 0%, transparent 30%), radial-gradient(circle at 50% 50%, rgba(0, 255, 136, 0.05) 0%, transparent 40%); animation: particleFloat 15s ease-in-out infinite; pointer-events: none; z-index: 0; } @keyframes particleFloat { 0%, 100% { opacity: 0.3; transform: scale(1); } 50% { opacity: 0.6; transform: scale(1.1); } } .navbar { position: relative; width: 100%; padding: 20px 40px; background: rgba(10, 14, 39, 0.8); backdrop-filter: blur(10px); border-bottom: 2px solid rgba(0, 255, 136, 0.3); display: flex; gap: 32px; z-index: 10; box-shadow: 0 4px 30px rgba(0, 255, 136, 0.1); } .navbar::before { content: ''; position: absolute; bottom: -2px; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, transparent 0%, #00ff88 20%, #00ffff 50%, #00ff88 80%, transparent 100%); animation: navGlow 3s ease-in-out infinite; } @keyframes navGlow { 0%, 100% { opacity: 0.5; } 50% { opacity: 1; } } .navbar a { position: relative; text-decoration: none; color: #00ff88; font-weight: 700; font-size: 18px; font-family: 'Orbitron', sans-serif; text-transform: uppercase; letter-spacing: 2px; padding: 8px 16px; transition: all 0.3s ease; overflow: hidden; } .navbar a::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.2), transparent); transition: left 0.5s ease; } .navbar a:hover { color: #00ffff; text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff; transform: translateY(-2px); } .navbar a:hover::before { left: 100%; } .container { position: relative; padding: 48px; z-index: 1; } .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; animation: slideDown 0.8s ease-out; } @keyframes slideDown { from { opacity: 0; transform: translateY(-30px); } to { opacity: 1; transform: translateY(0); } } .header h1 { font-family: 'Orbitron', sans-serif; font-size: 48px; font-weight: 900; color: #00ff88; text-transform: uppercase; letter-spacing: 4px; text-shadow: 0 0 10px #00ff88, 0 0 20px #00ff88, 0 0 30px #00ff88, 0 0 40px rgba(0, 255, 136, 0.5); position: relative; animation: textGlow 2s ease-in-out infinite; } @keyframes textGlow { 0%, 100% { text-shadow: 0 0 10px #00ff88, 0 0 20px #00ff88, 0 0 30px #00ff88; } 50% { text-shadow: 0 0 20px #00ff88, 0 0 30px #00ff88, 0 0 40px #00ff88, 0 0 50px rgba(0, 255, 136, 0.8); } } .header h1::before { content: '[ '; color: #00ffff; } .header h1::after { content: ' ]'; color: #00ffff; } .btn { position: relative; background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 255, 255, 0.2) 100%); color: #00ff88; border: 2px solid #00ff88; padding: 14px 28px; border-radius: 0; font-size: 16px; font-weight: 700; font-family: 'Orbitron', sans-serif; text-transform: uppercase; letter-spacing: 2px; cursor: pointer; text-decoration: none; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 0 20px rgba(0, 255, 136, 0.3); clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px); } .btn::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.4), transparent); transition: left 0.5s ease; } .btn:hover { background: linear-gradient(135deg, rgba(0, 255, 136, 0.4) 0%, rgba(0, 255, 255, 0.4) 100%); border-color: #00ffff; color: #00ffff; transform: translateY(-3px); box-shadow: 0 0 30px rgba(0, 255, 136, 0.6), 0 5px 20px rgba(0, 0, 0, 0.4); } .btn:hover::before { left: 100%; } .btn:active { transform: translateY(-1px); } table { width: 100%; border-collapse: separate; border-spacing: 0; margin-top: 24px; background: rgba(10, 14, 39, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(0, 255, 136, 0.3); border-radius: 8px; overflow: hidden; box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4); animation: fadeIn 1s ease-out; } @keyframes fadeIn { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } } th, td { text-align: left; padding: 20px 24px; border-bottom: 1px solid rgba(0, 255, 136, 0.2); font-size: 18px; font-weight: 600; position: relative; } th { background: linear-gradient(135deg, rgba(0, 255, 136, 0.15) 0%, rgba(0, 255, 255, 0.15) 100%); color: #00ffff; font-family: 'Orbitron', sans-serif; text-transform: uppercase; letter-spacing: 2px; font-size: 16px; font-weight: 700; border-bottom: 2px solid rgba(0, 255, 136, 0.5); } th::after { content: ''; position: absolute; bottom: -2px; left: 0; width: 0%; height: 2px; background: #00ffff; transition: width 0.3s ease; } th:hover::after { width: 100%; } tr { transition: all 0.3s ease; } tr:not(:first-child):hover { background: rgba(0, 255, 136, 0.1); transform: scale(1.01); box-shadow: inset 0 0 20px rgba(0, 255, 136, 0.1); } tr:not(:first-child):hover td { color: #00ffff; text-shadow: 0 0 10px rgba(0, 255, 255, 0.5); } tr:last-child td { border-bottom: none; } td { color: #00ff88; position: relative; } td::before { content: ''; position: absolute; left: 0; top: 50%; transform: translateY(-50%); width: 3px; height: 0%; background: linear-gradient(180deg, transparent, #00ff88, transparent); transition: height 0.3s ease; } tr:hover td::before { height: 80%; } /* Scan line effect */ @keyframes scanline { 0% { top: 0%; } 100% { top: 100%; } } table::after { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 2px; background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.8), transparent); animation: scanline 3s linear infinite; pointer-events: none; } /* Corner decorations */ .container::before, .container::after { content: ''; position: absolute; width: 100px; height: 100px; border: 2px solid rgba(0, 255, 136, 0.3); z-index: 0; } .container::before { top: 20px; left: 20px; border-right: none; border-bottom: none; animation: cornerPulse 3s ease-in-out infinite; } .container::after { bottom: 20px; right: 20px; border-left: none; border-top: none; animation: cornerPulse 3s ease-in-out infinite 1.5s; } @keyframes cornerPulse { 0%, 100% { opacity: 0.3; transform: scale(1); } 50% { opacity: 1; transform: scale(1.1); } } /* Responsive */ @media (max-width: 768px) { .navbar { padding: 16px 20px; gap: 20px; flex-wrap: wrap; } .navbar a { font-size: 14px; padding: 6px 12px; } .container { padding: 24px; } .header { flex-direction: column; gap: 20px; align-items: flex-start; } .header h1 { font-size: 32px; letter-spacing: 2px; } th, td { padding: 12px 16px; font-size: 16px; } th { font-size: 14px; } } /* Loading animation for data */ @keyframes dataLoad { 0% { opacity: 0; transform: translateX(-20px); } 100% { opacity: 1; transform: translateX(0); } } tbody tr { animation: dataLoad 0.5s ease-out backwards; } tbody tr:nth-child(1) { animation-delay: 0.1s; } tbody tr:nth-child(2) { animation-delay: 0.2s; } tbody tr:nth-child(3) { animation-delay: 0.3s; } tbody tr:nth-child(4) { animation-delay: 0.4s; } tbody tr:nth-child(5) { animation-delay: 0.5s; } .action-group { display: flex; gap: 12px; } .action-btn { position: relative; padding: 8px 18px; font-family: 'Orbitron', sans-serif; font-size: 14px; letter-spacing: 1px; text-transform: uppercase; cursor: pointer; border: 2px solid; background: transparent; color: #00ff88; overflow: hidden; transition: all 0.3s ease; clip-path: polygon(8px 0, 100% 0, 100% calc(100% - 8px), calc(100% - 8px) 100%, 0 100%, 0 8px); } .action-btn::before { content: ''; position: absolute; top: 0; left: -100%; width: 100%; height: 100%; background: linear-gradient(90deg, transparent, rgba(0,255,136,0.4), transparent); transition: left 0.4s ease; } .action-btn:hover::before { left: 100%; } .btn-edit { border-color: #00ffff; color: #00ffff; } .btn-edit:hover { background: rgba(0, 255, 255, 0.2); box-shadow: 0 0 15px rgba(0, 255, 255, 0.7); transform: translateY(-2px); } .btn-delete { border-color: #ff004c; color: #ff004c; } .btn-delete:hover { background: rgba(255, 0, 76, 0.2); box-shadow: 0 0 15px rgba(255, 0, 76, 0.8); transform: translateY(-2px); } td.action-cell { text-align: right; vertical-align: middle; } .action-group { display: inline-flex; justify-content: flex-end; align-items: center; gap: 12px; }

.navbar {
    justify-content: space-between;
    align-items: center;
}

.nav-left,
.nav-right {
    display: flex;
    align-items: center;
    gap: 24px;
}

.user-badge {
    font-family: 'Orbitron', sans-serif;
    color: #00ffff;
    font-weight: 700;
    letter-spacing: 1px;
    text-shadow: 0 0 10px #00ffff;
}

.nav-action {
    font-size: 14px !important;
    color: #00ff88 !important;
}

.logout-btn {
    background: transparent;
    border: 2px solid #ff004c;
    color: #ff004c;
    padding: 8px 18px;
    font-family: 'Orbitron', sans-serif;
    font-weight: 700;
    text-transform: uppercase;
    cursor: pointer;
    clip-path: polygon(
        8px 0,
        100% 0,
        100% calc(100% - 8px),
        calc(100% - 8px) 100%,
        0 100%,
        0 8px
    );
}

.logout-btn:hover {
    background: rgba(255, 0, 76, 0.2);
    box-shadow: 0 0 15px rgba(255, 0, 76, 0.8);
}

/* RESET PASSWORD FORM */

.form-card {
    width: 100%;
    max-width: 560px;
    padding: 34px;
    background: rgba(10, 14, 39, 0.75);
    border: 2px solid rgba(0, 255, 136, 0.45);
    box-shadow: 0 0 30px rgba(0, 255, 136, 0.25);

    clip-path: polygon(
        16px 0,
        100% 0,
        100% calc(100% - 16px),
        calc(100% - 16px) 100%,
        0 100%,
        0 16px
    );
}

.form-control {
    margin-bottom: 22px;
}

.form-control label {
    display: block;
    margin-bottom: 8px;

    font-family: 'Orbitron', sans-serif;
    color: #00ffff;
    font-size: 14px;
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
}

.form-control input {
    width: 100%;
    height: 50px;

    padding: 12px 16px;

    background: rgba(0, 0, 0, 0.35);

    border: 2px solid #00ff88;

    color: #00ff88;

    font-family: 'Rajdhani', sans-serif;
    font-size: 18px;
    font-weight: 700;

    outline: none;

    transition: all 0.3s ease;
}

.form-control input:focus {
    border-color: #00ffff;

    box-shadow:
        0 0 10px rgba(0,255,255,.5),
        0 0 20px rgba(0,255,255,.3);
}

.error-text {
    margin-top: 8px;

    color: #ff004c;

    font-weight: 700;
}

</style>

    <?php echo $__env->yieldPushContent('styles'); ?>
    
</head>
<body>

    <!-- Navbar Universal -->
    <div class="navbar">
    <div class="nav-left">
        <a href="<?php echo e(route('beranda')); ?>">Beranda</a>
        <a href="<?php echo e(route('sensor.index')); ?>">Data Sensor</a>
        <a href="<?php echo e(route('device.index')); ?>">Data Device</a>
    </div>

    <div class="nav-right">
        <?php if(auth()->guard()->check()): ?>
            <span class="user-badge">
                <?php echo e(Auth::user()->name); ?> | <?php echo e(strtoupper(Auth::user()->role)); ?>

            </span>

            <?php if(Auth::user()->role !== 'admin'): ?>
    <a href="<?php echo e(route('password.user.edit')); ?>" class="nav-action">
        Reset Password
    </a>
<?php endif; ?>

            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        <?php endif; ?>
    </div>
</div>

    <!-- Main Content -->
    <div class="container">
        <?php echo $__env->yieldContent('content'); ?>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html> <?php /**PATH C:\Users\zaysm\Pictures\myIot\resources\views/layout/main.blade.php ENDPATH**/ ?>