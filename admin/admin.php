<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - TODO List</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="container" id="adminpanel">
        <h1>Panel Administratora</h1>

        <?php if (isset($_SESSION['adminID'])): ?>
            <div class="nav-buttons" style="display: flex; gap: 15px; justify-content: center; margin-bottom: 30px;">
                <a href="users.php">
                    <button>Użytkownicy</button>
                </a>
                <a href="tasks.php">
                    <button>Zadania</button>
                </a>
            </div>
        <?php else: ?>
            <p class="error">Nie jesteś zalogowany. <a href="index.php" style="color: #66aaff;">Wróć do logowania</a>.</p>
        <?php endif; ?>

        <div style="text-align: center; margin-top: 20px;">
            <a href="index.php" class="logout-btn">Wyloguj</a>
        </div>
    </div>
</body>
</html>
