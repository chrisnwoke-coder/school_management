<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

$statment = $conn->prepare("SELECT * FROM department");
$statment->execute();
$record = array();
while($row = $statment->fetch(PDO::FETCH_BOTH)){
    $record[] = $row;
}
?>
<!doctype Html>
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv = "X-UA-compatible" content = "ie=edge">
<link rel = "stylesheet" type = "text/css" href = "../css/create_department.css" />
<title> Edit Department </title>
</head>

<body>


<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / edit-department</h1>

<h1><a href = "logout.php">Logout </a></h1>

</div>

<div class = "message">

<?php

if(isset($_GET['message'])){
    echo ($_GET['message']);
}

?>

</div>

<div class = "message">

<?php

if(isset($_GET['record'])){
    echo ($_GET['record']);
}

?>

</div>

<div class = "container">

<table border = "2">

<tr>
    <th> Department_id</th>
    <th> Department_name</th>
    <th> Created by </th>
    <th> Edit </th>
    <th> Delete </th>
    <th> Date Created </th>
    <th> Time Created </th>

</tr>

<?php foreach($record as $value): ?>
    <tr>
        <td class = "table-data"> <?= $value['department_id'] ?> </td>
        <td class = "table-data"> <?= $value['department_name'] ?> </td>
        <td class = "table-data"> <?= $value['created_by'] ?> </td>
        <td class = "table-data"> <a class = "paragraph1" href = "edit_dept.php?id=<?= $value['department_id'] ?>">Edit </td>
        <td class = "table-data"> <a class = "paragraph1" href = "delete_dept.php?id=<?= $value['department_id'] ?>">Delete </td>
        <td class = "table-data"> <?= $value['date_created'] ?> </td>
        <td class = "table-data"> <?= $value['time_created'] ?> </td>
</tr>

<?php endforeach; ?>

</table>

</div>

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>


<script type = "text/javascript" src="../script/main.js"></script>
</body>


</html>