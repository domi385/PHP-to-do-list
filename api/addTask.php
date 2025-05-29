<?php 
    session_start();
    include("../db.php");

    if(isset($_POST["task"]) && $_POST["task"] != ""){
        $sql = "insert into tasks (accid, task) values (:id, :task)";
        $query = $pdo -> prepare($sql);
        $query -> execute(['id' => $_SESSION["userID"], 'task' => $_GET["task"]]);
        header("Location: ../todolist.php");
        exit;
    }
    header("Location: ../todolist.php");
    exit;
?>