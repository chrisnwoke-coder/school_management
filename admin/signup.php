<?php
include("../include/db.php");

if(array_key_exists('submit',$_POST)){
    $error = array();

if(empty($_POST['full_name'])){
    $error['full_name'] = "Enter your full name";
}elseif (!preg_match("/^[a-zA-Z ]*$/",$_POST['full_name'])) {
  $error['full_name'] = "Only letters and white space allowed";
} 
if(empty($_POST['email'])){
    $error['email'] = "Email cannot be empty";
}else{
    $stmt = $conn->prepare("SELECT * FROM ADMIN WHERE admin_email=:em");
    $stmt->bindParam(":em",$_POST['email']);
    $stmt->execute();
if($stmt->rowCount() > 0){
    $error['email'] = "Email already exist";
}
}
if(empty($_POST['hash'])){
    $error['hash'] = "Password cannot be empty";
}
if(empty($_POST['confirm_password'])){
    $error['confirm_password'] = "Confirm password cannot be empty";
}else if($_POST['confirm_password']!== $_POST['hash']){
    $error['confirm_password'] = "Password mismatch";
}

if(empty($error)){
    $hash = password_hash($_POST['hash'], PASSWORD_BCRYPT);

    $statement = $conn->prepare("INSERT INTO admin VALUES(NULL,:an,:ae,:ah,NOW(),NOW() )" );
    $statement->bindParam(":an",$_POST['full_name']);
    $statement->bindParam(":ae",$_POST['email']);
    $statement->bindParam(":ah",$hash);
    $statement->execute();
header("Location:login.php?message=Congratulations ".$_POST['full_name']. " you have successfully registered and a confirmation mail has been sent to your ".$_POST['email']." you can now login");
}

} 

?>


<!Doctype Html>
<head>
    <meta charset = "UTF-8">
          <meta name = "viewport" content="width=device-width, initial-scale=1.0">
               <meta http-equiv = "X-UA-compatible" content = "ie=edge">  
               <link rel = "stylesheet" type = "text/css" href = "../css/sign.css" />
	                 <title>welcome to Admin Signup</title>
</head>
<body>

<nav>
<h1 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h1>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">
<h1> Admin /<a href = "login.php"> Login </a> </h1>
</div>

<h1 style = 'color:blue;'>
<?php

if(isset($_GET['message'])){
    echo($_GET['message']);
}

?>
</h1>

<div class = "overall">

<div class = "first-content">

<img src ="../image/admin1.jpg" alt ="admin" />

</div>

<div class = "first-content">

<form action = "" method = "POST">

<h1 class = "header">ADMIN REGISTRATION</h1>

   <fieldset class = "fieldset">


<div class = "error_1">
<?php
if(isset($error['full_name'])){
    echo ($error['full_name']);
}
?>
</div>

<div class = "form-container">

<p class = "paragraph">Full Name: </p> 

<input type = "text" name = "full_name" placeholder = "Enter Your full name" />

</div>

<div class = "error_1">
<?php
if(isset($error['email'])){
    echo ($error['email']);
}
?>
</div>

<div class = "form-container">

<p class = "paragraph">Email: </p> 

<input type = "email" name = "email" placeholder = "example@gmail.com"/>

</div>


<div class = "error_1">
<?php
if(isset($error['hash'])){
    echo ($error['hash']);
}
?>
</div>


<div class="container">

        <p class = "paragraph">Password: </p>

        <div class="password-container">

            <input type="password" name = "hash" id="password" placeholder="Enter your password">

            <span class="toggle-password" onclick="togglePassword()">

                <img src="../image/eye-icon.png" alt="Show Password" id="eyeIcon">

            </span>

        </div>
    </div>



<div class = "error_1">
<?php
if(isset($error['confirm_password'])){
    echo ($error['confirm_password']);
}
?>
</div>


<div class = "form-container">

<p class = "paragraph">Conf-Password: </p> 

<input type = "password" name = "confirm_password" placeholder = "Confirm your Password"/>

</div>


<input type = "submit" name = "submit" value = "REGISTER" />

<p class = "paragraph1"> already have an account? click to <a class = "link" href = "login.php">Login </a> </p>


</fieldset>  

</form>

</div>


</div>



<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>

<script type = "text/javascript">
    function togglePassword(){
        var passwordField = document.getElementById("password");
        var eyeIcon = document.getElementById("eyeIcon");
        if(passwordField.type === "password"){
            passwordField.type = "text";
            eyeIcon.src = "../image/eye-slash-icon.png";
        }else{
            passwordField.type = "password";
            eyeIcon.src = "../image/eye-icon.png";
        }
    }
</script>
<script type = "text/javascript" src="../script/main.js"></script>
</body>
</html>