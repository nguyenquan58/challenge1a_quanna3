<?php
session_start();

require_once("check.php");
require_once("database.php");

if (!isLogin()) {
    redirect("login.php");
}
if ($_SESSION["perm"]) {
    redirect("home.php");
}

if (isPost()) {
    $arr = filter();
    //print_r($arr);
    $name = $arr["name"];
    $acc = $arr["acc"];
    $pass = $arr["pass"];
    $email = $arr["email"];
    $phone = $arr["phone"];
    $id = $arr["id"];
    $avt = $arr["avt"];

    $data = [
        "idUser" => $id,
        "account"=> $acc,
        "passwd" => $pass,
        "name"=> $name,
        "email" => $email,
        "phone" => $phone,
        "avatar" => $avt,
        "perm" => 1
    ];
    print_r($data);
    //$kq = insert('User', $data,);
    //print($kq);
    //redirect("manage_student.php");
}

?>

<form action="" method="post">
    <label for="name">Ten: </label>
    <input id="name" name="name" type="text" required> <br>
    <label for="acc">Tai khoan: </label>
    <input id="acc" name="acc" type="text" required> <br>
    <label for="pass">Mat khau: </label>
    <input id="pass" name="pass" type="text" required> <br>
    <label for="email">Email: </label>
    <input id="email" name="email" type="text" required> <br>
    <label for="phone">Dien thoai: </label>
    <input id="phone" name="phone" type="text" required> <br>
    <label for="id">ID </label>
    <input type = "text" id="id" name = "id" required> <br>
    <label for="avt">Avatar </label>
    <input type = "text" id="avt" name = "avt" required> <br>
    <button type="submit">Save</button>
</form>