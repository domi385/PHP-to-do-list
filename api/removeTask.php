<?php 
    session_start();
    include("../db.php");

    if(isset($_POST["taskrm"]) && $_POST["taskrm"] != ""){
        $sql = "delete from tasks where id = :id and accid = :accid";
        $query = $pdo -> prepare($sql);
        $query -> execute(['id' => $_GET["taskrm"], 'accid' => $_SESSION["userID"]]);
        header("Location: ../todolist.php");
        exit;
    }
    header("Location: ../todolist.php");
    exit;
?>