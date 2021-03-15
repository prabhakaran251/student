<?php
require_once "config.php";
//initializing Debugging Mode
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Initialize the session
session_start();
 ?>
 <?
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}  
$course=$branch=$syear="";
    // Define variables and initialize with empty values
$course_err=$branch_err=$syear_err=""; 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
     // Check if Course is empty
     if(empty(trim($_POST["course"]))){
         $course_err = "Please Select Course.";
     } else{
         $course = trim($_POST["course"]);
     }
     // Check if Branch is empty
     if(empty(trim($_POST["branch"]))){
         $branch_err = "Please Select Branch.";
     } else{
         $branch = trim($_POST["branch"]);
     } 
     // Check if Student Year is empty
     if(empty(trim($_POST["syear"]))){
         $syear_err = "Please Select Year.";
     } else{
         $syear = trim($_POST["syear"]);
     }
    }
?>
<!DOCTYPE html>
<meta charset="UTF-8">
<html lang="en">
<head>
    <title>Add Students</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link href='sweetalert.css' type='text/css' rel='stylesheet'>
    <scrip src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <scrip src='sweetalert/sweetalert.min.js' type='text/javascript'></scrip>
    <style type="text/css">
        body{ font: 14px sans-serif;background-color:lightblue }
        .wrapper{ width: 350px; padding: 10px;text-align:left;}
        .help-block{color:red}
    </style>
</script> 
</head>  
<body>
    <div>
        <?php include_once("Navigation.php")  ?>
        <div class="page-header"  align="center">
        <img src="assets/img/student-graduate.jpg" alt="Anna University" width="auto" width="auto">
        <h2>ADD STUDENTS</h2>
        <div class="wrapper">
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="contact-form">
            <div class="form-group">
                <label>Select Course</label>
                <select name="course" id="course" class="form-control">
                         <option value="0">Please Select </option>
                         <option value="1">Bachelor of Engineering(BE)</option>
                         <option value="2">Bachelor of Technology(B.Tech)</option>
                </select>
                <span class="help-block"><?php echo $course_err; ?></span>
            </div>
            <div class="form-group">
                <label>Select Branch</label>
                <select name="branch" id="branch" class="form-control">
                         <option value="0">Please Select </option>
                         <option value="1">Computer Science Engineering(CSE)</option>
                         <option value="2">Information Technology(IT)</option>
                         <option value="3">Mechanical Engineering(ME)</option>
                         <option value="4">Electrical and Electronics Engineering(EEE)</option>
                         <option value="5">Electronics and Communications Engineering (ECE)</option>
                         <option value="6">Civil Engineering(CE)</option>
                </select>
                <span class="help-block"><?php echo $branch_err; ?></span>
            </div>
            <div class="form-group">
                <label>Select Year</label>
                <select name="syear" id="syear" class="form-control">
                         <option value="0">Please Select </option>
                         <option value="1">First Year</option>
                         <option value="2">Second Year</option>
                         <option value="3">Third Year</option>
                         <option value="4">Fourth Year</option>
                </select>
                <span class="help-block"><?php echo $syear_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Save & Next"><a class="btn" style="background-color:red;" href="newstudentadd.php">Cancel</a>
            </div>
        </form>
    </div>
</div>
</body>
    <div>
         <?php include_once("Footer.php") ?>
    </div>
    </html> 
    <?php 
     // Check input errors before inserting in database
     if((!empty($course)) && (!empty($branch)) && (!empty($syear))){
         // Prepare an insert statement
         $sql = "INSERT INTO students (course,branch,syear) VALUES (:course,:branch,:syear)";
         //var_dump($sql);
         if($stmt = $pdo->prepare($sql)) {
             $stmt->bindParam(":course", $course, PDO::PARAM_STR);
             $stmt->bindParam(":branch", $branch , PDO::PARAM_STR);
             $stmt->bindParam(":syear", $syear , PDO::PARAM_STR);
             var_dump($course."".$branch."".$syear);
             $result=$stmt->execute();
                if($result){ 
                   echo "<script type='text/javascript'>
                   location.href = 'addstudents.php';
                   </script>";
             } else {
                    header("location:addstudents.php");
                    echo "<script type='text/javascript'>
                    location.href = 'newstudentaddrule.php';
                    </script>";
                }
                unset($stmt);
         }
    unset($pdo);
}
?>