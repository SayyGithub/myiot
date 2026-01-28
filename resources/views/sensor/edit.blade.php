<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Data Sensor - Gaming Edition</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Gaming Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700;900&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1a2e 50%, #16213e 100%);
            color: #00ff88;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        /* Animated Background Grid */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 255, 136, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 255, 136, 0.03) 1px, transparent 1px);
            background-size: 50px 50px;
            animation: gridMove 20s linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes gridMove {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        /* Glowing particles effect */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 30%, rgba(0, 255, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 80% 70%, rgba(255, 0, 255, 0.1) 0%, transparent 30%),
                radial-gradient(circle at 50% 50%, rgba(0, 255, 136, 0.05) 0%, transparent 40%);
            animation: particleFloat 15s ease-in-out infinite;
            pointer-events: none;
            z-index: 0;
        }

        @keyframes particleFloat {
            0%, 100% { opacity: 0.3; transform: scale(1); }
            50% { opacity: 0.6; transform: scale(1.1); }
        }

        .navbar {
            position: relative;
            width: 100%;
            padding: 20px 40px;
            background: rgba(10, 14, 39, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 2px solid rgba(0, 255, 136, 0.3);
            display: flex;
            gap: 32px;
            z-index: 10;
            box-shadow: 0 4px 30px rgba(0, 255, 136, 0.1);
        }

        .navbar::before {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, 
                transparent 0%, 
                #00ff88 20%, 
                #00ffff 50%, 
                #00ff88 80%, 
                transparent 100%);
            animation: navGlow 3s ease-in-out infinite;
        }

        @keyframes navGlow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 1; }
        }

        .navbar a {
            position: relative;
            text-decoration: none;
            color: #00ff88;
            font-weight: 700;
            font-size: 18px;
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 8px 16px;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .navbar a::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.2), transparent);
            transition: left 0.5s ease;
        }

        .navbar a:hover {
            color: #00ffff;
            text-shadow: 0 0 10px #00ffff, 0 0 20px #00ffff, 0 0 30px #00ffff;
            transform: translateY(-2px);
        }

        .navbar a:hover::before {
            left: 100%;
        }

        .container {
            position: relative;
            padding: 48px;
            z-index: 1;
            max-width: 800px;
        }

        h1 {
            font-family: 'Orbitron', sans-serif;
            font-size: 48px;
            font-weight: 900;
            color: #00ff88;
            text-transform: uppercase;
            letter-spacing: 4px;
            margin-bottom: 48px;
            text-shadow: 
                0 0 10px #00ff88,
                0 0 20px #00ff88,
                0 0 30px #00ff88,
                0 0 40px rgba(0, 255, 136, 0.5);
            animation: slideDown 0.8s ease-out, textGlow 2s ease-in-out infinite;
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes textGlow {
            0%, 100% { 
                text-shadow: 
                    0 0 10px #00ff88,
                    0 0 20px #00ff88,
                    0 0 30px #00ff88;
            }
            50% { 
                text-shadow: 
                    0 0 20px #00ff88,
                    0 0 30px #00ff88,
                    0 0 40px #00ff88,
                    0 0 50px rgba(0, 255, 136, 0.8);
            }
        }

        h1::before {
            content: '[ ';
            color: #00ffff;
        }

        h1::after {
            content: ' ]';
            color: #00ffff;
        }

        /* Error Alert Styling */
        .error-alert {
            background: rgba(255, 0, 100, 0.15);
            border: 2px solid rgba(255, 0, 100, 0.6);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 32px;
            animation: errorPulse 2s ease-in-out infinite, fadeIn 0.5s ease-out;
            position: relative;
            overflow: hidden;
            clip-path: polygon(8px 0, 100% 0, 100% calc(100% - 8px), calc(100% - 8px) 100%, 0 100%, 0 8px);
        }

        @keyframes errorPulse {
            0%, 100% { 
                box-shadow: 0 0 20px rgba(255, 0, 100, 0.3);
            }
            50% { 
                box-shadow: 0 0 30px rgba(255, 0, 100, 0.6);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-alert::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 0, 100, 0.2), transparent);
            animation: errorScan 2s linear infinite;
        }

        @keyframes errorScan {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .error-alert div {
            color: #ff0064;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 8px;
            text-shadow: 0 0 10px rgba(255, 0, 100, 0.5);
            position: relative;
        }

        .error-alert div:last-child {
            margin-bottom: 0;
        }

        .error-alert div::before {
            content: '⚠ ';
            color: #ff0064;
            margin-right: 8px;
        }

        /* Form Styling */
        form {
            background: rgba(10, 14, 39, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(0, 255, 136, 0.3);
            border-radius: 12px;
            padding: 40px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            animation: fadeIn 1s ease-out;
            position: relative;
        }

        form::before,
        form::after {
            content: '';
            position: absolute;
            width: 40px;
            height: 40px;
            border: 2px solid rgba(0, 255, 136, 0.4);
        }

        form::before {
            top: 10px;
            left: 10px;
            border-right: none;
            border-bottom: none;
        }

        form::after {
            bottom: 10px;
            right: 10px;
            border-left: none;
            border-top: none;
        }

        .form-group {
            margin-bottom: 32px;
            max-width: 100%;
            animation: slideRight 0.6s ease-out backwards;
        }

        .form-group:nth-child(1) { animation-delay: 0.2s; }
        .form-group:nth-child(2) { animation-delay: 0.3s; }

        @keyframes slideRight {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        label {
            display: block;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 12px;
            color: #00ffff;
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }

        label::after {
            content: ' :';
        }

        input {
            width: 100%;
            padding: 14px 18px;
            border-radius: 0;
            border: 2px solid rgba(0, 255, 136, 0.3);
            font-size: 16px;
            font-weight: 600;
            background: rgba(10, 14, 39, 0.8);
            color: #00ff88;
            font-family: 'Rajdhani', sans-serif;
            transition: all 0.3s ease;
            clip-path: polygon(6px 0, 100% 0, 100% calc(100% - 6px), calc(100% - 6px) 100%, 0 100%, 0 6px);
            position: relative;
        }

        input::placeholder {
            color: rgba(0, 255, 136, 0.4);
        }

        input:focus {
            outline: none;
            border-color: #00ffff;
            background: rgba(10, 14, 39, 0.95);
            box-shadow: 
                0 0 20px rgba(0, 255, 255, 0.3),
                inset 0 0 20px rgba(0, 255, 255, 0.1);
            transform: translateY(-2px);
        }

        input:hover {
            border-color: rgba(0, 255, 136, 0.6);
        }

        .btn {
            position: relative;
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.2) 0%, rgba(0, 255, 255, 0.2) 100%);
            color: #00ff88;
            border: 2px solid #00ff88;
            padding: 16px 40px;
            border-radius: 0;
            font-size: 18px;
            font-weight: 700;
            font-family: 'Orbitron', sans-serif;
            text-transform: uppercase;
            letter-spacing: 3px;
            cursor: pointer;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 0 20px rgba(0, 255, 136, 0.3);
            clip-path: polygon(12px 0, 100% 0, 100% calc(100% - 12px), calc(100% - 12px) 100%, 0 100%, 0 12px);
            margin-top: 16px;
            animation: buttonAppear 0.8s ease-out 0.5s backwards;
        }

        @keyframes buttonAppear {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 255, 136, 0.4), transparent);
            transition: left 0.5s ease;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 0;
            height: 0;
            background: rgba(0, 255, 255, 0.3);
            border-radius: 50%;
            transition: width 0.5s ease, height 0.5s ease;
        }

        .btn:hover {
            background: linear-gradient(135deg, rgba(0, 255, 136, 0.4) 0%, rgba(0, 255, 255, 0.4) 100%);
            border-color: #00ffff;
            color: #00ffff;
            transform: translateY(-4px);
            box-shadow: 
                0 0 40px rgba(0, 255, 136, 0.6),
                0 8px 25px rgba(0, 0, 0, 0.5);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn:hover::after {
            width: 300px;
            height: 300px;
        }

        .btn:active {
            transform: translateY(-2px);
            box-shadow: 
                0 0 30px rgba(0, 255, 136, 0.5),
                0 4px 15px rgba(0, 0, 0, 0.5);
        }

        /* Corner decorations */
        .container::before,
        .container::after {
            content: '';
            position: absolute;
            width: 100px;
            height: 100px;
            border: 2px solid rgba(0, 255, 136, 0.3);
            z-index: 0;
        }

        .container::before {
            top: 20px;
            left: 20px;
            border-right: none;
            border-bottom: none;
            animation: cornerPulse 3s ease-in-out infinite;
        }

        .container::after {
            bottom: 20px;
            right: 20px;
            border-left: none;
            border-top: none;
            animation: cornerPulse 3s ease-in-out infinite 1.5s;
        }

        @keyframes cornerPulse {
            0%, 100% { 
                opacity: 0.3;
                transform: scale(1);
            }
            50% { 
                opacity: 1;
                transform: scale(1.1);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                padding: 16px 20px;
                gap: 20px;
                flex-wrap: wrap;
            }

            .navbar a {
                font-size: 14px;
                padding: 6px 12px;
            }

            .container {
                padding: 24px;
            }

            h1 {
                font-size: 32px;
                letter-spacing: 2px;
                margin-bottom: 32px;
            }

            form {
                padding: 24px;
            }

            .form-group {
                margin-bottom: 24px;
            }

            .btn {
                width: 100%;
                padding: 14px 24px;
                font-size: 16px;
            }

            input {
                padding: 12px 14px;
                font-size: 14px;
            }
        }

        /* Loading spinner for submit */
        .btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(0, 255, 136, 0.3);
            border-top-color: #00ffff;
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
        }

        @keyframes spin {
            to { transform: translateY(-50%) rotate(360deg); }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <div class="navbar">
        <a href="{{ route('sensor.index') }}">Home</a>
        <a href="{{ route('sensor.create') }}">Tambah Data</a>
    </div>

    <!-- Content -->
    <div class="container">
        <h1>Tambah Data Sensor</h1>


@if ($errors->any())
    <div class="error-alert">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
<form action="{{ route('sensor.update', $sensor->id) }}" method="POST">
    @csrf
    @method('PUT')


    <div class="form-group">
        <label>Nama Sensor</label>
        <input type="text"
       name="nama_sensor"
       value="{{ old('nama_sensor', $sensor->nama_sensor) }}"
       required>

<input type="number"
       name="data"
       value="{{ old('data', $sensor->data) }}"
       required>


    <button type="submit" class="btn">Update</button>

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

</body>
</html>