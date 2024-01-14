<?php
session_start();

require_once("check.php");
require_once("database.php");

if (!isLogin()) {
    redirect("login.php");
}

$arr = filter();

if (!empty($arr["idmess"]))
{
    $idmess = $arr["idmess"];
    $iduser = $arr["iduser"];
    $cond = "idmess='$idmess'";
    $kq = delete('message', $cond);
    redirect("public_profile.php?id=$iduser");
}
else
redirect("home.php");

