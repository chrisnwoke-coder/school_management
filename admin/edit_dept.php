<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(isset($_GET['id'])){
$department_id = $_GET['id'];
}else{
    header("Location:edit_department.php");
}
$statement = $conn->prepare("SELECT * FROM department WHERE department_id=:di");
$statement->bindParam(":di",$department_id);
$statement->execute();

$record = $statement->fetch(PDO::FETCH_BOTH);

if($statement->rowCount() < 0){
    header("Location:edit_department.php");
}

if(array_key_exists('submit',$_POST)){
    $error = array();
if(empty($_POST['department'])){
    $error['department'] = "department name cannot be empty";
}else{
    $stmt = $conn->prepare("SELECT * FROM department WHERE department_name=:dn");
    $stmt->bindParam(":dn",$_POST['department']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['department'] = "department already exists!";
}
}

if(empty($error)){
    $update = $conn->prepare("UPDATE department SET department_name=:dn, created_by=:cb WHERE department_id=:di");
    $update->bindParam(":dn",$_POST['department']);
    $update->bindParam(":cb",$_SESSION['admin_id']);
    $update->bindParam(":di",$department_id);
    $update->execute();
header("Location:edit_department.php?record=changes has been made is successful");
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

<h1> Admin /<a href = "homepage.php"> dashboard </a> /<a href ="edit_department.php"> edit-department </a> </h1>

<h1><a href = "logout.php">Logout </a></h1>

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
    echo ($error['department']);
}
?>
</div>
    <input type = "text" name = "department" placeholder ="department name" value = "<?= $record['department_name'] ?>" />

    <input type = "submit" name = "submit" value ="Update"/>

</form>

</div>

</div><!--end of container-->

<script type = "text/javascript" src="../script/main.js"></script>

</body>

</html>