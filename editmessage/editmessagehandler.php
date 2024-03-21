<?php

session_start();

$EditFail;
require_once("../conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);
    
    $msgtoedit = $_POST['msgtoedit'];
    $newmsg = $_POST['newmsg'] . " (Edited)";
    
    if (!$newmsg) {
    
        $EditFail = "<p>No blank messages please</p>";
        include "editmessagepage.php";
    
    } else {
        $sql = "UPDATE Messages SET message = :msg WHERE id = :msgtoedit";
        $stmt = $conn->prepare($sql);
        $stmt->execute([':msg' => $newmsg, ':msgtoedit' => $msgtoedit]);

        header("Location: ../hub.php");
    }
    
    } catch (PDOException $err) {
        die("A ligação ao servidor $servidor falhou com o erro: " . $err->getMessage());
    }
    
?>
