<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
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

    <title>Dashboard</title>

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
        <div class="col-12">
          <h4>Dashboard</h4>
          <hr>
        </div>
        <div class="col-md-4">
          <div class="p-3 text-white text-center" style="background-color:#D63031;border-radius:15px;">
            <h4>
                <?php
                $stmt_new_bugs = $conn->prepare("SELECT COUNT(bug_id) AS tot FROM bug WHERE developer_employee_id=".$_SESSION['employee_id']);
                $stmt_new_bugs->execute();
                $row_new_bugs = $stmt_new_bugs->fetchAll(PDO::FETCH_ASSOC);
                echo $row_new_bugs[0]['tot'];
                ?>
            </h4>
            <h6>Bugs Assigned To Me</h6>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 text-white text-center" style="background-color:#2475B0;border-radius:15px;">
            <h4>
               <?php
                $stmt_active_bugs = $conn->prepare("SELECT COUNT(bug_id) AS tot FROM bug WHERE bug_status IN ('active') AND developer_employee_id=".$_SESSION['employee_id']);
                $stmt_active_bugs->execute();
                $row_active_bugs = $stmt_active_bugs->fetchAll(PDO::FETCH_ASSOC);
                echo $row_active_bugs[0]['tot'];
                ?>
            </h4>
            <h6>Total Active Bugs</h6>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-3 text-white text-center" style="background-color:#FAC42F;border-radius:15px;">
            <h4>
                <?php
                $stmt_closed_bugs = $conn->prepare("SELECT COUNT(bug_id) AS tot FROM bug WHERE bug_status IN ('closed') AND developer_employee_id=".$_SESSION['employee_id']);
                $stmt_closed_bugs->execute();
                $row_closed_bugs = $stmt_closed_bugs->fetchAll(PDO::FETCH_ASSOC);
                echo $row_closed_bugs[0]['tot'];
                ?>
            </h4>
            <h6>Total Completed Bugs</h6>
          </div>
        </div>
      </div>
      <div class="row mt-5">
        <div class="col-12">
          <h4>Pending Bugs</h4>
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
            <?php
                $stmt_bug = $conn->prepare("SELECT * FROM bug WHERE developer_employee_id=".$_SESSION['employee_id']." AND bug_status IN ('assigned','active') ORDER BY bug_id DESC");
                $stmt_bug->execute();
                $row_bug = $stmt_bug->fetchAll(PDO::FETCH_ASSOC);
                //print_r($row_customer_total);exit;
            if($row_bug)
            {
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
                  <td>
                    <a href="update_bug?id=<?php echo $row_bug[$i]['bug_id'];?>" class="btn btn-info btn-sm">Update</a>
                  </td>
                </tr>
                <?php
                }
            }
            else
            {
                ?>
                <tr>
                  <td colspan="6">No Bugs Found</td>
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