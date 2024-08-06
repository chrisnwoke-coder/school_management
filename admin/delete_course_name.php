<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(!isset($_GET['id'])){
    header("Location:edit_courses.php");
}

$statement = $conn->prepare("DELETE FROM course WHERE course_id=:cid");
$statement->bindParam(":cid",$_GET['id']);
$statement->execute();

header("Location:edit_courses.php?message=record deleted successfully");

?>