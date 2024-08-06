<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(!isset($_GET['id'])){
    header("Location:edit_student.php");
}
$statement = $conn->prepare("DELETE FROM student WHERE student_id=:sdi");
$statement->bindParam(":sdi",$_GET['id']);
$statement->execute();

header("Location:edit_student.php?message=record has been deleted successfully");
exit();