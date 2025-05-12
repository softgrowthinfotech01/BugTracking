<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_POST['submit']))
{
  extract($_POST);
  $stmt = $conn->prepare("INSERT INTO project(project_name,project_manager) VALUES (:project_name, :project_manager)");
   $executed=$stmt->execute(array(':project_name' => $project_name, ':project_manager' => $project_manager));
   if($executed){
       echo '<script>alert("Project added successfully.");window.location.href = "add_project";</script>';

   }      
   else{
       echo '<script>alert("There is some error. Please try again");window.location.href = "add_project";</script>';

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

    <title>Add Project</title>
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
          <h3>Add Project</h3>
          <hr>
        </div>
          <form method="post" action="">
      <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-row">
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Project Name</label>
                    <input type="text" class="form-control" name="project_name" >
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Project Manager</label>
                    <!-- <input type="text" class="form-control" name="project_manager" > -->
                    <select name="project_manager" id="">
                      <option >--Select--</option>
                      <?php
                      $stmt= $conn->prepare("SELECT * FROM project");
                      $stmt->execute();
         $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
         for($j=0;$j<count($row);$j++){
                         ?>
                      <option value="<?php echo $row[$j]['project_manager']; ?>"><?php echo $row[$j]['project_manager']; ?></option>
                    <?php } ?>
                    </select>
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
          <h4>Project List</h4>
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
                  <th>Project Manager</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $stmt_project = $conn->prepare("SELECT * FROM project ORDER BY project_id DESC");
                $stmt_project->execute();
                $row_project = $stmt_project->fetchAll(PDO::FETCH_ASSOC);
                //print_r($row_customer_total);exit;
                for($i=0;$i<count($row_project);$i++)
                {
                ?>
                <tr>
                  <td><?php echo $i+1;?></td>
                  <td><?php echo $row_project[$i]['project_name'];?></td>
                  <td><?php echo $row_project[$i]['project_manager'];?></td>
                  
                  <td>
                    <a href="update_project?id=<?php echo $row_project[$i]['project_id'];?>" class="btn btn-info btn-sm">Update</a>
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