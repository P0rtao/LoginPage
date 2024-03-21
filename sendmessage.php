<?php

session_start();

require_once("conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);
    
    // Gives an attribute so it does throw Exceptions (It wouldnt work at home :C)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $name = $_SESSION["user"];
    $message = $_POST["msg"];
    
    if (!$message) {
    
        header("Location: hub.php");
    
    } else {

        $sql = "INSERT INTO Messages (user, message) VALUES (:user, :message);";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':user' => $name, ':message' => $message]);
        
        header("Location: hub.php");

    }
        
    } catch (PDOException $err) {
        
        die($err->getMessage());
    
    }

    
?>
