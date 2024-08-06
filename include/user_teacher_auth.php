<?php
if(!isset($_SESSION['teacher_id']) && !isset($_SESSION['teacher_name'])){
    header("Location:user_teacher.php?error=This page requires a login Access,Log in with your Reg number!");
    exit();
}
?>