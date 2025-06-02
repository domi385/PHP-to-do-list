<?php
session_start();
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - logowanie</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="auth-container">
        <h1>Logowanie</h1>
        <form method="post" action="adminlogin.php" class="auth-form">
            <input type="text" name="username" placeholder="Wprowadź swój login" required>
            <input type="password" name="password" placeholder="Wprowadź swoje hasło" required>
            <input type="submit" value="Zaloguj się">
        </form>
    </div>
</body>
</html>
