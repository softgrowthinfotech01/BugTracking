<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_POST['submit']))
{
 
  $img_name = $_FILES['employee_img']['name']; //image name
  $employee_tmp = $_FILES['employee_img']['tmp_name']; //img tmp name
  $extension_img = explode(".",$img_name);
  $extension_img = end($extension_img);
  // print_r($extension_img);exit;

  // allowed extensions
$allowed_extensions1 = array("jpg","jpeg","png");
// Validation for allowed extensions .in_array() function searches an array for a specific value.
if(!in_array($extension_img,$allowed_extensions1))
{
echo "<script>alert('Featured image has Invalid format. Only jpg / jpeg/ png format allowed');</script>";
}
else{
  //rename img name
  $img_name = md5($img_name).time().".".$extension_img;
// print_r($img_name);exit;
  // upload to respective directories
move_uploaded_file($_FILES['employee_img']['tmp_name'], 'project_images/'.$img_name);

 
  extract($_POST);
  // print_r($_POST);exit;
  $stmt = $conn->prepare("INSERT INTO bug(project_id, bug_name, bug_description, tester_employee_id, developer_employee_id, bug_status, employee_img) VALUES (:project_id, :bug_name, :bug_description, :tester_employee_id, :developer_employee_id, :bug_status, :employee_img)");
   $executed=$stmt->execute(array(':project_id' => $project_id, ':bug_name' => $bug_name, ':bug_description' => $bug_description, ':tester_employee_id' => $_SESSION['employee_id'], ':developer_employee_id' => $developer_employee_id, ':bug_status' => "new",  ':employee_img' => $img_name));
   if($executed){
       echo '<script>alert("Bug added successfully.");window.location.href = "add_bug";</script>';

   }      
   else{
       echo '<script>alert("There are some error. Please try again");window.location.href = "add_bug";</script>';

   }
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
          <form method="post" action="" onsubmit="return validateForm()"  enctype="multipart/form-data">
      <div class="row">
        <div class="col-md-12">
            <div class="col-md-6">
              <div class="form-row">
                <div class="col-md-10">
                  <div class="form-row">
                    <div class="col">
                      <label class="control-label">Project</label>
                      <select class="form-control" name="project_id" id="project_id">
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
                      <span id="error" style="color:red;"></span>
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
                  <div class="form-group">
                    <label class="control-label">Assign Developer</label>
                    <select name="developer_employee_id" id="" class="form-control">
                      <?php 
                      $stmt = $conn->prepare("SELECT * FROM employee WHERE employee_type = 'Developer'");
                      $stmt->execute();
                      $row = $stmt->fetchAll(PDO::FETCH_ASSOC);
                      for ($i=0; $i <count($row) ; $i++) { 
                       ?>
                      <option value="<?php echo $row[$i]['employee_id']; ?>"><?php echo $row[$i]['employee_name']; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    
                  </div>
                </div>
                <div class="col-md-10">
                  <div class="form-group">
                    <label class="control-label">Bug Image</label>
                    <input type="file" class="form-control" name="employee_img" >
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
                  <th>Bug image</th>
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
                  <td> <img src="project_images/<?php echo $row_bug[$i]['employee_img']; ?>" alt="bug image" style="width:100%; height:auto;"></td>
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

<script>

function validateForm() {
  let select = document.getElementById("project_id").value;
  let selectError = document.getElementById("error");
  
  if (select = "") {
    selectError.innerText = "select Project";
    return false;
  } else {
    selectError.innerText = "";
    return true;
  }
}
</script>

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