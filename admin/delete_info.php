<?php
session_start();
include ('../include/authenticate.php');
include ('../include/db.php');
if(!isset($_GET['id'])){
    header("Location:edit_teacher.php");
    exit();
}

$statement= $conn->prepare("DELETE FROM teacher WHERE teacher_id=:tid");
$statement->bindParam(":tid",$_GET['id']);
$statement->execute();

header("Location:edit_teacher.php?message=record has been deleted successfully");
exit();

