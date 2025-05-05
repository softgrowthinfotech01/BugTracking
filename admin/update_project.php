<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_GET['id']))
{
    $project_id=$_GET['id'];
    $stmt_project = $conn->prepare("SELECT * FROM project WHERE project_id=".$project_id);
    $stmt_project->execute();
    $row_project = $stmt_project->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_POST['submit']))
{
  extract($_POST);
  $stmt = $conn->prepare("UPDATE project SET  project_name=:project_name, project_manager=:project_manager WHERE project_id=".$project_id);
   $executed=$stmt->execute(array( ':project_name' => $project_name, ':project_manager' => $project_manager));
   if($executed){
       echo '<script>alert("Project updated successfully.");window.location.href = "add_project";</script>';

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

    <title>Update Project</title>
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
          <h3>Update Project</h3>
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
                    <input type="text" class="form-control" name="project_name" value="<?php echo $row_project[0]['project_name'];?>" >
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Project Manager</label>
                    <input type="text" class="form-control" name="project_manager" value="<?php echo $row_project[0]['project_manager'];?>">
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