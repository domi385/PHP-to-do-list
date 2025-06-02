<?php 
session_start();
include("../db.php");

function showTasks($result) {
    echo '<table class="data-table">';
    echo '<tr><th>Task ID</th><th>User ID</th><th>Task</th><th>User</th></tr>';
    foreach ($result as $row) {
        echo "<tr>
            <td>" . (int)$row['id'] . "</td>
            <td>" . htmlspecialchars($row['accid']) . "</td>
            <td>" . htmlspecialchars($row['task']) . "</td>
            <td>
                <form action='users.php' method='get'>
                    <input type='hidden' value='" . (int)$row['id'] . "' name='taskrm'>
                    <button type='submit' class='btn'>User</button>
                </form>
            </td>
        </tr>";
    }
    echo '</table>';
}

function getTasks() {
    try {
        global $pdo;
        $sql = "SELECT id, accid, task FROM tasks";
        $query = $pdo->prepare($sql);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        showTasks($result);
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
    <title>Admin Panel - Zadania</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <div class="main-container">
        <?php getTasks(); ?>

        <div style="text-align: center; margin-top: 20px;">
            <a href="admin.php" class="logout-btn">Powrót</a>
        </div>
    </div>
    
</body>
</html>
