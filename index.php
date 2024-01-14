<?php 
session_start();
require_once("check.php");

if(!isset($_SESSION["id"]))
    redirect("login.php");
else
    redirect("home.php");
?>