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
            padding: 20px;
        }
        .dossier-card { 
            background: #d8c8a8; 
            color: #2b2622; 
            padding: 35px; 
            border-radius: 4px; 
            box-shadow: 0 8px 0 #181513, 0 15px 25px rgba(0,0,0,0.6); 
            border: 4px solid #3c352e; 
            width: 520px; 
            position: relative;
        }
        .dossier-card::before {
            content: "CLASSIFIED";
            position: absolute;
            top: -15px;
            right: 25px;
            background: #b8383b;
            color: #f3e6d0;
            font-size: 12px;
            font-weight: 900;
            padding: 4px 10px;
            border: 2px solid #3c352e;
            letter-spacing: 2px;
            transform: rotate(-2deg);
        }
        h1 { 
            font-family: 'Impact', 'Arial Black', sans-serif;
            text-transform: uppercase;
            color: #b8383b; 
            font-size: 26px; 
            margin-top: 0;
            margin-bottom: 5px; 
            letter-spacing: 1px;
        }
        .subtitle { 
            font-size: 12px; 
            font-weight: bold;
            color: #5c5247;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
            border-bottom: 2px dashed #b5a482;
            padding-bottom: 8px;
        }
        .field-group {
            margin-bottom: 10px;
            background: #c2b293;
            padding: 8px 12px;
            border-radius: 3px;
            border-left: 4px solid #b8383b;
        }
        .field-label {
            font-size: 11px;
            font-weight: bold;
            color: #5c5247;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .field-value {
            font-size: 14px;
            font-weight: bold;
            color: #1a1714;
        }
        .btn { 
            display: inline-block; 
            width: 100%;
            box-sizing: border-box;
            padding: 12px; 
            text-decoration: none; 
            font-family: 'Impact', 'Arial Black', sans-serif;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 3px; 
            margin-top: 15px; 
            text-align: center; 
            border: 3px solid #1a1714;
            box-shadow: 0 4px 0 #1a1714;
            background: #5b7a8c; 
            color: #f3e6d0; 
            transition: all 0.1s ease;
        }
        .btn:hover { background: #6a8c9e; }
        .btn:active { transform: translateY(4px); box-shadow: 0 0 0 #1a1714; }
    </style>
</head>
<body>

    <div class="dossier-card">
        <h1>Mercenary Personnel Dossier</h1>
        <div class="subtitle">Mann Co. Academic Database File</div>

        <div class="field-group">
            <div class="field-label">Student ID</div>
            <div class="field-value"><?= htmlspecialchars($student_id); ?></div>
        </div>

        <div class="field-group">
            <div class="field-label">Full Name</div>
            <div class="field-value"><?= htmlspecialchars($name); ?></div>
        </div>

        <div class="field-group">
            <div class="field-label">Course & Level</div>
            <div class="field-value"><?= htmlspecialchars($course); ?> (<?= htmlspecialchars($year); ?> - <?= htmlspecialchars($section); ?>)</div>
        </div>

        <div class="field-group">
            <div class="field-label">Comms / Email</div>
            <div class="field-value"><?= htmlspecialchars($email); ?> | <?= htmlspecialchars($contact_number); ?></div>
        </div>

        <div class="field-group">
            <div class="field-label">Base Address</div>
            <div class="field-value"><?= htmlspecialchars($address); ?></div>
        </div>

        <div class="field-group">
            <div class="field-label">Specialist Skills</div>
            <div class="field-value"><?= htmlspecialchars(is_array($skills) ? implode(', ', $skills) : $skills); ?></div>
        </div>

        <div class="field-group">
            <div class="field-label">Off-Duty Hobbies</div>
            <div class="field-value"><?= htmlspecialchars(is_array($hobbies) ? implode(', ', $hobbies) : $hobbies); ?></div>
        </div>

        <div class="field-group">
            <div class="field-label">Dossier Description</div>
            <div class="field-value"><?= htmlspecialchars($profile_description); ?></div>
        </div>

        <!-- Dynamic relative route -->
        <a href="<?= site_url('student/logout'); ?>" class="btn">Abort Mission (Logout)</a>
    </div>

</body>
</html>