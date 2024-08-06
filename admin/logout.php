<?php
session_start();
include ("../include/admin_auth.php");
unset($_SESSION['admin_id']);
unset($_SESSION['admin_name']);
session_destroy();
header("Location:login.php");
exit();