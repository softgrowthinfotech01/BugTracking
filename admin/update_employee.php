<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_GET['id']))
{
    $employee_id=$_GET['id'];
    $stmt_employee = $conn->prepare("SELECT * FROM employee WHERE employee_id=".$employee_id);
    $stmt_employee->execute();
    $row_employee = $stmt_employee->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_POST['submit']))
{
  extract($_POST);
  $stmt = $conn->prepare("UPDATE employee SET employee_type=:employee_type, employee_name=:employee_name, employee_email=:employee_email, employee_password=:employee_password WHERE employee_id=".$employee_id);
   $executed=$stmt->execute(array(':employee_type' => $employee_type, ':employee_name' => $employee_name, ':employee_email' => $employee_email, ':employee_password' => $employee_password));
   if($executed){
       echo '<script>alert("Employee updates successfully.");window.location.href = "add_employee";</script>';

   }      
   else{
       echo '<script>alert("There is some error. Please try again");window.location.href = "add_employee";</script>';

   }
}
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">

    <title>Update Employee</title>
    <style type="text/css">
      .navbar-brand{
        text-transform: uppercase;
      }
    </style>

  </head>
  <body>
         <?php require "nav.php"; ?>
  
    <section class="container pt-5 mt-3">
      <div class="row">
        <div class="col-md-12">
          <h3>Update Employee</h3>
          <hr>
        </div>
          <form method="post" action="">
      <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-row">
                <div class="col-md-10">
                  <div class="form-row">
                    <div class="col">
                      <label class="control-label">Employee Type</label>
                      <select class="form-control" name="employee_type">
                        <option value="Tester" <?php if($row_employee[0]['employee_type']=="Tester")echo "selected";?>>Tester</option>
                        <option value="Developer" <?php if($row_employee[0]['employee_type']=="Developer")echo "selected";?>>Developer</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Employee Name</label>
                    <input type="text" class="form-control" name="employee_name" value="<?php echo $row_employee[0]['employee_name'];?>" >
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Employee Email(username)</label>
                    <input type="text" class="form-control" name="employee_email" value="<?php echo $row_employee[0]['employee_email'];?>">
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="employee_password" value="<?php echo $row_employee[0]['employee_password'];?>" >
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-row mt-3">
                    <div class="col">
                      <button type="submit" name="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
          </form>
      </div>
    </section>

   <!-- <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <p class="w-100">Copyright &copy;2020. Designed By <a href="https://Softgrowthinfotech.com"> Softgrowth Infotech</a></p>
        </div>
      </div>
    </footer>-->

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
  </body>
</html>