<?php
session_start();
include("../include/db.php");

if(array_key_exists('submit',$_POST)){
    $error = array();
if(empty($_POST['regnumber'])){
    $error['regnumber'] = "Reg number is Empty";
}else{
    if(!is_numeric($_POST['regnumber'])){
        $error['regnumber'] = "only numeric value is required";
    }
}
if(empty($error)){
    $stmt = $conn->prepare("SELECT * FROM student WHERE std_reg_number=:srn");
    $stmt->bindParam(":srn",$_POST['regnumber']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_BOTH);
    $_SESSION['student_id'] = $row['student_id'];
    $_SESSION['student_name'] = $row['student_name'];
    header("Location:home_student.php?success=You're Logged in Successfully");
    exit();
}else{
    header("Location:user_student.php?error=Incorrect Reg Number");
    exit();
}
}


}
?>

<!doctype Html>
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv = "X-UA-compatible" content = "ie=edge">
<link rel = "stylesheet" type = "text/css" href = "../css/student.css" />
<title> Student Login </title>
</head>

<body>

<nav>
<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">

<h1> User / student-Login</h1>

</div>

<div class = "overall">

<form action = "" method = "POST">

<h2 style="font-size: 15px; color: red; font-family:times new roman; text-align: center;">

<?php
if(isset($_GET['message'])){
    echo($_GET['message']);
}

?>

</h2>

<h1 class = "header">STUDENT LOGIN</h1>

<h2 style="font-size: 15px; color: red; font-family:times new roman; text-align: center;">

<?php
if(isset($_GET['error'])){
    echo($_GET['error']);
}

?>


</h2>



<fieldset class = "fieldset">

<?php
if(isset($error['regnumber'])){
    echo "<p style = 'color:red; font-size:15px; margin-top:20px; margin-left:300px;'>".$error['regnumber']."</p>";
}

?>

<p class = "paragraph">STUDENT REG NUM: <input type = "text" name = "regnumber" placeholder = "Enter your reg number" /></p>

<input type = "submit" name = "submit" value = "LOGIN"/>

</fieldset>

<p style = 'color:#262F5A; margin-left:30px; margin-top: 20px; font-size:15px;'> Don't have a Reg Number? please contact your Admin for Registration.</p>

</form>



</div>

</body>

</html>