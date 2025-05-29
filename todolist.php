<?php 
    session_start();
    include("db.php");

    function returnTasks() {
        global $pdo;
        try {
            $sql = "SELECT id, task FROM tasks WHERE accid = :id";
            $query = $pdo->prepare($sql);
            $query->execute(['id' => $_SESSION["userID"]]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            echo '<table class="task-table">';
            echo '<tr><th>Task ID</th><th>Task</th></tr>';

            foreach($result as $row){
                echo "<tr><td>{$row['id']}</td><td>{$row['task']}</td></tr>";
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
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #1c1c1c, #2a2a2a);
            color: #f0f0f0;
        }

        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 25px;
            background-color: rgba(50, 50, 50, 0.85);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        h1 {
            text-align: center;
            margin-bottom: 25px;
            font-size: 28px;
            color: #66aaff;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #555;
            background-color: #222;
            color: #fff;
            font-size: 16px;
            margin-bottom: 15px;
        }

        button {
            background-color: #444;
            color: #fff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #666;
        }

        .task-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .task-table th,
        .task-table td {
            border: 1px solid #555;
            padding: 10px;
            text-align: left;
        }

        .task-table th {
            background-color: #333;
            color: #66aaff;
        }

        .error {
            color: red;
            background: #300;
            padding: 10px;
            border-radius: 8px;
        }
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 30px 35px; /* więcej miejsca wewnątrz */
            background-color: rgba(50, 50, 50, 0.85);
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px; /* odstęp między label/input/button */
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px 16px; /* więcej miejsca w środku */
            border-radius: 10px;
            border: 1px solid #555;
            background-color: #222;
            color: #fff;
            font-size: 16px;
            margin-bottom: 10px;
            box-sizing: border-box; /* żeby padding nie rozwalał szerokości */
        }

        button {
            background-color: #444;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }
        .logout-btn {
            display: inline-block;
            text-align: center;
            padding: 12px 25px;
            background: linear-gradient(135deg, #ff4b2b, #ff416c);
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border: none;
            border-radius: 12px;
            text-decoration: none;
            transition: background 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 12px rgba(255, 65, 108, 0.3);
            margin-top: 10px;
        }

        .logout-btn:hover {
            background: linear-gradient(135deg, #ff6a4b, #ff638e);
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(255, 65, 108, 0.5);
        }

    </style>
</head>
<body>
<?php if ( isset($_SESSION["userID"]) ): ?>
    <div class="container">
        <h1>Zarządzanie Zadaniami</h1>

        <form action="api/addTask.php" method="post">
            <label for="task">Dodaj nowe zadanie:</label>
            <input type="text" name="task" id="task" placeholder="Zadanie">
            <button type="submit">DODAJ</button>
        </form>
    </div>

    <div class="container">
        <form action="api/removeTask.php" method="post">
            <label for="taskrm">Usuń zadanie (ID):</label>
            <input type="number" name="taskrm" id="taskrm" placeholder="ID zadania">
            <button type="submit">USUŃ</button>
        </form>
    </div>

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
