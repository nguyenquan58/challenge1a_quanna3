<?php
session_start();

require_once('connect.php');
require_once('database.php');
require_once('check.php');

if (isPost()) {
    $arr = filter();
    $acc = $arr["uname"];
    $pssw = $arr["pssw"];

    $sql = "SELECT * FROM User WHERE account='$acc' AND passwd='$pssw'";
    $data = getOneRaw($sql);
    if (!empty($data)) {
        //echo 'welcome';
        $_SESSION["id"] = $data["idUser"];
        $_SESSION["name"] = $data["name"];
        $message = '';
    }
    else {
        $message = 'Tai khoan/mat khau sai';
    }

    if (isset($_SESSION["id"])) {
        redirect("home.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="uname">Tai khoan</label>
        <input type="text" name="uname" required> <br>
        <label for="pssw">Mat khau</label>
        <input type="password" name="pssw" required> <br>
        <button type="submit">Dang nhap</button>
        <div class="message"><?php if($message!="") { echo $message; } ?></div>
    </form>
</body>
</html>
