<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(isset($_POST['submit'])){
    $error = array();
if(empty($_POST['tname'])){
    $error['tname'] = "Enter your name";
}if(!preg_match("/^[a-zA-Z ]*$/",$_POST['tname'])) {
    $error['tname'] = "Only letters and white space allowed"; 
}else{
    $stmt = $conn->prepare("SELECT * FROM teacher WHERE teacher_name=:tn");
    $stmt->bindParam(":tn",$_POST['tname']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['tname'] = "teacher's name already exists,another name is required";
}
}

if(empty($_POST['temail'])){
    $error['temail'] = "Email is empty";
}else{
    $fetch = $conn->prepare("SELECT * FROM teacher WHERE teacher_email=:te");
    $fetch->bindParam(":te",$_POST['temail']);
    $fetch->execute();
if($fetch->rowCount() > 0){
    $error['temail'] = "Email already exists, another email is required";
}
}

if(empty($_POST['gender'])){
    $error['gender'] = "please select an option";
}

if(empty($error)){

$regnumber = "15".rand(10000,99999);

$statement = $conn->prepare("INSERT INTO teacher VALUES(NULL,:tn,:te,:tg,:trn,:cb,NOW(),NOW() )");
$data = array(
             ":tn"=>$_POST['tname'],
             ":te"=>$_POST['temail'],
             ":tg"=>$_POST['gender'],
             ":trn"=>$regnumber,
             ":cb"=>$_SESSION['admin_id'],
);
$statement->execute($data);

header("Location:create_teacher.php?message=Created Successfully");

exit();
}
}

?>


<!doctype Html>
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv = "X-UA-compatible" content = "ie=edge">
<link rel = "stylesheet" type = "text/css" href = "../css/student.css" />
<title> Teacher Registration </title>
</head>

<body>
<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / create-teacher</h1>

<h1><a href = "logout.php">Logout </a></h1>
</div>


<div class = "overall">


<form action = "" method = "POST">

<h1 class = "header">TEACHER REGISTRATION</h1>

<div id = "message">
<?php

if(isset($_GET['message'])){
    echo ($_GET['message']);
}

?>

</div>


<fieldset class = "fieldset">


<div class = "error_1">
<?php
if(isset($error['tname'])){
    echo ($error['tname']);
}
?>
</div>
   
<p class = "paragraph">TEACHER NAME: <input type = "text" name = "tname" placeholder = "Enter your name" /></p>


<div class = "error_1">
<?php
if(isset($error['temail'])){
    echo ($error['temail']);
}
?>
</div>

<p class = "paragraph">TEACHER EMAIL: <input type = "email" name = "temail" placeholder = "Enter your email" /></p>


<div class = "error_1">
<?php
if(isset($error['gender'])){
    echo ($error['gender']);
}
?>
</div>

<p class = "paragraph">GENDER:

<select name = "gender">
<option class = "paragraph" disabled selected>---SELECT A GENDER----</option>
<option class = "paragraph" value = "Male"> Male </option>
<option class = "paragraph" value = "female"> Female </option>
</select>

</p>

<input type = "submit" name = "submit" value = "SUBMIT"/>

</fieldset>

</form>


</div>

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>

<script type = "text/javascript" src="../script/main.js"></script>
</body>

</html>