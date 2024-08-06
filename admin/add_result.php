<?php
session_start();
include("../include/db.php");
include("../include/admin_auth.php");


if(isset($_POST['submit'])){
   $error = array();
if(empty($_POST['student-score'])){
    $error['student-score'] = "Student score cannot be empty";
}else if(!is_numeric($_POST['student-score'])){
    $error['student-score'] = "Only numeric value is required";
}

if(empty($_POST['course-code'])){
    $error['course-code'] = "course ID cannot be empty";
}else if(!is_numeric($_POST['course-code'])){
     $error['course-code'] = "only numeric value is required";    
}
if(empty($_POST['student-info'])){
    $error['student-info'] = "student ID cannot be empty";
}else if(!is_numeric($_POST['student-info'])){
     $error['student-info'] = "only numeric value is required";    

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

    $statement = $conn->prepare("INSERT INTO result VALUES(NULL,:sc,:gd,:ci,:si,:cb,NOW(),NOW() )");
    $statement->bindParam(":sc",$_POST['student-score']);
    $statement->bindParam(":gd",$grade);
    $statement->bindParam(":ci",$_POST['course-code']);
    $statement->bindParam(":si",$_POST['student-info']);
    $statement->bindParam(":cb",$_SESSION['admin_id']);
    $statement->execute();
header("Location:add_result.php?message=Result Successfully Added");
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
<title> Add Result </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> Admin /<a href = "homepage.php"> dashboard </a> / add-result</h1>

<h1><a href = "logout.php">Logout </a></h1>
</div>


<div class = "overall">


<form action = "" method = "POST">

<h1 class = "header">ADD RESULT</h1>

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
if(isset($error['student-score'])){
    echo ($error['student-score']);
}
?>
</div>
   
<p class = "paragraph">STUD SCORE: <input type = "text" name = "student-score" placeholder = "Enter student score" /></p>

<div class = "error_1">
<?php
if(isset($error['course-code'])){
    echo ($error['course-code']);
}
?>
</div>
   
<p class = "paragraph">COURSE ID: <input type = "text" name = "course-code" placeholder = "Enter course id" /></p>


<div class = "error_1">
<?php
if(isset($error['student-info'])){
    echo ($error['student-info']);
}
?>
</div>

<p class = "paragraph">STUDENT ID: <input type = "text" name = "student-info" placeholder = "Enter student id" /></p>


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
