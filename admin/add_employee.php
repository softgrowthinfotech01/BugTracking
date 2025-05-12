<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_POST['submit']))
{

  extract($_POST);
  $stmt = $conn->prepare("INSERT INTO employee(employee_type, employee_name, employee_email, employee_password, employee_img ) VALUES (:employee_type, :employee_name, :employee_email, :employee_password, :employee_img )");
   $executed=$stmt->execute(array(':employee_type' => $employee_type, ':employee_name' => $employee_name, ':employee_email' => $employee_email, ':employee_password' => $employee_password, ':employee_img' => $employee_img));
   if($executed){
       echo '<script>alert("Employee added successfully.");window.location.href = "add_employee";</script>';

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

    <title>Add Employee</title>
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
          <h3>Add Employee</h3>
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
                        <option value="Tester">Tester</option>
                        <option value="Developer">Developer</option>
                        <option value="Manager">Manager</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Employee Name</label>
                    <input type="text" class="form-control" name="employee_name" >
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Employee Email(username)</label>
                    <input type="text" class="form-control" name="employee_email" >
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Password</label>
                    <input type="password" class="form-control" name="employee_password" >
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
    
    <section class="container pt-5 mt-3">
      <div class="row mt-5">
        <div class="col-12">
          <h4>Employee List</h4>
          <hr>
        </div>
        <div class="col-sm-12">
          <!--<div class="col-3 mr-auto">
            <div class="form-group">
              <label>Search</label>
              <input type="text" class="" name="">
            </div>
          </div>-->
          <div class="table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Employee Name</th>
                  <th>Type</th>
                  <th>Email</th>
                  <th>Password</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt_employee = $conn->prepare("SELECT * FROM employee ORDER BY employee_id DESC");
                $stmt_employee->execute();
                $row_employee = $stmt_employee->fetchAll(PDO::FETCH_ASSOC);
                //print_r($row_customer_total);exit;
                for($i=0;$i<count($row_employee);$i++)
                {
                ?>
                <tr>
                  <td><?php echo $i+1;?></td>
                  <td><?php echo $row_employee[$i]['employee_name'];?></td>
                  <td><?php echo $row_employee[$i]['employee_type'];?></td>
                  <td><?php echo $row_employee[$i]['employee_email'];?></td>
                  <td><?php echo $row_employee[$i]['employee_password'];?></td>
                  <td>
                    <a href="update_employee?id=<?php echo $row_employee[$i]['employee_id'];?>" class="btn btn-info btn-sm">Update</a>
                  </td>
                </tr>
                <?php
                
                }
                ?>
              </tbody>
              
            </table>
          </div>
        </div>
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