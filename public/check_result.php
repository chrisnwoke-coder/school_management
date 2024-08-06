<?php
session_start();
include("../include/db.php");
include("../include/admin_auth.php");

$stmt = $conn->prepare("SELECT * FROM result WHERE student_id=:id");
$stmt->bindParam(":id",$_SESSION['student_id']);
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
<title> Result </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'>Student_id:<?= $_SESSION['student_id'] ?></h1>
<h1 style = 'font-size:17px; color:white;'>Student_name:<?= $_SESSION['student_name'] ?></h1>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> User / Dashboard /<a href = "home_student.php"> student-info </a> / result </h1>

<h1><a href = "user_student.php">Logout </a></h1>

</div>


<div class = "container">

<table border = "2">
    <tr>
        <th> Result Id </th>
        <th> Course Code </th>
        <th> Grade </th>
        <th> Date Created </th>
        <th> Time Created </th>
</tr>

<?php foreach($record as $value): 

$course = $conn->prepare("SELECT * FROM course WHERE course_id=:di");
$course->bindParam(":di",$value['course_id']);
$course->execute();

$course_record = $course->fetch(PDO::FETCH_BOTH);


$dept = $conn->prepare("SELECT * FROM department WHERE department_id=:tid");
$dept->bindParam(":tid",$value['department_id']);
$dept->execute();

$department = $dept->fetch(PDO::FETCH_BOTH);

?>

<tr>
    <td class = "table-data"><?= $value['result_id'] ?> </td>
    <td class = "table-data"><?= $course_record['course_name'] ?> </td>
    <td class = "table-data"><?= $value['grade'] ?> </td>
    <td class = "table-data"><?= $value['date_created'] ?> </td>
    <td class = "table-data"><?= $value['time_created'] ?> </td>
</tr>

<?php endforeach; ?>

</table>

</div> <!--end of container--->

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>

</body>

</html>
