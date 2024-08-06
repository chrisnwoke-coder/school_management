<?php
session_start();
include("../include/admin_auth.php");
include("../include/db.php");

if(isset($_GET['id'])){
    $course_id = $_GET['id'];
}else{
    header("Location:edit_courses.php");
}

$statememt = $conn->prepare("SELECT * FROM course WHERE course_id=:cid");
$statememt->bindParam(":cid",$course_id);
$statememt->execute();

$record = $statememt->fetch(PDO::FETCH_BOTH);

if($statememt->rowCount() < 0){
    header("Location:edit_courses.php");
}

$fetch = $conn->prepare("SELECT * FROM department");
$fetch->execute();

$data = array();
while($row = $fetch->fetch(PDO::FETCH_BOTH)){
    $data[] = $row;
}

if(array_key_exists('submit',$_POST)){
    $error = array();

if(empty($_POST['course-name'])){
    $error['course-name'] = "course cannot be empty";
}else{
    $stmt = $conn->prepare("SELECT * FROM course WHERE course_name=:cn");
    $stmt->bindParam(":cn",$_POST['course-name']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['course-name'] = "course name already exists";
}
}

if(empty($_POST['dept-id'])){
    $error['dept-id'] = "Choose a department id";
}else{
    if(!is_numeric($_POST['dept-id'])){
        $error['dept-id'] = "only numeric value is required";
    }
}

if(empty($_POST['teacher-id'])){
    $error['teacher-id'] = "Choose a teacher id";
}else{
    if(!is_numeric($_POST['teacher-id'])){
        $error['teacher-id'] = "only numeric value is required";
    }
}

if(empty($error)){
    $update = $conn->prepare("UPDATE course SET course_name=:cn, department_id=:dp, created_by=:cb, teacher_id=:ti WHERE course_id=:cid");
    $record_value = array(
           ":cn"=>$_POST['course-name'],
           ":dp"=>$_POST['dept-id'],
           ":cb"=>$_SESSION['admin_id'],
           ":ti"=>$_POST['teacher-id'],
           ":cid"=>$course_id,
    );
$update->execute($record_value);
header("Location:edit_courses.php?success=record successfully updated");
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
<title> Edit Courses </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> /<a href = "edit_courses.php"> edit-courses </a></h1>

<h1><a href = "logout.php">Logout </a></h1>
</div>



<div class = "overall">


<form action = "" method = "POST">

<h1 class = "header">EDIT COURSE</h1>


<fieldset class = "fieldset">

<div class = "error_1">
<?php
if(isset($error['course-name'])){
    echo ($error['course-name']);
}
?>
</div>
   
<p class = "paragraph">COURSE CODE: <input type = "text" name = "course-name" placeholder = "Enter your course name" value = "<?= $record['course_name'] ?>" /></p>

<div class = "error_1">
<?php
if(isset($error['dept-id'])){
    echo ($error['dept-id']);
}
?>
</div>

<p class = "paragraph">DEPARTMENT ID: <input type = "text" name = "dept-id" placeholder = "###" value = "<?= $record['department_id'] ?>" /></p>

<div class = "error_1">
<?php
if(isset($error['teacher-id'])){
    echo ($error['teacher-id']);
}
?>
</div>

<p class = "paragraph">TEACHER ID: <input type = "text" name = "teacher-id" placeholder = "###" value = "<?= $record['teacher_id'] ?>" /></p>



<input type = "submit" name = "submit" value = "UPDATE"/>

</fieldset>

</form>


</div>

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>

<script type = "text/javascript" src="../script/main.js"></script>
</body>

</html>