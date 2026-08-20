<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title; ?></title>
    <style>
        body { 
            font-family: 'Trebuchet MS', 'Impact', 'Arial Black', sans-serif; 
            background: #2b2622; 
            background-image: repeating-linear-gradient(45deg, #231f1c, #231f1c 10px, #2b2622 10px, #2b2622 20px);
            color: #ece3d0; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
        }
        .tf-card { 
            background: #d8c8a8; 
            color: #2b2622; 
            padding: 35px; 
            border-radius: 4px; 
            box-shadow: 0 8px 0 #181513, 0 15px 25px rgba(0,0,0,0.6); 
            border: 4px solid #3c352e; 
            text-align: center; 
            width: 420px; 
            position: relative;
        }
        .tf-card::before {
            content: "MANN CO. HQ";
            position: absolute;
            top: -18px;
            right: 20px;
            background: #b8383b;
            color: #f3e6d0;
            font-size: 13px;
            font-weight: 900;
            padding: 4px 12px;
            border: 2px solid #3c352e;
            letter-spacing: 2px;
            transform: rotate(3deg);
        }
        h1 { 
            font-family: 'Impact', 'Arial Black', sans-serif;
            text-transform: uppercase;
            color: #b8383b; 
            font-size: 28px; 
            margin-top: 10px;
            margin-bottom: 5px; 
            text-shadow: 1px 1px 0 #3c352e;
            letter-spacing: 1px;
        }
        .subtitle { 
            font-size: 13px; 
            font-weight: bold;
            color: #5c5247;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 25px;
            border-bottom: 2px dashed #b5a482;
            padding-bottom: 10px;
        }
        .alert-error { 
            background: #b8383b; 
            color: #f3e6d0; 
            border: 3px solid #3c352e; 
            padding: 12px; 
            font-size: 12px; 
            font-weight: bold;
            margin-bottom: 20px; 
            text-align: left; 
            text-transform: uppercase;
            box-shadow: inset 0 0 10px rgba(0,0,0,0.3);
            line-height: 1.4;
        }
        .btn { 
            display: block; 
            width: 100%; 
            box-sizing: border-box; 
            padding: 14px; 
            text-decoration: none; 
            font-family: 'Impact', 'Arial Black', sans-serif;
            font-size: 17px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 3px; 
            margin-top: 12px; 
            transition: all 0.1s ease; 
            text-align: center; 
            border: 3px solid #1a1714;
            box-shadow: 0 4px 0 #1a1714;
        }
        .btn:active {
            transform: translateY(4px);
            box-shadow: 0 0 0 #1a1714;
        }
        .btn-primary { 
            background: #b8383b; 
            color: #f3e6d0; 
        }
        .btn-primary:hover { 
            background: #d04043; 
        }
        .btn-secondary { 
            background: #5b7a8c; 
            color: #f3e6d0; 
        }
        .btn-secondary:hover { 
            background: #6a8c9e; 
        }
    </style>
</head>
<body>

    <div class="tf-card">
        <h1><?= $page_title; ?></h1>
        <div class="subtitle">Academic Terminal & Mercenary Security Gate</div>

        <?php if (isset($_SESSION['auth_error'])): ?>
            <div class="alert-error">
                <strong>[SECURITY ALERT]:</strong> <?= $_SESSION['auth_error']; ?>
                <?php unset($_SESSION['auth_error']); ?>
            </div>
        <?php endif; ?>

        <!-- Attempts direct profile entry (Triggers StudentMiddleware restriction) -->
        <a href="http://localhost/LALA/LavaLust/student/profile" class="btn btn-secondary">Test Direct Profile Access</a>

        <!-- Sets session state and grants access -->
        <a href="http://localhost/LALA/LavaLust/student/login" class="btn btn-primary">Authenticate Mercenary</a>
    </div>

</body>
</html>