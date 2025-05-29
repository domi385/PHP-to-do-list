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
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1c1c1c, #2a2a2a);
            color: #f0f0f0;
        }

        .auth-container {
            max-width: 450px;
            margin: 70px auto;
            padding: 30px;
            background-color: rgba(50, 50, 50, 0.85);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        .auth-container h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 26px;
            color: #66aaff;
        }

        .auth-container form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .auth-container label {
            font-weight: bold;
            color: #f0f0f0;
        }

        .auth-container input[type="text"] {
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #555;
            background-color: #222;
            color: #fff;
            font-size: 16px;
        }

        .auth-container input[type="password"] {
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #555;
            background-color: #222;
            color: #fff;
            font-size: 16px;
        }

        .auth-container input[type="submit"] {
            background-color: #444;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .auth-container input[type="submit"]:hover {
            background-color: #666;
        }

        .toggle-link {
            text-align: center;
            margin-top: 15px;
        }

        .toggle-link a {
            color: #aaa;
            text-decoration: underline;
            font-size: 15px;
        }

        .toggle-link a:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
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
