<?php
session_start();
require_once "conn.php";
require_once "check_login.php";

$stmt_customer_payment = $conn->prepare("SELECT * FROM customer_payment WHERE MONTH(emi_payment_date)=MONTH(CURRENT_DATE()) ORDER BY customer_payment_id DESC");
$stmt_customer_payment->execute();
$row_customer_payment = $stmt_customer_payment->fetchAll(PDO::FETCH_ASSOC);
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

    <title>Reports</title>
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
          <h3>Paid EMI Report</h3>
          <hr>
        </div>
        <div class="col-12">          
          <div class="col-3 mr-auto">
            <div class="form-group">
                <a href="report_current_month" type="button" class="btn btn-primary  btn-sm">Current Month Report</a>
                <a href="reports" type="button" class="btn btn-primary  btn-sm">EMI Paid Report</a>
              <!--<label>Search</label>
              <input type="text" class="form-cotrol" name="">-->
            </div>
          </div>
          <table class="table">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Customer Name</th>
                <th>Proposal No.</th>
                <th>EMI Amount</th>
                <th>EMI Payment Date</th>
                <th>Penalty Amount</th>
                <th>Total Amount</th>
                <th>Paid Amount</th>
                <th>Balance Amount</th>
                <!--<th>Action</th>-->
              </tr>
            </thead>
            <tbody>
              <?php
                    if($row_customer_payment)
                    {
                        for($c=0;$c<count($row_customer_payment);$c++)
                        {
                            $stmt_customer = $conn->prepare("SELECT * FROM customer WHERE customer_id=".$row_customer_payment[$c]['customer_id']);
                            $stmt_customer->execute();
                            $row_customer = $stmt_customer->fetchAll(PDO::FETCH_ASSOC);
                      ?>
                          <tr>
                            <td><?php echo $c+1;?></td>
                            <td><?php echo $row_customer[0]['full_name'];?></td>
                            <td><?php echo $row_customer[0]['proposal_no'];?></td>
                            <td><?php echo $row_customer_payment[$c]['emi_amount'];?></td>
                            <td><?php echo date("d-m-Y", strtotime($row_customer_payment[$c]['emi_payment_date']));?></td>
                            <td><?php echo "Rs. ".$row_customer_payment[$c]['penalty_charges'];?></td>
                            <td><?php echo "Rs. ".$row_customer_payment[$c]['total_amount'];?></td>
                            <td><?php echo "Rs. ".$row_customer_payment[$c]['paid_amount'];?></td>
                            <td><?php echo "Rs. ".$row_customer_payment[$c]['balance_amount'];?></td>
                            <!--<td>
                              <a class="btn btn-info btn-sm" href="emientry?id=<?php echo $row_customer_list[$c]['customer_id'];?>">Pay EMI</a>
                              <a class="btn btn-warning btn-sm" href="customerstatement?id=<?php echo $row_customer_list[$c]['customer_id'];?>">Statement</a>
                              <a class="btn btn-danger btn-sm" href="profile?id=<?php echo $row_customer_list[$c]['customer_id'];?>">Profile</a>
                            </td>-->
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

    <!--<footer class="footer text-center">
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