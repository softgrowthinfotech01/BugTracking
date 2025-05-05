<?php
session_start();
require_once "conn.php";
require_once "check_login.php";

$stmt_customer_list = $conn->prepare("SELECT * FROM customer ORDER By customer_id DESC");
$stmt_customer_list->execute();
$row_customer_list = $stmt_customer_list->fetchAll(PDO::FETCH_ASSOC);
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

    <title>Customer EMI Details</title>
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
          <h3>Customer EMI Details</h3>
          <hr>
        </div>
        <div class="col-12">          
          <!--<div class="col-3 mr-auto">
            <div class="form-group">
              <label>Search</label>
              <input type="text" class="form-cotrol" name="">
            </div>
          </div>-->
          <table class="table">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Customer Name</th>
                <th>Vehicle Name</th>
                <th>Mobile No.</th>
                <th>Loan Given Date</th>
                <th>Last Loan Date</th>
                <th>EMI Amount</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
                    if($row_customer_list)
                    {
                        for($c=0;$c<count($row_customer_list);$c++)
                        {
                            
                      ?>
                          <tr>
                            <td><?php echo $c+1;?></td>
                            <td><?php echo $row_customer_list[$c]['full_name'];?></td>
                            <td><?php echo $row_customer_list[$c]['vehical_name'];?></td>
                            <td><?php echo $row_customer_list[$c]['mobile_no'];?></td>
                            <td><?php echo date("d-m-Y", strtotime($row_customer_list[$c]['loan_given_date']));?></td>
                            <td><?php echo date("d-m-Y", strtotime($row_customer_list[$c]['last_date_of_loan']));?></td>
                            <td><?php echo $row_customer_list[$c]['monthly_emi_amount'];?></td>
                            <td>
                              <a class="btn btn-info btn-sm" href="emientry?id=<?php echo $row_customer_list[$c]['customer_id'];?>">Pay EMI</a>
                              <a class="btn btn-warning btn-sm" href="customerstatement?id=<?php echo $row_customer_list[$c]['customer_id'];?>">Statement</a>
                              <a class="btn btn-danger btn-sm" href="profile?id=<?php echo $row_customer_list[$c]['customer_id'];?>">Profile</a>
                            </td>
                          </tr>
                    <?php
                        }
                    }
                    ?>
            </tbody>
            
          </table>          
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