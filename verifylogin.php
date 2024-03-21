<?php

session_start();
$_SESSION["user"] = $_POST["nome"];

$LoginFail;
require_once("conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);
    
    $nome = $_POST['nome'];
    $password = $_POST['password'];
    
    if (!$nome or !$password) {
    
        $LoginFail = "<p>Dica: Usa a cabeca</p>";
        include "index.php";
    
    } else {
        $sql = "SELECT * FROM Users where username='$nome' and password='$password'";
        $stmt = $conn->query($sql);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }

    
    
    if ($row = $stmt->fetch()) {
        
        header("Location: hub.php");
           
    } else {
        
        $LoginFail = "<p>Nah buddy try again</p>";
        include "index.php";
    
    }
    
    } catch (PDOException $err) {
        die("A ligação ao servidor $servidor falhou com o erro: " . $err->getMessage());
    }
    
?>
