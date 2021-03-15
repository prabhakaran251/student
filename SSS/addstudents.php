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
     // Check if Phone Number is empty
     if(empty(trim($_POST["phno"]))){
         $phno_err = "Please Enter Phone Number.";
     } else{
         $phno = trim($_POST["phno"]);
     }  
      // Check if Email is empty
      if(empty(trim($_POST["email"]))){
         $email_err = "Please Enter Email.";
     } else{
         $email = trim($_POST["email"]);
     }  /*
      // Check if address is empty
      if(empty(trim($_POST["stu_address"]))){
        $address_err = "Please Enter Address.";
    } else{
        $stu_address = trim($_POST["stu_address"]);
    }  */
        // Check if Password is empty
     if(empty(trim($_POST["password"]))){
         $password_err = "Please Enter Password.";
     } else{
         $password = trim($_POST["password"]);
         $password .= password_hash($password, PASSWORD_DEFAULT); 
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
        <div class="page-header"  align="center">
        <img src="assets/img/student-graduate.jpg" alt="Anna University" width="auto" width="auto">
        <h2>ADD STUDENTS</h2>
        <div class="wrapper">
            <form action="<?php echo ($_SERVER["PHP_SELF"]); ?>" method="post" id="contact-form">
            <div class="form-group">
                <label>Enter Register Number</label>
                <input type="text" name="regno" autocomplete="off" class="form-control" autofocus>
                <span class="help-block"><?php echo $regno_err; ?></span>
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
                <label>Enter Phone Number :</label>
                <input type="number" name="phno" class="form-control">
                <span class="help-block"><?php echo $phno_err; ?></span>
            </div>
          <!--   <div class="form-group">
                <label>Enter Address :</label>
              <textarea  name="address" class="form-control"></textarea>   
              <textarea  name="stu_address" class="form-control"></textarea> 
              <input type="text" name="stu_address"class="form-control">
              <span class="help-block"><?php echo $address_err; ?></span>  
            </div>   -->
            <div class="form-group">
                <label>Enter Email ID</label>
                <input type="email" name="email" class="form-control">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Enter Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" style="background-color:green;" class="btn" value="Submit"><a class="btn" style="background-color:red;" href="welcome.php">Cancel</a>
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
     if((!empty($regno)) && (!empty($password)) && (!empty($email))){
         // Prepare an insert statement
         $sql = "INSERT INTO students (regno,sname,dob,course,branch,syear,phno,email,password) VALUES (:regno,:sname,:dob,:course,:branch,:syear,:phno,:email,:password)";
         //var_dump($sql);
         if($stmt = $pdo->prepare($sql)) {
             $stmt->bindParam(":regno", $regno, PDO::PARAM_STR);
             $stmt->bindParam(":sname", $sname, PDO::PARAM_STR);
             $stmt->bindParam(":dob", $dob , PDO::PARAM_STR);
             $stmt->bindParam(":course", $course);
             $stmt->bindParam(":branch", $branch , PDO::PARAM_STR);
             $stmt->bindParam(":syear", $syear , PDO::PARAM_STR);
             $stmt->bindParam(":phno", $phno, PDO::PARAM_STR);
             //$stmt->bindParam(":stu_address", $stu_address, PDO::PARAM_STR);
             $stmt->bindParam(":email", $email, PDO::PARAM_STR);
             $stmt->bindParam("password",$password, PDO::PARAM_STR);
             var_dump($regno ."".$sname."".$dob."".$course."".$branch."".$syear."".$phno."".$email."".$password);
             $result=$stmt->execute();
                if($result){
                 echo "
                 <script>
                 swal({ 
                    title: 'Title', 
                    text: 'Submitted Sucessfully', 
                    type: 'success'
                });
                </script>    
                ";           
             } else {
                echo "
                <script>
                swal({ 
                   title: 'Title', 
                   text: 'Your message', 
                   type: 'error'
               });
               </script>
               "; 

             }
             }
             unset($stmt);
         }
         unset($pdo);

     ?>