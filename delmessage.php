<?php
session_start();

$DeleteMsgFail;
require_once("conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);
    
    $msg = $_POST['msgid'];
    
        $sql = "DELETE FROM Messages WHERE id = :msg";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':msg' => "$msg"]);

        header("Location: hub.php");
    
    } catch (PDOException $err) {
        die("A ligação ao servidor $servidor falhou com o erro: " . $err->getMessage());
    }
    
?>
