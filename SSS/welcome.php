<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="en">
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div>
        <?php include_once("Navigation.php")  ?>
    </div> 
    <div class="page-header"><br>
    <img src="assets/img/annauniv.png" alt="Anna University" width="150px" height="150px"> <h1>STUDENT STATIONERY STORE</h1>
    </div>
    <h3>welcome  <b><?php echo htmlspecialchars($_SESSION["username"]);?></b></h3>
  <p>This web page is created for student’s easily to purchase the product. In before day’s students are wait in the stationary store for long time to purchase the product. Using the webpage student’s purchase the product in short time period.</p>
  
    <p>
       <!-- <a href="reset-password.php" class="btn">Reset Your Password</a> -->
        <a href="logout.php" class="btn small">Sign Out of Your Account</a>
    </p><br/>
    <div>
    <?php include_once("Footer.php") ?>
    </div>
</body>
</html> 
