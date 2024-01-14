<?php
session_start();
require_once("check.php");
if (!isLogin()) {
    redirect("login.php");
}
$id = $_SESSION["id"]; 
$perm=$_SESSION["perm"];
?>
<h1>WELCOME <?php echo $_SESSION["name"]; ?>!</h1>
<a href="personal_profile.php" title="Profile">Profile</a> <br>
<a href="list.php" title="List">Danh sach nguoi dung</a> <br>
<?php if (!$perm): ?>    
<a href="manage_student.php" title="Manage">Quan ly sinh vien</a> <br>
<?php endif; ?>
Click here to  <a href="logout.php" title="Logout"> Logout.</a>
<?php
