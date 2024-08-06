<?php
session_start();
include("../include/db.php");
include("../include/admin_auth.php");

$fetch = $conn->prepare("SELECT * FROM department");
$fetch->execute();
$record = array();
while($row = $fetch->fetch(PDO::FETCH_BOTH)){
    $record[] = $row;
}

if(array_key_exists('submit',$_POST)){
    $error = array();
if(empty($_POST['department'])){
    $error['department'] = "Enter department";
}else{
    $stmt = $conn->prepare("SELECT * FROM department WHERE department_name=:dn");
    $stmt->bindParam(":dn",$_POST['department']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['department'] = "department already exists";
}
}

if(empty($error)){
    $statement = $conn->prepare("INSERT INTO department VALUES(NULL,:dn,:cb,NOW(),NOW() )");
    $statement->bindParam(":dn",$_POST['department']);
    $statement->bindParam(":cb",$_SESSION['admin_id']);
    $statement->execute();
header("Location:create_department.php?success=department created successfully");
exit();
}


}
?>


<!doctype Html>
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv = "X-UA-compatible" content = "ie=edge">
<link rel = "stylesheet" type = "text/css" href = "../css/create_department.css" />
<title> Create Department </title>
</head>

<body>


<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / create-department</h1>

<h1><a href = "logout.php">Logout </a></h1>

</div>

<div class = "message">

<?php
if(isset($_GET['success'])) {
    echo($_GET['success']);
}
?>
</div>


<div class = "container">


<div class = "content">
    <h1 class = "paragraph"> CREATE DEPARTMENT </h1>
</div>


<div class = "content1">


<form action = "" method ="POST">
  
<div class = "error_1">

 <?php
  if(isset($error['department'])){
    echo($error['department']);
  }
  ?>

</div>

<input type = "text" name = "department" placeholder ="department name"/>

<input type = "submit" name = "submit" value ="create department"/>

</form>

</div>

<table border="2">
    <tr>
        <th>department name</th>
        <th>Created By</th>
        <th>Date_Created</th>
        <th>Time_Created</th>
  </tr>

<?php foreach($record as $value): ?>
<tr>
    <td> <?= $value['department_name'] ?> </td>
    <td class = "table-data"> <?= $value['created_by'] ?> </td>
    <td class = "table-data"> <?= $value['date_created'] ?> </td>
    <td class = "table-data"> <?= $value['time_created'] ?> </td>
</tr>

<?php endforeach; ?>


</table>


</div><!---end of container-->

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>

<script type = "text/javascript" src="../script/main.js"></script>
</body>
</html>