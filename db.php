<?php 

    $host = 'localhost';
    $db = 'todolist';
    $user = 'postgres';
    $pass = 'haslo';

    $dsn = "pgsql:host = $host;dbname = $db";
    
    try{
        $pdo = new PDO( $dsn, $user, $pass );
    }
    catch(PDOException $e){
        echo "SQL ma wylew: " . $e->getMessage();
    }

?>