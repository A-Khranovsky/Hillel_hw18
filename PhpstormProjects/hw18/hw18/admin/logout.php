<?php
session_start();
unset($_SESSION['access']);
header("Location: \admin\login.php");
?>