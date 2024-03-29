<?php

require_once("connect.php");
require_once("database.php");

function isGet() {
    if ($_SERVER['REQUEST_METHOD']=='GET')
    return true;
return false;
}

function isPost() {
    if ($_SERVER['REQUEST_METHOD']=='POST') {
    return true;}
return false;
}

function filter() {
    $array = [];

    if (isGet()) {
        if (!empty($_GET)) {
            foreach ($_GET as $key => $value) {
                $array[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $array;
    }

    if (isPost()) {
        if (!empty($_POST)) {
            foreach ($_POST as $key => $value) {
                $array[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $array;
    }
}

function redirect($url) {
    header ("location:$url");
    exit;
}

function isLogin() {
    if (!empty($_SESSION["id"])) {
        $id = $_SESSION["id"];
        $sql = "SELECT * FROM User WHERE idUser='$id'";
        $data = getoneRaw($sql);
        if (!empty($data))
            return true;
    }
    return false;
}
