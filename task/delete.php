<?php
session_start();
if (isset($_SESSION["user"]) && isset($_GET['id'])) {
    require "../helper/DBHelper.php";
    $db = DBHelper::getInstance();
    $db->deleteTask($_GET['id']);
    header("Location: ../home.php");
} else header("Location: ../login.php");