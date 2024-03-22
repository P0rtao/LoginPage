<?php

session_start();


if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    die();
}
?>

<html>
    <head>
        <link rel="stylesheet" href="../style.css">
        <title>Editing</title>
    </head>
    <body id="ChatBg">
        <header id="ChatHead">
            <?php
                echo "<h1> Hello, ".$_SESSION["user"]."! </h1>"
            ?>
        </header>

        <nav>
            <a href="../hub.php">Cancel</a>
        </nav>

        <div id="maindiv">
        
            <h2>Edit Your Message</h2>

            <form action="editmessagehandler.php" method="post">
                <p>Message</p>  <input type="text" name="newmsg" value="<?php echo str_replace("<p class='edited'> (Edited)</p>", "" ,$_POST["oldmsg"]) ?>"/>
                <input type="hidden" name="msgtoedit" value="<?php echo($_POST["msgid"]) ?>" />
                <br><br>
                <input type="Submit" value="Edit Message" />
            </form>

            <?php echo "$EditFail" ?>
            
        </div>
        
    </body>
</html>
