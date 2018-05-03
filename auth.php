<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: loginPage.php");
    exit();
}
