<?php 
    session_start();
    include("../db.php");

    function verifyPassword( $password, $username ){ // sprawdzenie czy hasło pasuje do tego w bazie
        $hash = getHash( $username ); // bierzemy hasha z bazy

        if( !$hash ) return false; // jak nie ma hasha - czyli nie ma usera, to wypierdalamy

        return password_verify( $password, $hash ) ? true : false; // sprawdzamy w końcu czy hasło pasuje, jak nie to chuj :)
    }
    function getHash( $username ){ // bierzemy hasło z bazy
        global $pdo;
        $sql = "select password from accounts where name = :user";
        $query = $pdo->prepare($sql);
        $query->execute(["user" => $username]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $hash = $result["password"];

        return $hash;
    }
    function validUsername( $username ){ // żeby nygus nie wjebał ascii arta w username
        if(!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)){
            //header("Location: index.php");
            return false;
        }
        return true;
    }
    function getID( $username ){ // jak sie udało zalogować, to przypisujemy ID użytkownika do sesji, żeby pokazał sie dashboard
        global $pdo;
        $sql = "select id from accounts where name = :user";
        $query = $pdo->prepare($sql);
        $query->execute(["user" => $username]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        return $result["id"];
    }

    try{ // bo przecież baza też może sie wyjebać
        if( isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] != "" && $_POST["password"] != "" ){ // żeby chujek nie wjebał pustego inputa
            
            if( validUsername( $_POST["username"] ) ) // sprawdzenie czy nie ma ascii arta albo chuj wie czego, bo można sie wszystkiego spodziewać
                $username = $_POST["username"]; // jeśli jest ok, to ustawiamy $username na inputa
            else{   
                header("Location: ../index.php"); // jak nie - to chuj mu w dupe, wypierdalamy go
                exit;
            }
            $password = $_POST["password"]; // jak username przeszedł, to do $password przypisujemy inputa

            if( verifyPassword( $password, $username ) ){ // porównanie inputa do hasha z bazy
                $_SESSION["userID"] = getID( $username ); // jak sie udało - przypisujemy userID i przenosimy na dashboarda
                header("Location: ../todolist.php");
                exit;
            }

        }
    }
    catch( PDOException $e ){ // jakby sie zjebała baza to wypierdalamy na landing page;
        echo $e->getMessage();
        header("Location: ../index.php");
    }
    header("Location: ../index.php");
    exit;
?>