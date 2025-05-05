<?php
session_start();
require_once "conn.php";

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<style>
    body {
  margin: 0;
  padding: 0;
  background-image: url("img/bug-tracking-1.png");
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
.container 
{
    height:70vh;
     background-repeat: no-repeat;
     background-image: url("img/3zMw.gif");
}

</style>
<body>
    <div id="login" class="mx-auto mt-5 pt-4">
      
        <div class="container mx-auto">
            <div id="login-row" class="row justify-content-center align-items-center">
                    <div class="form-group col-md-6">
                        <a href="admin/login"><button type="button" class="btn btn-light btn-lg">Admin Login</button></a>
                        <a href="employee_login"><button type="button" class="btn btn-light btn-lg">Employee Login</button></a>
                    </div>
            </div>
        </div>
    </div>
</body>
