<?php
session_start();
require_once "conn.php";
if(isset($_SESSION['admin_username'])) //if admin is already logged in then go to Dashboard directly
{
    echo '<script>window.location.href = "dashboard";</script>';
}
if(isset($_POST['submit']))//if login form is submitted
{
    extract($_POST);
    $stmt_login = $conn->prepare("SELECT * FROM admin_details WHERE admin_login=:admin_login and admin_password=:admin_password");
    $stmt_login->execute(array(':admin_login'=>$admin_login,':admin_password'=>$admin_password));
    $row_login = $stmt_login->fetchAll(PDO::FETCH_ASSOC);
     if($row_login)
     {
           $_SESSION["admin_username"]=$_POST['admin_login'];
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
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
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
        <h3 class="text-center text-white pt-5">Select Login</h3>
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                    <div class="form-group">
                        <a href="login"><button type="button" class="btn btn-info btn-md">Admin</button></a>
                        <a href="employee_login"><button type="button" class="btn btn-info btn-md">Employee</button></a>
                    </div>
            </div>
        </div>
    </div>
</body>
