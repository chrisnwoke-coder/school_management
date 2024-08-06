<?php
if(!isset($_SESSION['admin_id']) && !isset($_SESSION['admin_name'])){
    header("Location:login.php?error=this page requires a login access");
    die();
}