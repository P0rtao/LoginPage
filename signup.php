<html>
    <head>
        <link rel="stylesheet" href="style.css">
        <title>Hey Guy I dont know</title>
    </head>
    <body>
        <header id="Head">
            <h1>Sign Up</h1>
        </header>

        <nav>
            <a href="index.php">Log In</a>
        </nav>

        <div id="maindiv">
            <form action="verifysignup.php" method="post">
            <p>Username</p>  <input type="text" name="nome" />
            <p>Password</p>  <input type="password" name="password" />
            <br><br>
            <input type="Submit" value="Create Account" />
            </form>

            <?php
                echo $SignUpFail;
            ?>
        </div>
        
    </body>
</html>
