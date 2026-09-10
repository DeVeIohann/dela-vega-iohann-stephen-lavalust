<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <style>
        :root {
            --bg-1: #1a0d2e;
            --bg-2: #2b1647;
            --panel: rgba(42, 28, 67, 0.88);
            --panel-border: rgba(212, 175, 55, 0.5);
            --violet: #6f3ec9;
            --gold: #d4af37;
            --gold-soft: #f4d77d;
            --text: #f7f2ff;
            --muted: #d9caef;
            --shadow: rgba(12, 7, 25, 0.45);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, var(--bg-1) 0%, var(--bg-2) 45%, #3b1e5e 100%);
            color: var(--text);
        }

        .auth-card {
            width: min(92vw, 500px);
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: 24px;
            box-shadow: 0 24px 60px var(--shadow);
            padding: 32px 28px;
            backdrop-filter: blur(8px);
        }

        .brand {
            text-align: center;
            margin-bottom: 20px;
            font-size: 12px;
            letter-spacing: 0.18em;
            color: var(--gold-soft);
            text-transform: uppercase;
            font-weight: 700;
        }

        h2 {
            margin: 0 0 18px;
            text-align: center;
            font-size: clamp(1.7rem, 2vw, 2.2rem);
        }

        .error {
            background: rgba(212, 175, 55, 0.12);
            border: 1px solid rgba(212, 175, 55, 0.5);
            color: var(--gold-soft);
            border-radius: 10px;
            padding: 10px 12px;
            margin-bottom: 18px;
            font-size: 0.95rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        label {
            display: block;
            margin-bottom: 7px;
            color: var(--muted);
            font-weight: 600;
        }

        input {
            width: 100%;
            border-radius: 12px;
            border: 1px solid rgba(212, 175, 55, 0.4);
            background: rgba(255,255,255,0.04);
            color: var(--text);
            padding: 12px 14px;
            font-size: 1rem;
            outline: none;
        }

        input:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.18);
        }

        button {
            margin-top: 10px;
            border: none;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--gold) 0%, #f0c14a 100%);
            color: #22163d;
            font-weight: 700;
            font-size: 1rem;
            padding: 12px 18px;
            cursor: pointer;
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.25);
        }

        .meta {
            text-align: center;
            margin-top: 18px;
            color: var(--muted);
            font-size: 0.97rem;
        }

        a {
            color: var(--gold-soft);
            text-decoration: none;
            font-weight: 700;
        }

        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="brand">LavaLust</div>
        <h2>Create Account</h2>
        <?php if (isset($error)) echo "<div class='error'>$error</div>"; ?>
        <form action="<?=site_url('auth/register') ?>" method="POST">
            <div>
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div>
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div>
                <label>Password</label>
                <input type="password" name="password" required>
            </div>

            <div>
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required>
            </div>

            <button type="submit">Create Account</button>
        </form>
        <p class="meta">Already have an account? <a href="<?=site_url('auth/login') ?>">Login</a></p>
    </div>
</body>
</html>
