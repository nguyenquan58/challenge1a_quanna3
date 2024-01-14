<?php
session_start();
require_once("check.php");
require_once("database.php");

if (!isLogin()) {
    redirect("login.php");
}

$sql = "SELECT * FROM User ORDER BY perm";
$list = getRaw($sql);
$count = 1;
?>

<a href="home.php" title="Profile">Home</a> <br>

<h2>Danh sách người dùng<h2>

<table>
    <head>
        <th>STT</th>
        <th>Ten</th>
        <th>Thong tin</th>
    </head>
    <body>
        <?php
        foreach($list as $user) {
            if ($user["idUser"]!=$_SESSION["id"])
            {
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $user["name"]; ?></td>
            <td><a href="public_profile.php?id=<?php echo $user["idUser"];?>" title="Profile"><?php echo $user["perm"] ? "Sinh vien" : "Giang vien"; ?></a></td>
            </tr>
        <?php
        $count++;
            }
        }
        ?>
    </body>
</table>