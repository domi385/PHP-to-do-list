<?php 
    include("../db.php");
    session_start();

    function validUsername( $username ){ // sprawdzenie foramtu username
        if(!preg_match("/^[a-zA-Z0-9_]{3,20}$/", $username)){
            //echo "<script>alert('Nieprawidłowa nazwa użytkownika.');</script>";
            header("Location: ../index.php");
            exit;
        }
    }
    function uniqueUsername ($result){
        if($result->rowCount() > 0){ // jeśli jest >0 rekordów, to znaczy że już jest taki username, więc niech spierdala
            //echo "<script> alert('Taki użytkownik już istnieje!') </script>";
            header("Location: ../index.php");
            exit;
        }
    }
    function addUser ( $username, $password ){
        global $pdo;
        
        $sql = "insert into accounts (name, password) values( :name, :password )";
        $query = $pdo->prepare($sql);
        $query->execute(["name" => $username, "password" => $password]);

        $_SESSION["userID"] = $pdo->lastInsertId(); // przypisanie userID do sesji, co umożliwi wyświetlenie zawartości strony, taki logged check
    }

    if( isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] != "" && $_POST["password"] != "" ){ // żeby nicpoń nie wpierdolił pustego inputa, albo nie wszedł na API przez link

        try{

            $username = trim($_POST["username"]);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // hashowanie, bo bezpieczeństwo jest ważne

            validUsername( $username ); // żeby nie wpierdolił ascii arta w username

            
            $sql = "select * from accounts where name = :name";
            $query = $pdo->prepare($sql);
            $query->execute(["name" => $username]);
            
            uniqueUsername( $query ); // czy chujek nie chce zarejestrować username, który już istnieje

            addUser( $username, $password ); // jak do tej pory nic nie jebło (małe prawdopodobieństwo, ale możliwe), to niech w końcu doda chłopa (albo babke, czy jak tam sie identyfikuje) do bazy i od razu doda logged checka 

            //echo "<script> alert(' Pomyślnie zarejestrowano użytkownika ') </script>";
            header("Location: ../todolist.php"); // jak sie udało wpierdolić usera do bazy, to przeniesie na dashboarda
            exit;

        }
        catch(PDOException $e){ // jak baza jebnie, to jebnie na login/register page
            //echo "<script> alert('Błąd bazy danych: " . $e->getMessage() . " ') </script> ";
            header("Location: ../index.php");
            exit;
        }
    }
?>
