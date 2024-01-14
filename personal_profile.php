<?php
session_start();
require_once("check.php");
require_once("database.php");

if (!isLogin()) {
    redirect("login.php");
} 

$id = $_SESSION["id"];
$sql = "SELECT * FROM User WHERE idUser='$id'";
$data = getOneRaw($sql);
//print_r($data);
$acc = $data["account"];
$pass = $data["passwd"];
$name = $data["name"];
$email = $data["email"];
$phone = $data["phone"];
$avt = $data["avatar"];

?>
<a href="home.php" title="Profile">Home</a> <br>
<a href="edit.php?id=<?php echo $_SESSION["id"] ;?>" title="Update">Chinh sua</a>
<div class="profile">
    <image src="./image/<?php echo $avt; ?>" alt="fail" width="200" height="200">
    <table>
        <tbody>
            <tr>
                <td>Tài khoản</td>
                <td>:</td>
                <td><?php echo $acc; ?></td>
            </tr>
            <tr>
                <td>Mat khau</td>
                <td>:</td>
                <td><?php echo $pass; ?></td>
            </tr>
            <tr>
                <td>Ho ten</td>
                <td>:</td>
                <td><?php echo $name; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <td>Điện thoại</td>
                <td>:</td>
                <td><?php echo $phone; ?></td>
            </tr>
        </tbody>
    </table>
</div>
