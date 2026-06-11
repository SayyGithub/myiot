<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>MyIoT Auth</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;600;700;900&family=Rajdhani:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: linear-gradient(135deg, #0a0e27 0%, #1a1a2e 50%, #16213e 100%);
            color: #00ff88;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image:
                linear-gradient(rgba(0,255,136,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0,255,136,.03) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 0;
        }

        .auth-card {
            position: relative;
            z-index: 1;
            width: 420px;
            padding: 36px;
            background: rgba(10, 14, 39, 0.85);
            border: 2px solid rgba(0, 255, 136, 0.4);
            box-shadow: 0 0 35px rgba(0,255,136,.25);
            clip-path: polygon(18px 0, 100% 0, 100% calc(100% - 18px), calc(100% - 18px) 100%, 0 100%, 0 18px);
        }

        .auth-title {
            font-family: 'Orbitron', sans-serif;
            text-align: center;
            font-size: 32px;
            margin-bottom: 28px;
            color: #00ff88;
            text-shadow: 0 0 15px #00ff88;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #00ffff;
            font-weight: 700;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 16px;
            background: rgba(0,0,0,.35);
            border: 1px solid #00ff88;
            color: #00ff88;
            outline: none;
            font-size: 16px;
        }

        input:focus {
            border-color: #00ffff;
            box-shadow: 0 0 12px rgba(0,255,255,.5);
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: rgba(0,255,136,.15);
            border: 2px solid #00ff88;
            color: #00ff88;
            font-family: 'Orbitron', sans-serif;
            font-weight: 700;
            cursor: pointer;
            text-transform: uppercase;
        }

        .btn:hover {
            color: #00ffff;
            border-color: #00ffff;
            box-shadow: 0 0 18px rgba(0,255,255,.6);
        }

        a {
            color: #00ffff;
            text-decoration: none;
            font-weight: 700;
        }

        a:hover { text-shadow: 0 0 10px #00ffff; }

        .auth-links {
            margin-top: 18px;
            text-align: center;
        }

        .error {
            color: #ff004c;
            margin-bottom: 10px;
        }

        .remember {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 16px;
        }

        .remember input {
            width: auto;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <h1 class="auth-title">MYIOT</h1>
        {{ $slot }}
    </div>
</body>
</html>