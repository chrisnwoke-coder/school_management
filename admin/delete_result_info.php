<?php
session_start();
include("../include/db.php");
include("../include/admin_auth.php");

if(!isset($_GET['id'])){
    header("Location:edit_result.php");
    exit();
}
$stmt = $conn->prepare("DELETE FROM result WHERE result_id=:rs");
$stmt->bindParam(":rs",$_GET['id']);
$stmt->execute();
header("Location:edit_result.php?success=record deleted successfully");
exit();