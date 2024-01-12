<?php
session_start();
require_once("check.php");
require_once("database.php");

if (!isLogin()) {
    redirect("login.php");
} 

$arr = filter();
if (!empty($arr["id"]))
{
    $id = $arr["id"];
    $sql = "SELECT * FROM User WHERE idUser='$id'";
    $user = getOneRaw($sql);
    //print_r($data);
    $acc = $user["account"];
    $pass = $user["passwd"];
    $name = $user["name"];
    $email = $user["email"];
    $phone = $user["phone"];
    $avt = $user["avatar"];
}

if (isPost()) {
    $arr = filter();
    //print_r($arr);
    $pass = $arr["pass"];
    $email = $arr["email"];
    $phone = $arr["phone"];
    $data = [
        "passwd" => $pass,
        "email" => $email,
        "phone" => $phone
    ];
    $cond = "idUser='$id'";
    $kq = update('User', $data, $cond);
    //print($kq);
    redirect("personal_profile.php?id=$id");
}

?>
<form action="" method="post">
    <label for="name">Ten: </label>
    <input id="name" name="name" type="text" value="<?php echo $name; ?>" readonly> <br>
    <label for="acc">Tai khoan: </label>
    <input id="acc" name="acc" type="text" value="<?php echo $acc; ?>" readonly> <br>
    <label for="pass">Mat khau: </label>
    <input id="pass" name="pass" type="text" value="<?php echo $pass; ?>" required> <br>
    <label for="email">Email: </label>
    <input id="email" name="email" type="text" value="<?php echo $email; ?>" required> <br>
    <label for="phone">Dien thoai: </label>
    <input id="phone" name="phone" type="text" value="<?php echo $phone; ?>" required> <br>
    <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
    <button type="submit">Save</button>
</form>

<?php

?>