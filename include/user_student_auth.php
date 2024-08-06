<?php
if(!isset($_SESSION['student_id']) && !isset($_SESSION['student_name'])){
    header("Location:user_student.php?message=This page requires a Login Access,Login with your Reg Number");
    exit();
}