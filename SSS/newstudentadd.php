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
$regno=$sname=$dob=$course=$branch=$syear=$phno=$email=$password=$stu_address="";
    // Define variables and initialize with empty values
$regno_err = $sname_err = $dob_err=$course_err=$branch_err=$syear_err=$phno_err=$email_err=$password_err=$address_err=""; 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
     // Check if Student Name is empty
     if(empty(trim($_POST["sname"]))){
         $sname_err = "Please Enter Student Name.";
     } else{
         $sname = trim($_POST["sname"]);
     }
     // Check if Date Of Birth is empty
     if(empty(trim($_POST["dob"]))){
         $dob_err = "Please Enter Date Of Birth.";
     } else{
         $dob = trim($_POST["dob"]);
     }
         // Check if Register No is empty
         if(empty(trim($_POST["regno"]))){
               $regno_err = "Please Enter Register Number.";
             } else{
                   // Prepare a select statement
                   $sql = "SELECT id FROM students WHERE regno = :regno";
                     
                    if($stmt = $pdo->prepare($sql)){
                          // Bind variables to the prepared statement as parameters
                         $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
                         
                         // Set parameters
                        $regno = trim($_POST["regno"]);
                         
                          // Attempt to execute the prepared statement
                          if($stmt->execute()){
                                 if($stmt->rowCount() == 1){
                                       $regno_err = "This username is already taken.";
                                      
                                 } else{
                                        $regno = trim($_POST["regno"]);
                                }
                         } else{
                           echo "Oops! Something went wrong. Please try again later.";
                          }
             
                        // Close statement
                unset($stmt);
            }
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
        </div>
        <div class="page-header"  align="center">
        <img src="assets/img/student-graduate.jpg" alt="Anna University" width="auto" width="auto">
        <h2>ADD STUDENTS</h2>
        <div class="wrapper">
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="contact-form">
            <div class="form-group">
                <label>Enter Register Number<?php echo $_SESSION["id"]?></label>
                <input type="text" name="regno" autocomplete="off" class="form-control" autofocus>
                <span class="help-block"><?php echo $regno_err;?></span>
            </div>    
            <div class="form-group">
                <label>Enter Student Name</label>
                <input type="text" name="sname" class="form-control">
                <span class="help-block"><?php echo $sname_err; ?></span>
            </div>
            <div class="form-group">
                <label>Enter  Date Of Birth</label>
                <input type="date" name="dob" class="form-control">
                <span class="help-block"><?php echo $dob_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Save & Next"><a class="btn" style="background-color:red;" href="welcome.php">Cancel</a>
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
     if((!empty($regno)) && (!empty($sname)) && (!empty($dob))){
         // Prepare an insert statement
         $sql = "INSERT INTO students (regno,sname,dob) VALUES (:regno,:sname,:dob)";
         //var_dump($sql);
         if($stmt = $pdo->prepare($sql)) {
             $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
             $stmt->bindParam(":sname", $sname, PDO::PARAM_STR);
             $stmt->bindParam(":dob", $dob , PDO::PARAM_STR);
             $result=$stmt->execute();
             $last_id = number_format($pdo->lastInsertId());
             $last=(int)$last_id;
             var_dump($regno ."".$sname."".$dob,"".$last);
             $sampl="newstudentaddrule.php/".$last."";
             echo $sampl;
                if($result){  
                   // header("location: newstudentaddrule.php/$last"); 
                   echo "<script type='text/javascript'>
                    location.href = '".$sampl."';
                     </script>";
             } else {
                echo "<script type='text/javascript'>
                location.href = '".$sampl."';
                </script>";
             }
         }
         unset($stmt);
     }
 unset($pdo);
     ?>