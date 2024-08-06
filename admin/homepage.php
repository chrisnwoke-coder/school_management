<?php
session_start();
include('../include/db.php');
include('../include/admin_auth.php');

?>

<!doctype Html>
<head>
<meta charset = "UTF-8">
<meta name = "viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv = "X-UA-compatible" content = "ie=edge">
<link rel = "stylesheet" type = "text/css" href = "../css/homepage.css" />
<title> welcome to Homepage </title>
</head>

<body>

<nav>
<h1 style = 'font-size:17px; color:white;'> Admin id:<?= $_SESSION['admin_id'] ?> </h1>
<h2 style = 'font-size:17px; color:white;'> Admin Name:<?= $_SESSION['admin_name'] ?> </h2>

<h3 class = "nav-header"> WELCOME TO EKITI STATE UNIVERSITY </h3>
<p class = "nav-header1">motto:Character,Learning and Excellence</p>
</nav>

<div class = "breadcrumb">
<h1> Admin / dashboard </h1>
<h1><a href = "logout.php">Logout </a></h1>
</div>



<div class = "overall">


<div class = "content">

<a href = "create_teacher.php"> 

<div class = "first-content">

<div class = "image-box"></div>

<p> CREATE TEACHER </p>

</div>

</a>

</div>

<!--end of first content-->

<div class = "content">

<a href = "create_student.php"> 

<div class = "first-content">

<div class = "image-box-1"></div>

   <p> CREATE STUDENT </p>

</div>

</a>

</div>

<!--end of second content-->

<div class = "content">

<a href = "create_department.php"> 

<div class = "first-content">

  <div class = "image-box-2"></div>

   <p> ADD DEPARTMENT </p>
</div>

</a>

</div>
<!--end of third content-->

<div class = "content">

<a href = "add_courses.php"> 

<div class = "first-content">

   <div class = "image-box-3"></div>

   <p> ADD COURSES </p>

</div>

</a>

</div>

<!--end of fourth content-->

<div class = "content">

<a href = "edit_teacher.php"> 

<div class = "first-content">

   <div class = "image-box-4"></div>

   <p> EDIT TEACHER </p>

</div>

</a>

</div>

<!--end of fifth content-->

<div class = "content">

<a href = "edit_student.php"> 

<div class = "first-content">

   <div class = "image-box-5"></div>

   <p> EDIT STUDENT </p>

</div>

</a>

</div>

<!--end of sixth content-->

<div class = "content">

<a href = "edit_department.php"> 

<div class = "first-content">

<div class = "image-box-6"></div>

    <p> EDIT DEPARTMENT </p>

</div>

</a>

</div>

<!--end of seventh content-->

<div class = "content">

<a href = "edit_courses.php"> 

<div class = "first-content">

<div class = "image-box-7"></div>

   <p> EDIT COURSES </p>

</div>

</a>

</div>
<!--end of eighth content-->


<div class = "content">

<a href = "add_result.php"> 

<div class = "first-content">

   <div class = "image-box-8"></div>

   <p> ADD RESULT </p>

</div>

</a>

</div>
<!--end of nineth content-->

<div class = "content">

<a href = "edit_result.php"> 

<div class = "first-content">

<div class = "image-box-9"></div>

   <p> EDIT RESULT </p>

</div>

</a>

</div>
<!--end of tenth content-->


</div>

<div class = "ampersand">
  <p> &copycopyright 2023, Ekiti State University. ALL right reserved</p>
</div>


</body>
</html>