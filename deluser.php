<?php
session_start();

$DeleteFail;
require_once("conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);
    
    $nome = $_POST['nome'];
    
    if (!$nome) {
    
        $DeleteFail = "<p>Ummmm naum escreveste</p>";
        include "adminpage.php";
    
    } elseif ($nome === $_SESSION["user"]) {
        
        $DeleteFail = "<p>Naum te apages a ti mesmo toto</p>";
        include "adminpage.php";

    } else {
        
        $sql = "DELETE FROM Users WHERE username = :nome";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':nome' => "$nome"]);

        header("Location: adminpage.php");
    }

    
    } catch (PDOException $err) {
        die("A ligação ao servidor $servidor falhou com o erro: " . $err->getMessage());
    }
    
?>
