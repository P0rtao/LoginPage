<?php
session_start();

require_once("conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);

    $sql = "SELECT * FROM Messages ORDER BY id DESC";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $Msgs = [];
    while ($row = $stmt->fetch()) {
        $Msgs[] = [
            "Id" => $row["id"],
            "User" => $row["user"],
            "Msg" => $row["message"]
        ];
    }

} catch (PDOException $err) {
    die ("A ligação ao servidor $servidor falhou com o erro: " . $err->getMessage());
}

if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    die();
}
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Hub World</title>
    </head>
    <body id="ChatBg">
        <header id="ChatHead">
            <?php
                echo "<h1> Hello, ".$_SESSION["user"]."! </h1>"
            ?>
        </header>

        <nav>
            <a href="hub.php">Home</a>
            <?php
                if ($_SESSION["user"] == "PatinhoUser") {
                    echo "<a href='admin/adminpage.php'>Admin Commands</a>";
                }
            ?>
            <a href="index.php">Log Out</a>
        </nav>

        <div id="maindiv">
            <?php
                echo "<p>Don't be shy, say something ".$_SESSION["user"].".</p>"
            ?>    
        
            <table id="msgtable">
                <h2>Chat</h2>

                <form action="sendmessage.php" method="post">
                    <p>Message</p>  <input type="text" name="msg" />
                    <br><br>
                    <input type="Submit" value="Send" />
                </form>

                <br><br><br>

                <?php foreach ($Msgs as $Msg) { ?>
                    <tr>
                        <td class="msgtd">
                            <?= $Msg['User'] ?>
                        </td>
                        <td class="msgtd">
                            <?= $Msg['Msg'] ?>
                        </td>
                <?php 
                    if ($_SESSION["user"] == $Msg["User"]) { ?>
                        <td class="msgtd">
                            <form action='editmessage/editmessagepage.php' method="post">
                                <input type="hidden" name="msgid" value="<?php echo $Msg['Id'] ?>" />
                                <input type="hidden" name="oldmsg" value="<?php echo $Msg['Msg'] ?>" />
                                <input type="submit" name="submit" value="Edit" />
                            </form>
                        </td>
                        <td class="msgtd">
                        <form action='delmessage.php' method="post">
                            <input type="hidden" name="msgid" value="<?php echo $Msg['Id'] ?>" />
                            <input type="submit" name="submit" value="Delete" />
                        </form>
                        </td>
                    </tr>
                <?php } else { ?> 
                    </tr>
                <?php }
                } ?>
            </table>
            
        </div>
        
    </body>
</html>
