<?php
session_start();
require_once "conn.php";
if(isset($_SESSION['employee_id'])) //if admin is already logged in then go to Dashboard directly
{
    echo '<script>window.location.href = "dashboard";</script>';
}
if(isset($_POST['submit']))//if login form is submitted
{
   // print_r($_POST);exit;
    extract($_POST);
    $stmt_login = $conn->prepare("SELECT * FROM employee WHERE employee_email=:employee_email and employee_password=:employee_password");
    $stmt_login->execute(array(':employee_email'=>$employee_email,':employee_password'=>$employee_password));
    $row_login = $stmt_login->fetchAll(PDO::FETCH_ASSOC);
     if($row_login)
     {
           $_SESSION["employee_id"]=$row_login[0]['employee_id'];
		   echo "<script>window.location.href='dashboard';</script>";
     }
	 else
	 {
		 echo "<script>alert('Please enter correct Username and Password!!!')</script>" ;
	 }
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
  margin: 0;
  padding: 0;
   background-image: url("img/istock-1061323160-scaled-1200x800.jpg");
  height: 100vh;
   background-repeat: no-repeat;
    background-size: cover;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
 
  
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}
#login .container #login-row #login-column #login-box #login-form #register-link {
  margin-top: -85px;
}
</style>
<body>
    <div id="login">
        <!--<h3 class="text-center text-white pt-5">Login form</h3>-->
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6  ">
                    <div id="login-box" class="col-md-12 bg-light">
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="text" name="employee_email" id="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="employee_password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                               
                                <input type="submit" name="submit" class="btn btn-info btn-md" value="submit">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
