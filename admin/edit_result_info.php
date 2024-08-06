<?php
session_start();
include("../include/db.php");
include("../include/admin_auth.php");

if(isset($_GET['id'])){
    $result_id = $_GET['id'];
}else{
    header("Location:edit_result.php");
}

$statement = $conn->prepare("SELECT * FROM result WHERE result_id=:ri");
$statement->bindParam(":ri",$result_id);
$statement->execute();

$record = $statement->fetch(PDO::FETCH_BOTH);

if($statement->rowCount() < 0){
    header("Location:edit_result.php");
}

if(array_key_exists('submit',$_POST)){
    $error = array();
if(empty($_POST['student-score'])){
    $error = "value is required";
}elseif(!is_numeric($_POST['student-score'])){
    $error['student-score'] = "numeric value is required";
}
if(empty($_POST['course-code'])){
    $error = "value is required";
}elseif(!is_numeric($_POST['course-code'])){
    $error['course-code'] = "numeric value is required";
}
if(empty($_POST['student-info'])){
    $error['student-info'] = "value is required";
}elseif(!is_numeric($_POST['student-info'])){
    $error = "numeric value is required";
}

if(empty($error)){

 if($_POST['student-score'] >= 80 && $_POST['student-score'] <= 100){
    $grade = "A";
}elseif($_POST['student-score'] >= 75 && $_POST['student-score'] <=80){
    $grade = "AB";
}elseif($_POST['student-score'] >= 65 && $_POST['student-score'] <=75){
    $grade = "B";
}elseif($_POST['student-score'] >= 55 && $_POST['student-score'] <=65){
     $grade = "BC";
 }elseif($_POST['student-score'] >= 45 && $_POST['student-score'] <=55){
    $grade = "C";
}elseif($_POST['student-score'] >= 35 && $_POST['student-score'] <=45){
     $grade = "CD";
}elseif($_POST['student-score'] >= 25 && $_POST['student-score'] <=35){
    $grade = "pass";
}elseif($_POST['student-score'] >=10 && $_POST['student-score'] <=25){
    $grade = "fail";
}
$stmt = $conn->prepare("UPDATE result SET student_score=:sc, grade=:gd, course_id=:cd, student_id=:si WHERE result_id=:ri");
$update = array(
        ":sc"=>$_POST['student-score'],
        ":gd"=>$grade,
        ":cd"=>$_POST['course-code'],
        ":si"=>$_POST['student-info'],
        ":ri"=>$result_id,
);
$stmt->execute($update);
header("Location:edit_result.php?message=record updated successfully");
exit();
}


}


?>

<!doctype Html>
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv = "X-UA-compatible" content = "ie=edge">
<link rel = "stylesheet" type = "text/css" href = "../css/add_courses.css" />
<title> Edit Result </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / <a href = "edit_result.php"> edit-result </a></h1>

<h1><a href = "logout.php">Logout </a></h1>
</div>


<div class = "overall">


<form action = "" method = "POST">

<h1 class = "header">EDIT RESULT</h1>


<div class = "message">

<?php

if(isset($_GET['message'])){
    echo ($_GET['message']);
}

?>

</div>

<fieldset class = "fieldset">

<?php
if(isset($error['student-score'])){
    echo "<p style = 'color: red; text-align:center; margin-top:20px; margin-left: 150px;'>".$error['student-score']."</p>";
}
?>
   
<p class = "paragraph">STUD SCORE: <input type = "text" name = "student-score" placeholder = "Enter student score" value = "<?= $record['student_score'] ?>" /></p>

<?php
if(isset($error['course-code'])){
    echo "<p style = 'color: red; text-align:center; margin-top:20px; margin-left: 150px;'>".$error['course-code']."</p>";
}
?>
   
<p class = "paragraph">COURSE ID: <input type = "text" name = "course-code" placeholder = "Enter course id"  value = "<?= $record['course_id'] ?>"/></p>


<?php
if(isset($error['student-info'])){
    echo "<p style = 'color: red; text-align:center; margin-top:20px; margin-left: 150px;'>".$error['student-info']."</p>";
}
?>
   
<p class = "paragraph">STUDENT ID: <input type = "text" name = "student-info" placeholder = "Enter student id" value = "<?= $record['student_id'] ?>" /></p>


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