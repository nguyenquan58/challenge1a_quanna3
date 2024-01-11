<?php
session_start();
require_once("check.php");
if (!isLogin()) {
    redirect("login.php");
}
$id = $_SESSION["id"]; 
?>

<h1>WELCOME <?php echo $_SESSION["name"]; ?>!</h1>
<a href="profile.php?id=<?php echo $id;?>" title="Profile">Profile</a> <br>
<a href="list.php" title="List">Danh sach nguoi dung</a> <br>
Click here to  <a href="logout.php" title="Logout"> Logout.</a>
<?php
