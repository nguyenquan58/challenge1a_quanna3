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

    if (!isset($_FILES["img"]) || $_FILES["img"]['error'] != 0) {
        $avt = 'default.jpg';
    }
    else {
        $check = getimagesize($_FILES["img"]["tmp_name"]);
        if($check !== false)
        {
            $avt = $_FILES["img"]["name"];
            $target_dir = '.image/';
            $target_file = $target_dir.basename($avt);
            print_r($_FILES["img"]);
            print($target_file);
            print($_FILES["img"]["tmp_name"]);
            $a = move_uploaded_file($_FILES["img"]["tmp_name"], $target_file);
        }
        else {
            $_SESSION["err"] = "Avatar khong phai file anh";
            redirect("add_student.php");
        }
    }

    $newid = uniqid('user');
    $data = [
        "idUser" => $newid,
        "account"=> $acc,
        "passwd" => $pass,
        "name"=> $name,
        "email" => $email,
        "phone" => $phone,
        "avatar" => $avt,
        "perm" => 1
    ];
    $kq = insert('User', $data);
    if ($kq)
    redirect("manage_student.php");
    else{
    $_SESSION["err"] = "Them sinh vien khong thanh cong";
    redirect("add_student.php");
    }
}
echo $_SESSION["err"]."<br>";
unset($_SESSION["err"]);
?>

<a href="home.php" title="Profile">Home</a> <br>
<form action="" method="post" enctype="multipart/form-data">
    <label for="name">Ten: </label>
    <input id="name" name="name" type="text" required> <br>
    <label for="acc">Tai khoan: </label>
    <input id="acc" name="acc" type="text" required> <br>
    <label for="pass">Mat khau: </label>
    <input id="pass" name="pass" type="text" minlength="6" required> <br>
    <label for="email">Email: </label>
    <input id="email" name="email" type="email" required> <br>
    <label for="phone">Dien thoai: </label>
    <input id="phone" name="phone" type="text" pattern="[0-9]{10}" required> <br>
    <label for="img">Avatar </label>
    <input type="file" name="img" id="img"> <br>
    <button type="submit">Save</button>
</form>