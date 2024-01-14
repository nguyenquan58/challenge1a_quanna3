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

$arr = filter();
if (!empty($arr["id"]))
{
    $id = $arr["id"];
    echo $id;
    $cond3 = "idUser='$id'";
    $cond1 = "idsend='$id'";
    $cond2 = "idrecv='$id'";
    $kq1 = delete('message', $cond1);
    $kq2 = delete('message', $cond2);
    $kq2 = delete('User', $cond3);


}
redirect("manage_student.php");
