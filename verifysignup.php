<?php

session_start();
$_SESSION["user"] = $_POST["nome"];

$SignUpFail;
require_once("conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);
    
    // Gives an attribute so it does throw Exceptions (It wouldnt work at home :C)
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $nome = $_POST['nome'];
    $password = $_POST['password'];
    
    if (!$nome or !$password) {
    
        $SignUpFail = "<p>Num pode haver campos vazios idiota</p>";
        include "signup.php";
    
    } else {

        $sql = "INSERT INTO Users (username, password) VALUES (:username, :password);";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':username' => $nome, ':password' => $password]);
        
        header("Location: hub.php");

    }
        
    } catch (PDOException $err) {
        
        $SignUpFail = "<p>Ummmmm that guy allready exists</p>";
        include "signup.php";
    
    }

    
?>
