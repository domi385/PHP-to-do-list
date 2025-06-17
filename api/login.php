<?php 
    session_start();
    include("../db.php");

    function verifyPassword( $password, $username ){ // sprawdzenie czy hasło pasuje do tego w bazie
        //echo "<br>fifi";
        $hash = getHash( $username ); // bierzemy hasha z bazy

        //echo "<br>jajco";

        if( !$hash ) return false; // jak nie ma hasha - czyli nie ma usera, to wywalamy

        return password_verify( $password, $hash ) ? true : false; // sprawdzamy w końcu czy hasło pasuje, jak nie to lipa :)
    }
    function getHash( $username ){ // bierzemy hasło z bazy

        //echo "<br>gethash robi sie";

        global $pdo;

        //echo "<br>mamy pdo";

        try{
        $sql = "select password from accounts where name = :user";
        //echo "<br>zrobione sql";
        $query = $pdo->prepare($sql);
        //echo "<br>zrobiony prepare";
        $query->execute(["user" => $username]);
        //echo "<br>egzekjut";
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $hash = $result["password"];
        }
        catch(PDOException $e){
            echo "Jebło: " . $e->getMessage();
            die();
        }

        return $hash;
    }
    function validUsername( $username ){ // żeby nie było ascii arta w username
        if(!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)){
            header("Location: index.php");
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


    try{ // bo przecież baza też może spaść z rowerka
        if( isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] != "" && $_POST["password"] != "" ){ // żeby chujek nie wjebał pustego inputa
            
            if( validUsername( $_POST["username"] ) ) // sprawdzenie czy nie ma ascii arta albo nie wiadomo czego, bo można sie wszystkiego spodziewać
                $username = $_POST["username"]; // jeśli jest ok, to ustawiamy $username na inputa
            else{   
                header("Location: ../index.php"); // jak nie - to wywalamy go
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
    catch( PDOException $e ){ // jakby sie zjebała baza to deportujemy na landing page;
        echo $e->getMessage();
        header("Location: ../index.php");
    }

    header("Location: ../index.php");
    exit;
?>