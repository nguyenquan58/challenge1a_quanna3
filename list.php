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
        ?>
        <tr>
            <td><?php echo $count; ?></td>
            <td><?php echo $user["name"]; ?></td>
            <td><a href="profile.php?id=<?php echo $user["idUser"];?>" title="Profile">Xem</a></td>
            </tr>
        <?php
        $count++;
        }
        ?>
    </body>
</table>