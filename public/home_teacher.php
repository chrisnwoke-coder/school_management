<?php
session_start();
include("../include/user_teacher_auth.php");
include("../include/db.php");

$stmt = $conn->prepare("SELECT * FROM course");
$stmt->execute();

$record = array();

while($row = $stmt->fetch(PDO::FETCH_BOTH)){
    $record[] = $row;
}


?>


<!doctype Html>
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv = "X-UA-compatible" content = "ie=edge">
<link rel = "stylesheet" type = "text/css" href = "../css/create_department.css" />
<title> Teacher Login </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'>Teacher_id:<?= $_SESSION['teacher_id'] ?></h1>
<h1 style = 'font-size:17px; color:white;'>Teacher_name:<?= $_SESSION['teacher_name'] ?></h1>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> User / Dashboard / teacher-info </h1>

<h1><a href = "user_teacher.php">Logout </a></h1>

</div>

<div class = "message">

<?php

if(isset($_GET['success'])){
    echo($_GET['success']);
}

?>

</div>

<div class = "container">

<table border = "2">
    <tr>
        <th> Course Id </th>
        <th> Course Code </th>
        <th> Department </th>
        <th> Teacher </th>
        <th> Date Created </th>
        <th> Time Created </th>
</tr>

<?php foreach($record as $value): 

$dept = $conn->prepare("SELECT * FROM department WHERE department_id=:di");
$dept->bindParam(":di",$value['department_id']);
$dept->execute();

$department = $dept->fetch(PDO::FETCH_BOTH);


$teach = $conn->prepare("SELECT * FROM teacher WHERE teacher_id=:tid");
$teach->bindParam(":tid",$value['teacher_id']);
$teach->execute();

$teacher = $teach->fetch(PDO::FETCH_BOTH);

?>

<tr>
    <td class = "table-data"><?= $value['course_id'] ?> </td>
    <td class = "table-data"><?= $value['course_name'] ?> </td>
    <td class = "table-data"><?= $department['department_name'] ?> </td>
    <td class = "table-data"><?= $teacher['teacher_name'] ?> </td>
    <td class = "table-data"><?= $value['date_created'] ?> </td>
    <td class = "table-data"><?= $value['time_created'] ?> </td>
</tr>

<?php endforeach; ?>

</table>

</div> <!--end of container--->

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>


<script type = "text/javascript" src="../script/main.js"></script>
</body>

</html>