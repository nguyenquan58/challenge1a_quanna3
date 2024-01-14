<?php
session_start();
require_once("check.php");
require_once("database.php");

if (!isLogin()) {
    redirect("login.php");
} 

$arr = filter();
if (empty($arr["id"]))
{
    redirect("home.php");
}
else {
    $id = $arr["id"];
    if ($_SESSION["perm"]==1 && $_SESSION["id"]!=$id) {
        redirect("home.php");
    }
    else {
        $sql = "SELECT * FROM User WHERE idUser='$id'";
        $user = getOneRaw($sql);
        $acc = $user["account"];
        $pass = $user["passwd"];
        $name = $user["name"];
        $email = $user["email"];
        $phone = $user["phone"];
        $avt = $user["avatar"];
    }
}

if (isPost()) {
    $arr = filter();
    $acc = $arr["acc"];
    $pass = $arr["pass"];
    $name = $arr["name"];
    $email = $arr["email"];
    $phone = $arr["phone"];
    $id = $arr["id"];

    if (isset($_FILES["img"]) && $_FILES["img"]['error'] == 0) {
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
            var_dump($b);
        }
        else {
            $_SESSION["err"] = "Avatar khong phai file anh";
            redirect("edit.php?id=$id");
        }
    }

    if ($_SESSION["perm"]) {
        $data = [
            "passwd" => $pass,
            "email" => $email,
            "phone" => $phone,
            "avatar" => $avt
        ];
    }
    else {
        $data = [
            "account" => $acc,
            "passwd" => $pass,
            "name" => $name,
            "email" => $email,
            "phone" => $phone,
            "avatar" => $avt
        ];
    }
    $cond = "idUser='$id'";
    $kq = update('User', $data, $cond);
    if ($kq) {
        if($_SESSION["id"]!=$id) 
            redirect("manage_student.php");
        else
            redirect("personal_profile.php?id=$id");
    }
    else {
        $_SESSION["err"] = "Thay doi khong thanh cong";
        redirect("edit.php?id=$id");
    }
}
echo $_SESSION["err"]."<br>";
unset($_SESSION["err"]);
?>

<a href="home.php" title="Profile">Home</a> <br>

<form action="" method="post" enctype="multipart/form-data">
    <image src="./image/<?php echo $avt; ?>" alt="fail" width="200" height="200"> <br>
    <input type="file" name="img"> <br>
    <?php if ($_SESSION["perm"]) { ?>
    <label for="name">Ten: </label>
    <input id="name" name="name" type="text" value="<?php echo $name; ?>" readonly> <br>
    <label for="acc">Tai khoan: </label>
    <input id="acc" name="acc" type="text" value="<?php echo $acc; ?>" readonly> <br>
    <?php } else { ?>
    <label for="name">Ten: </label>
    <input id="name" name="name" type="text" value="<?php echo $name; ?>" required> <br>
    <label for="acc">Tai khoan: </label>
    <input id="acc" name="acc" type="text" value="<?php echo $acc; ?>" required> <br>
    <?php } ?>
    <label for="pass">Mat khau: </label>
    <input id="pass" name="pass" type="text" value="<?php echo $pass; ?>" minlength="6" required> <br>
    <label for="email">Email: </label>
    <input id="email" name="email" type="email" value="<?php echo $email; ?>" required> <br>
    <label for="phone">Dien thoai: </label>
    <input id="phone" name="phone" type="text" value="<?php echo $phone; ?>" pattern="[0-9]{10}" required> <br>
    <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
    <button type="submit">Save</button>
</form>

<?php

?>