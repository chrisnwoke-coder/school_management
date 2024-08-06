<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(!isset($_GET['id'])){
    header("Location:edit_department.php");
}
$statement = $conn->prepare("DELETE FROM department WHERE department_id=:di");
$statement->bindParam(":di",$_GET['id']);
$statement->execute();

header("Location:edit_department.php?message=Record deleted Successfully");
exit();

?>