<?php 
session_start();
include("../db.php");

function showUsers($result) {
    echo '<table class="data-table">';
    echo '<tr><th>UserID</th><th>Username</th><th>Show Tasks</th></tr>';
    foreach ($result as $row) {
        echo "<tr>
            <td>" . (int)$row['id'] . "</td>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>
                <form action='tasks.php' method='get'>
                    <input type='hidden' value='" . (int)$row['id'] . "' name='taskrm'>
                    <button type='submit' class='btn'>Tasks</button>
                </form>
            </td>
        </tr>";
    }
    echo '</table>';
}

function getUsers() {
    try {
        global $pdo;
        $sql = "SELECT id, name FROM accounts";
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        showUsers($result);
    } catch (PDOException $e) {
        echo "<p class='error'>Baza spadła z rowerka: " . htmlspecialchars($e->getMessage()) . "</p>";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Użytkownicy</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="main-container">
        <?php getUsers(); ?>
        
        <div style="text-align: center; margin-top: 20px;">
            <a href="admin.php" class="logout-btn">Powrót</a>
        </div>
    </div>
    
</body>
</html>
