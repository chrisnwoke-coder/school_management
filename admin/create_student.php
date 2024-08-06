<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(isset($_POST['submit'])){
    $error = array();
if(empty($_POST['stdname'])){
    $error['stdname'] = "Enter your name";
}else{
    $stmt = $conn->prepare("SELECT * FROM student WHERE student_name=:sn");
    $stmt->bindParam(":sn",$_POST['stdname']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['stdname'] = "Student name already exists,another name is required";
}
}

if(empty($_POST['stdemail'])){
    $error['stdemail'] = "Email is empty";
}else{
    $fetch = $conn->prepare("SELECT * FROM student WHERE student_email=:se");
    $fetch->bindParam(":se",$_POST['stdemail']);
    $fetch->execute();
if($fetch->rowCount() > 0){
    $error['stdemail'] = "Email already exists, another email is required";
}
}

if(empty($_POST['gender'])){
    $error['gender'] = "please select an option";
}

if(empty($error)){

$regnumber = "15".rand(1000,9999);

$statement = $conn->prepare("INSERT INTO student VALUES(NULL,:sn,:se,:sg,:srn,:cb,NOW(),NOW() )");
$data = array(
             ":sn"=>$_POST['stdname'],
             ":se"=>$_POST['stdemail'],
             ":sg"=>$_POST['gender'],
             ":srn"=>$regnumber,
             ":cb"=>$_SESSION['admin_id'],

);
$statement->execute($data);

header("Location:create_student.php?message=Created Successfully");

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
<title> Student Registration </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / create-student</h1>

<h1><a href = "logout.php">Logout </a></h1>

</div>


<div class = "overall">


<form action = "" method = "POST">

<h1 class = "header">STUDENT REGISTRATION</h1>

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
if(isset($error['stdname'])){
    echo ($error['stdname']);
}
?>
</div>
   
<p class = "paragraph">STUDENT NAME: <input type = "text" name = "stdname" placeholder = "Enter your name" /></p>

<div class = "error_1">
<?php
if(isset($error['stdemail'])){
    echo ($error['stdemail']);
}
?>
</div>

<p class = "paragraph">STUDENT EMAIL: <input type = "email" name = "stdemail" placeholder = "Enter your email" /></p>

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