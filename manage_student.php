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

$sql = "SELECT * FROM User WHERE perm=1";
$list = getRaw($sql);
$count = 1;
?>

<h2>Danh sách sinh vien<h2>
<h3><a href="add_student.php" title="Add">Them sinh vien moi</a></h3>

<table>
    <head>
        <th>STT</th>
        <th>Ten</th>
        <th>Sua</th>
        <th>Xoa</th>
    </head>
    <body>
        <?php
        foreach($list as $user) {
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $user["name"]; ?></td>
            <td><a href="edit.php?id=<?php echo $user["idUser"];?>" title="Update">Chon</a></td>
            <td><a href="delete.php?id=<?php echo $user["idUser"];?>" title="Delete">Chon</a></td>
            </tr>
        <?php
        $count++;
            }
        ?>
    </body>
</table>