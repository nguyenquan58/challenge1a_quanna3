<?php
session_start();
require_once("check.php");
require_once("database.php");
if ($_SESSION["id"]) {
    $arr = filter();
    if (!empty($arr["id"]))
    {
        $id = $arr["id"];
        $sql = "SELECT * FROM User WHERE idUser='$id'";
        $data = getOneRaw($sql);
        //print_r($data);
        $acc = $data["account"];
        $pass = $data["passwd"];
        $name = $data["name"];
        $email = $data["email"];
        $phone = $data["phone"];
        $avt = $data["avatar"];
    }

?>
<a href="edit.php?id=<?php echo $id;?>" title="Update">Update</a> <br>
<div class="profile">
    <table>
        <tbody>
            <tr>
                <td>Tài khoản</td>
                <td>:</td>
                <td><?php echo $acc; ?></td>
            </tr>
            <tr>
                <td>Mật khẩu</td>
                <td>:</td>
                <td><?php echo $pass; ?></td>
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
        

<?php
}
else redirect("login.php");
?>