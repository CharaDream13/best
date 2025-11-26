<?php
require_once "db.php";
session_destroy();
header("Location: ../main/about_us.php");
exit;
?>