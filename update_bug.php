<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_GET['id']))
{
    $bug_id=$_GET['id'];
    $stmt_bug = $conn->prepare("SELECT * FROM bug WHERE bug_id=".$bug_id);
    $stmt_bug->execute();
    $row_bug = $stmt_bug->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_POST['submit']))
{
  extract($_POST);
  $stmt = $conn->prepare("UPDATE bug SET bug_solution_time=:bug_solution_time,bug_status=:bug_status WHERE bug_id=".$bug_id);
   $executed=$stmt->execute(array(':bug_solution_time' => $bug_solution_time, ':bug_status' => $bug_status));
   if($executed){
       echo '<script>alert("Bug updated successfully.");window.location.href = "assigned_bugs";</script>';

   }      
   else{
       echo '<script>alert("There is some error. Please try again");window.location.href = "assigned_bugs";</script>';

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

    <title>Update Bug</title>
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
          <h3>Update Bug</h3>
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
                      <label class="control-label">Project: 
                    <?php
                    $stmt_proj = $conn->prepare("SELECT * FROM project WHERE project_id=".$row_bug[0]['project_id']);
                    $stmt_proj->execute();
                    $row_proj = $stmt_proj->fetchAll(PDO::FETCH_ASSOC);
                    echo $row_proj[0]['project_name'];
                    ?>
                    </label>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Bug Name: <?php echo $row_bug[0]['bug_name'];?></label>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Bug Description: <?php echo $row_bug[0]['bug_description'];?></label>
                    
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-row">
                    <div class="col">
                      <label class="control-label">Change Status</label>
                      <select class="form-control" name="bug_status">
                        <option value="">--Select--</option>
                        <option value="Active">Active</option>
                        <option value="Closed">Closed</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Time taken to resolve the bug.</label>
                    <input type="text" class="form-control" name="bug_solution_time" >
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