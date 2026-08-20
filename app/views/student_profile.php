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
            color: #2b2622; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            min-height: 100vh; 
            margin: 0; 
            padding: 30px 0; 
        }
        .dossier-card { 
            background: #ebd8b0; 
            padding: 35px; 
            border-radius: 4px; 
            box-shadow: 0 10px 0 #181513, 0 15px 30px rgba(0,0,0,0.7); 
            border: 4px solid #3c352e; 
            width: 480px; 
            position: relative;
        }
        .classified-stamp {
            position: absolute;
            top: 25px;
            right: 25px;
            border: 4px solid #b8383b;
            color: #b8383b;
            font-family: 'Impact', sans-serif;
            font-size: 18px;
            padding: 4px 10px;
            text-transform: uppercase;
            letter-spacing: 2px;
            transform: rotate(-8deg);
            opacity: 0.85;
            pointer-events: none;
        }
        h2 { 
            font-family: 'Impact', 'Arial Black', sans-serif;
            color: #3c352e; 
            border-bottom: 4px solid #b8383b; 
            padding-bottom: 8px; 
            margin-top: 0; 
            font-size: 26px; 
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 65%;
        }
        .info-row { 
            display: flex; 
            justify-content: space-between; 
            margin-bottom: 8px; 
            font-size: 14px; 
            border-bottom: 2px dotted #b5a482; 
            padding-bottom: 4px; 
        }
        .label { 
            font-weight: bold; 
            color: #6e604f; 
            text-transform: uppercase;
        }
        .value { 
            color: #1a1714; 
            font-weight: bold; 
            text-align: right; 
        }
        .section-header { 
            font-family: 'Impact', sans-serif;
            font-size: 17px; 
            text-transform: uppercase;
            color: #b8383b; 
            margin-top: 18px; 
            margin-bottom: 6px; 
            letter-spacing: 1px;
        }
        .description-box {
            background: #dfcd9f;
            border: 2px dashed #b5a482;
            padding: 10px;
            font-size: 13px;
            font-weight: 600;
            color: #3c352e;
            line-height: 1.4;
            border-radius: 3px;
        }
        .tag-container { 
            display: flex; 
            flex-wrap: wrap; 
            gap: 6px; 
            margin-bottom: 10px; 
        }
        .tag-red { 
            background: #b8383b; 
            color: #f3e6d0; 
            padding: 4px 10px; 
            border-radius: 2px; 
            font-size: 12px; 
            font-weight: bold; 
            text-transform: uppercase;
            border: 2px solid #3c352e;
        }
        .tag-blu { 
            background: #5b7a8c; 
            color: #f3e6d0; 
            padding: 4px 10px; 
            border-radius: 2px; 
            font-size: 12px; 
            font-weight: bold; 
            text-transform: uppercase;
            border: 2px solid #3c352e;
        }
        .nav-group { 
            display: flex; 
            gap: 12px; 
            margin-top: 24px; 
        }
        .btn { 
            flex: 1; 
            text-align: center; 
            padding: 12px; 
            text-decoration: none; 
            font-family: 'Impact', 'Arial Black', sans-serif;
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-radius: 3px; 
            color: white; 
            border: 3px solid #1a1714;
            box-shadow: 0 4px 0 #1a1714;
            transition: all 0.1s ease;
        }
        .btn:active {
            transform: translateY(4px);
            box-shadow: 0 0 0 #1a1714;
        }
        .btn-home { 
            background: #5b7a8c; 
        }
        .btn-home:hover { 
            background: #6a8c9e; 
        }
        .btn-logout { 
            background: #b8383b; 
        }
        .btn-logout:hover { 
            background: #d04043; 
        }
    </style>
</head>
<body>

    <div class="dossier-card">
        <div class="classified-stamp">CONFIDENTIAL</div>
        <h2>Personnel File</h2>
        
        <div class="info-row"><span class="label">Mercenary ID</span><span class="value"><?= $student_id; ?></span></div>
        <div class="info-row"><span class="label">Operative Name</span><span class="value"><?= $name; ?></span></div>
        <div class="info-row"><span class="label">Class / Specialty</span><span class="value"><?= $course; ?></span></div>
        <div class="info-row"><span class="label">Rank & Squad</span><span class="value"><?= $year; ?> (<?= $section; ?>)</span></div>
        <div class="info-row"><span class="label">Comms Email</span><span class="value"><?= $email; ?></span></div>
        <div class="info-row"><span class="label">Deployment Base</span><span class="value"><?= $address; ?></span></div>
        <div class="info-row"><span class="label">Secure Contact</span><span class="value"><?= $contact_number; ?></span></div>

        <div class="section-header">Profile Description</div>
        <div class="description-box">
            <?= $profile_description; ?>
        </div>

        <div class="section-header">Loadout & Specializations</div>
        <div class="tag-container">
            <?php foreach ($skills as $skill): ?>
                <span class="tag-red"><?= $skill; ?></span>
            <?php endforeach; ?>
        </div>

        <div class="section-header">Off-Duty Passions</div>
        <div class="tag-container">
            <?php foreach ($hobbies as $hobby): ?>
                <span class="tag-blu"><?= $hobby; ?></span>
            <?php endforeach; ?>
        </div>

        <div class="nav-group">
            <a href="http://localhost/LALA/LavaLust/student" class="btn btn-home">Base HQ</a>
            <a href="http://localhost/LALA/LavaLust/student/logout" class="btn btn-logout">Abort Mission</a>
        </div>
    </div>

</body>
</html>