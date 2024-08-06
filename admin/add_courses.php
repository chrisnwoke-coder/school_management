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

$data = $conn->prepare("SELECT * FROM teacher");
$data->execute();
$record_value = array();
while($row_value = $data->fetch(PDO::FETCH_BOTH)){
    $record_value[] = $row_value;
}

if(array_key_exists('submit',$_POST)){
    $error = array();
if(empty($_POST['course-name'])){
    $error['course-name'] = "course name is required";
}else{
    $stmt = $conn->prepare("SELECT * FROM course WHERE course_name=:cn");
    $stmt->bindParam(":cn",$_POST['course-name']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['course-name'] = "course name already exist, enter another course";
}
}

if(empty($_POST['teacher-name'])){
    $error['teacher-name'] = "teacher id cannot be empty";
}else{
if(!is_numeric($_POST['teacher-name'])){
    $error['teacher-name'] = "only numeric value is required";
}
}

if(empty($error)){
    $statement = $conn->prepare("INSERT INTO course VALUES(NULL,:cn,:dp,:cb,:ti,NOW(),NOW() ) ");
    $statement->bindParam(":cn",$_POST['course-name']);
    $statement->bindParam(":dp",$_POST['department']);
    $statement->bindParam(":cb",$_SESSION['admin_id']);
    $statement->bindParam(":ti",$_POST['teacher-name']);
    $statement->execute();
header("Location:add_courses.php?message=Course Added Successfully");
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
<title> Add Courses </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / add-courses</h1>

<h1><a href = "logout.php">Logout </a></h1>
</div>



<div class = "overall">


<form action = "" method = "POST">

<h1 class = "header">ADD COURSES</h1>

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
if(isset($error['course-name'])){
    echo ($error['course-name']);
}
?>
</div>
   
<p class = "paragraph">COURSE CODE: <input type = "text" name = "course-name" placeholder = "Enter your course code" /></p>


<div class = "error_1">
<?php
if(isset($error['teacher-name'])){
    echo ($error['teacher-name']);
}
?>
</div>
   
<p class = "paragraph">TEACHER ID: <input type = "text" name = "teacher-name" placeholder = "Enter teacher id" /></p>


<div class = "section">

<p class = "paragraph">DEPARTMENT:</p>

<select name = "department">

<?php foreach($record as $data): ?>

<option value = "<?= $data['department_id'] ?>" >

<?= $data['department_name'] ?>


<?php endforeach; ?>

</select>

</div>

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