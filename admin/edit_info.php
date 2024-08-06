<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(isset($_GET['id'])){
    $teacher_id = $_GET['id'];
}else{
    header("Location:edit_teacher.php");
}

$statement = $conn->prepare("SELECT * FROM teacher WHERE teacher_id=:tid");
$statement->bindParam(":tid",$teacher_id);
$statement->execute();

$record = $statement->fetch(PDO::FETCH_BOTH);

if($statement->rowCount() < 0){
    header("Location:edit_teacher.php");
}

if(array_key_exists('submit',$_POST)){
    $error = array();
if(empty($_POST['tname'])){
    $error['tname'] = "Teacher's name cannot be empty";
}else{
    $stmt = $conn->prepare("SELECT * FROM teacher WHERE teacher_name=:tn");
    $stmt->bindParam(":tn",$_POST['tname']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['tname'] = "Teacher name already exists";
}
}
if(empty($_POST['temail'])){
    $error['temail'] = "Email cannot be empty";
}else{
    $fetch = $conn->prepare("SELECT * FROM teacher WHERE teacher_email=:te");
    $fetch->bindParam(":te",$_POST['temail']);
    $fetch->execute();
if($fetch->rowCount() > 0){
    $error['temail'] = "email already exists, another email is required";
}
}

if(empty($_POST['gender'])){
    $error['gender'] = "select an option";
}

if(empty($error)){

    $regnumber = "15".rand(10000,99999);
    $update = $conn->prepare("UPDATE teacher SET teacher_name=:tn, teacher_email=:te, gender=:gn, teacher_reg_num=:rg, created_by=:cb WHERE teacher_id=:tid");
    $data = array(
            ":tn"=>$_POST['tname'],
            ":te"=>$_POST['temail'],
            ":gn"=>$_POST['gender'],
            ":cb"=>$_SESSION['admin_id'],
            ":rg"=>$regnumber,
            ":tid"=>$teacher_id,
    );
$update->execute($data);
header("Location:edit_teacher.php?success=record has been updated successfully");
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
<title> Edit Teacher </title>
</head>

<body>


<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / <a href = "edit_teacher.php">edit-teacher </a></h1>

<h1><a href = "logout.php">Logout </a></h1>

</div>

<div class = "overall">


<form action = "" method = "POST">

<h1 class = "header">EDIT TEACHER INFO</h1>


<fieldset class = "fieldset">

<?php
if(isset($error['tname'])){
    echo "<p style = 'color: red; text-align:center; margin-top:20px; margin-left: 200px;'>".$error['tname']."</p>";
}
?>
   
<p class = "paragraph">TEACHER NAME: <input type = "text" name = "tname" placeholder = "Enter your name" value = "<?= $record['teacher_name'] ?>" /></p>

<?php
if(isset($error['temail'])){
    echo "<p style = 'color: red; text-align:center; margin-top:20px; margin-left: 200px;'>".$error['temail']."</p>";
}
?>

<p class = "paragraph">TEACHER EMAIL: <input type = "email" name = "temail" placeholder = "Enter your email" value = "<?= $record['teacher_email'] ?>" /></p>

<?php
if(isset($error['gender'])){
    echo "<p style = 'color: red; text-align:center; margin-top:20px; margin-left: 200px;'>".$error['gender']."</p>";
}
?>

<p class = "paragraph">GENDER:

<select name = "gender">
<option class = "paragraph" disabled selected>---SELECT A GENDER----</option>
<option class = "paragraph" value = "Male"> Male </option>
<option class = "paragraph" value = "female"> Female </option>
</select>

</p>

<p class = "paragraph">REG NUMBER: <input type = "text" name = "regnumber" placeholder = "15#####" value = "<?= $record['teacher_reg_num'] ?>" /></p>

<input type = "submit" name = "submit" value = "UPDATE"/>

</fieldset>

</form>


</div>


<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>

</body>

</html>