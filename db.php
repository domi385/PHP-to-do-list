<?php 
    $host = "localhost";
    $user = "postgres";
    $pass = "haslo";
    $db = "todolist";
    
    $dsn = 'pgsql:host=' . $host . '; dbname=' . $db;
    $pdo = new PDO( $dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

?>
