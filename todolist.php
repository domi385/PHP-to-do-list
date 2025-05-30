<?php 
    session_start();
    include("db.php");

    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }


    function returnTasks() {
        global $pdo;
        try {
            $sql = "SELECT id, task FROM tasks WHERE accid = :id";
            $query = $pdo->prepare($sql);
            $query->execute(['id' => $_SESSION["userID"]]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            echo '<table class="task-table">';
            echo '<tr><th>Task ID</th><th>Task</th><th></th></tr>';

            foreach($result as $row){
                echo "<tr><td>{$row['id']}</td><td>{$row['task']}</td> <td> 
                    <form action='api/removeTask.php' method='post'>
                        <input type='hidden' value='{$row['id']}' name='taskrm'>
                        <button type='submit'>Usuń</button>
                    </form>
                </td> </tr>";
            }

            echo '</table>';
        } catch (PDOException $e) {
            echo "<div class='error'>Błąd bazy danych: " . htmlspecialchars($e->getMessage()) . "</div>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Task Manager</title>
    <link rel="stylesheet" href="todo.css">
</head>
<body>
<?php if ( isset($_SESSION["userID"]) ): ?>
    <div class="container">
        <h1>Zarządzanie Zadaniami</h1>

        <form action="api/addTask.php" method="post">
            <label for="task">Dodaj nowe zadanie:</label>
            <input type="text" name="task" id="task" placeholder="Zadanie">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <button type="submit">DODAJ</button>
        </form>
    </div>
    
    <!--<div class="container">
        <form action="api/removeTask.php" method="post">
            <label for="taskrm">Usuń zadanie (ID):</label>
            <input type="number" name="taskrm" id="taskrm" placeholder="ID zadania">
            <button type="submit">USUŃ</button>
        </form>
    </div>-->

    <div class="container">
        <h2>Twoje zadania</h2>
        <?php returnTasks(); ?>
    </div>
<?php else: ?>
    <div class="container">
        <p>Nie jesteś zalogowany.</p>
    </div>
<?php endif; ?>

    <div class="container">
        <a href="index.php" class="logout-btn">Wyloguj</a>
    </div>

</body>
</html>
