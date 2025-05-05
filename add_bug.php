<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_POST['submit']))
{
  extract($_POST);
  $stmt = $conn->prepare("INSERT INTO bug(project_id, bug_name, bug_description, tester_employee_id,bug_status) VALUES (:project_id, :bug_name, :bug_description, :tester_employee_id,:bug_status)");
   $executed=$stmt->execute(array(':project_id' => $project_id, ':bug_name' => $bug_name, ':bug_description' => $bug_description, ':tester_employee_id' => $_SESSION['employee_id'], ':bug_status' => "new"));
   if($executed){
       echo '<script>alert("Bug added successfully.");window.location.href = "add_bug";</script>';

   }      
   else{
       echo '<script>alert("There is some error. Please try again");window.location.href = "add_bug";</script>';

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

    <title>Add Bug</title>
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
          <h3>Add Bug</h3>
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
                      <label class="control-label">Project</label>
                      <select class="form-control" name="project_id">
                        <option value="">--Select--</option>
                        <?php
                            $stmt_project = $conn->prepare("SELECT * FROM project ORDER BY project_id DESC");
                            $stmt_project->execute();
                            $row_project = $stmt_project->fetchAll(PDO::FETCH_ASSOC);
                            for($i=0;$i<count($row_project);$i++)
                            {
                                ?>
                                <option value="<?php echo $row_project[$i]['project_id'];?>"><?php echo $row_project[$i]['project_name'];?></option>
                                <?php
                            }
                            ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Bug Name</label>
                    <input type="text" class="form-control" name="bug_name" >
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Bug Description</label>
                    <textarea class="form-control" name="bug_description"  ></textarea>
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
          <h4>Bug List</h4>
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
                  <th>Project Name</th>
                  <th>Bug Name</th>
                  <th>Bug Description</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt_bug = $conn->prepare("SELECT * FROM bug WHERE tester_employee_id=".$_SESSION['employee_id']." ORDER BY bug_id DESC");
                $stmt_bug->execute();
                $row_bug = $stmt_bug->fetchAll(PDO::FETCH_ASSOC);
                //print_r($row_customer_total);exit;
                for($i=0;$i<count($row_bug);$i++)
                {
                    //get project name
                    $stmt_proj = $conn->prepare("SELECT * FROM project WHERE project_id=".$row_bug[$i]['project_id']);
                    $stmt_proj->execute();
                    $row_proj = $stmt_proj->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <tr>
                  <td><?php echo $i+1;?></td>
                  <td><?php echo $row_proj[0]['project_name'];?></td>
                  <td><?php echo $row_bug[$i]['bug_name'];?></td>
                  <td><?php echo $row_bug[$i]['bug_description'];?></td>
                  <td><?php echo $row_bug[$i]['bug_status'];?></td>
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