<?php
session_start();
require_once("check.php");
require_once("database.php");

if (!isLogin()) {
    redirect("login.php");
} 

$myid = $_SESSION["id"];
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

    if (isPost()) {
        $arr = filter();
        $id = $arr["id"];
        $mess = $arr["mess"];
        $time = $arr["time"];
        $idmess = uniqid('mess');
        $data = [
            "idsend" => $myid,
            "idrecv" => $id,
            "mess" => $mess,
            "time" => $time,
            "idmess" => $idmess
        ];
        print_r($data);
        $kq = insert('message', $data);
        redirect("public_profile.php?id=$id");
    }
?>
<a href="home.php" title="Profile">Home</a> <br>
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

<div class="message"> 
    <form action="" method="post">
        <label for="mess">Nhan tin</label> <br>
        <textarea name="mess" id="mess" cols="50" rows="4" required></textarea> <br>
        <input type="hidden" name="time" value="<?php date_default_timezone_set('Asia/Ho_Chi_Minh'); echo date("Y-m-d H:i:s"); ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <button type="submit">Gui</button>
    </form>
</div>

<?php 
$sql1 = "SELECT * FROM message JOIN User ON message.idsend=User.idUser WHERE (idsend='$id' AND idrecv='$myid') OR (idsend='$myid' AND idrecv='$id') ORDER BY time ASC";
$kq = getRaw($sql1);
foreach ($kq as $message) {
?>
<b><?php echo $message["account"]; ?></b> 
<p><?php echo $message["mess"]; ?></p> 
<p><?php echo $message["time"]; ?></p>
<?php if($message["idUser"]==$myid) :?>
 <a href="delete_mess.php?idmess=<?php echo $message["idmess"];?>&iduser=<?php echo $id;?>" title="Delete">Xoa</a> <br>
<?php
endif;
}
?>     