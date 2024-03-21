<?php
session_start();
session_unset();
session_destroy();
?>

<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Hey Guys</title>
    </head>
    <body>
        <header id="Head">
            <h1>Login Page</h1>
        </header>

        <nav>
            <a href="signup.php">Sign Up</a>
        </nav>

        <div id="maindiv">
            <form action="verifylogin.php" method="post">
            <p>Username</p>  <input type="text" name="nome" />
            <p>Password</p>  <input type="password" name="password" />
            <br><br>
            <input type="Submit" value="Login" />
            </form>

            <?php
                echo $LoginFail
            ?>
        </div>
        
    </body>
</html>
