<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
    <h2>User Login</h2>
    <?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form action="<?=site_url('auth/login')?>" method="POST">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>