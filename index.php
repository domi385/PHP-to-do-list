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
    <title>Lista zadań - logowanie i rejestracja</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="auth-container" id="login-form">
        <h1>Logowanie</h1>
        <form method="post" action="api/login.php">
            <input type="text" id="full-name" name="username" placeholder="Wprowadź swoje imię i nazwisko" required>
            <input type="password" id="new-password" name="password" placeholder="Wprowadź swoje hasło" required>
            <input type="submit" value="Zaloguj się">
        </form>
        <div class="toggle-link">
            <a href="#register" onclick="toggleForms()">Nie masz konta? Zarejestruj się</a>
        </div>
    </div>

    <div class="auth-container" id="register-form" style="display: none;">
        <h1>Rejestracja</h1>
        <form method="post" action="api/register.php">
            <input type="text" id="new-full-name" name="username" placeholder="Wprowadź swoje imię i nazwisko" required>
            <input type="password" id="new-password" name="password" placeholder="Wprowadź swoje hasło" required>
            <input type="submit" value="Zarejestruj się">
        </form>
        <div class="toggle-link">
            <a href="#login" onclick="toggleForms()">Masz już konto? Zaloguj się</a>
        </div>
    </div>

    <script>
        function toggleForms() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            loginForm.style.display = loginForm.style.display === 'none' ? 'block' : 'none';
            registerForm.style.display = registerForm.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>
