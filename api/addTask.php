<?php 
    session_start();
    include("../db.php");

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die("HACKING ATTEMPT WYKRYTY, ID SPIERDALAJ.");
    }
    // Anti-spam: 1 request co 2 sekundy
    if (!isset($_SESSION['last_task_remove'])) {
        $_SESSION['last_task_remove'] = 0;
    }

    $now = time();
    if ($now - $_SESSION['last_task_remove'] < 2) {
        die("Za szybko, typie. Wyluzuj z tym spamem.");
    }

    $_SESSION['last_task_remove'] = $now;


    if(isset($_POST["task"]) && $_POST["task"] != ""){
        $sql = "insert into tasks (accid, task) values (:id, :task)";
        $query = $pdo -> prepare($sql);
        $query -> execute(['id' => $_SESSION["userID"], 'task' => $_POST["task"]]);
        header("Location: ../todolist.php");
        exit;
    }
    header("Location: ../todolist.php");
    exit;
?>