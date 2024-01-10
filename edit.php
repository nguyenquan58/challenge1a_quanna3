<?php
session_start();
require_once("check.php");
require_once("database.php");

$arr = filter();
if (!empty($arr["id"]))
{
    $id = $arr["id"];
    $sql = "SELECT * FROM User WHERE idUser='$id'";
    $data = getOneRaw($sql);
    //print_r($data);
    $acc = $data["account"];
    $pass = $data["passwd"];
    $name = $data["name"];
    $email = $data["email"];
    $phone = $data["phone"];
    $avt = $data["avatar"];
}
if (isPost()) {
    redirect("profile.php?id='$id'");
}

?>
<form action="" method="post">
    <label for="name">Ten: </label>
    <input id="name" type="text" value="<?php echo $name; ?>" readonly> <br>
    <label for="acc">Tai khoan: </label>
    <input id="acc" type="text" value="<?php echo $acc; ?>" readonly> <br>
    <label for="pass">Mat khau: </label>
    <input id="pass" type="text" value="<?php echo $pass; ?>"> <br>
    <label for="email">Email: </label>
    <input id="email" type="text" value="<?php echo $email; ?>"> <br>
    <label for="phone">Dien thoai: </label>
    <input id="phone" type="text" value="<?php echo $phone; ?>"> <br>
    <button type="submit">Save</button>
</form>

<?php

?>