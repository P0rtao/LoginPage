<?php
session_start();

require_once("../conf.php");

try {
    // Start Connection
    $conn = new PDO($dst, $utilizador, $password);

    $sql = "SELECT * FROM Users";
    $stmt = $conn->query($sql);
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $Users = [];
    while ($row = $stmt->fetch()) {
        $Users[] = [
            "Username" => $row["username"],
            "Password" => $row["password"]
        ];
    }

} catch (PDOException $err) {
    die ("A ligação ao servidor $servidor falhou com o erro: " . $err->getMessage());
}


if ($_SESSION["user"] != "PatinhoUser") {
    header("Location: ../hub.php");
    die();
} elseif (!isset ($_SESSION["user"])) {
    header("Location: ../index.php");
    die();
}

?>

<html>

<head>
    <link rel="stylesheet" href="../style.css">
    <title>Hackerman</title>
</head>

<body id="adminbg">
    <header id="AdminHead">
        <h1>Admin Console (Real)</h1>
    </header>

    <nav>
        <a href="../hub.php">Exit</a>
    </nav>

    <div id="adminpanel">
        <?php echo "<p>Logged in as " . $_SESSION["user"] . ".</p>" ?>
        <br><br>

        <table id="usertable">
            <h2>Current Users</h2>

            <?php foreach ($Users as $User) { ?>
                <tr>
                    <td class="usertd">
                        <?= $User['Username'] ?>
                    </td>
                    <td class="usertd">
                        <?= $User['Password'] ?>
                    </td>
                </tr>
            <?php } ?>

        </table>
        <form action="deluser.php" method="post">
            <h2>Delete User</h2>
            <p>Username</p>  <input type="text" name="nome"/>
            <br><br>
            <input type="Submit" value="Bye-bye" />
        </form>

        <?php echo "$DeleteFail" ?>

    </div>

</body>

</html>