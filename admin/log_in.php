<?php
session_start();
include("../include/db.php");

if(array_key_exists('submit',$_POST)){
    $error = array();
if(empty($_POST['email'])){
    $error['email'] = "Email is empty";
}elseif((!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$_POST['email'])) ){
    $error['email'] = "invalid email address";
}

if(empty($_POST['hash'])){
    $error['hash'] = "password field is empty";
}

if(empty($error)){
    $stmt = $conn->prepare("SELECT * FROM admin WHERE admin_email=:aem");
    $stmt->bindParam(":aem",$_POST['email']);
    $stmt->execute();
$row = $stmt->fetch(PDO::FETCH_BOTH);
if($stmt->rowCount() > 0 && password_verify($_POST['hash'], $row['hash'])){
     $_SESSION['admin_id'] = $row['admin_id'];
     $_SESSION['admin_name'] = $row['admin_name'];
header("location:homepage.php");
exit();
}else{
    header("Location:login.php?error= Either Email or Password Incorrect");
}

}

}

?>
<!Doctype Html>
<head>
    <meta charset = "UTF-8">
          <meta name = "viewport" content="width=device-width,initial-scale=1.0">
               <meta http-equiv = "X-UA-compatible" content = "ie=edge">  
               <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
               <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
               <link rel = "stylesheet" type ="text/css" href = "../css/log.css">
	                 <title>welcome to Admin Login</title>
</head>
<body>
    
<nav>
<h1 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h1>
<p class = "nav-header1">motto: Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">
<h1> <a href = "signup.php"> Admin </a>/ Login </h1>
</div>


<div class = "message">

<?php
if(isset($_GET['message'])){
    echo($_GET['message']);
}
?>

</div>

<div class = "message">

<?php
if(isset($_GET['error'])){
    echo($_GET['error']);
}

?>

</div>

<div class = "overall">

<form action = "" method = "POST">

<h1 class = "header">ADMIN LOGIN</h1>

<fieldset class = "fieldset">


<div class = "error_1">

<?php
if(isset($error['email'])){
    echo ($error['email']);
}
?>
</div>
    
<div class = "form-container">

<p class = "paragraph">Email: </p> 

<input type = "email" name = "email" placeholder = "Enter your Email" />

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

<button type = "submit" name = "submit">LOGIN </button>

</fieldset>

<p class = "paragraph1"> Don't have an account? click to <a class = "link" href = "signup.php">Register </a> </p>

</form>

</div>

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>

<script>
function togglePassword() {
    var passwordField = document.getElementById("password");
    var eyeIcon = document.getElementById("eyeIcon");

    if (passwordField.type === "password") {
        passwordField.type = "text";
        eyeIcon.src = "../image/eye-slash-icon.png";
    } else {
        passwordField.type = "password";
        eyeIcon.src = "../image/eye-icon.png";
    }
}

</script>

<script type = "text/javascript" src="../script/main.js"></script>
</body>
</html>