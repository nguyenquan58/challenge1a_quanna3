<?php
session_start();

require_once('check.php');
unset($_SESSION["id"]);
unset($_SESSION["name"]);
redirect("login.php");