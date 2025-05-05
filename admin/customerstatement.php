<?php
session_start();
require_once "conn.php";
require_once "check_login.php";

if(isset($_GET['id']))//when you come from customer emi details page
{
    $stmt_customer = $conn->prepare("SELECT * FROM customer WHERE customer_id=".$_GET['id']);
    $stmt_customer->execute();
    $row_customer = $stmt_customer->fetchAll(PDO::FETCH_ASSOC);
    
    //check if any payment is done and get last entry of this customer
    $stmt_customer_payment = $conn->prepare("SELECT * FROM customer_payment WHERE customer_id=".$_GET['id']." ORDER BY customer_payment_id DESC");
    $stmt_customer_payment->execute();
    $row_customer_payment = $stmt_customer_payment->fetchAll(PDO::FETCH_ASSOC);
    
}
/*else
{
    echo '<script>alert("Customer Id not found");window.location.href = "customeremidetails";</script>';

}*/
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

    <title>Statement</title>
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
          <h3>Customer EMI Statement</h3>
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
                <th>Emi Date</th>
                <th>Paid Amount</th>
                <th>Penalty Amount</th>
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
                            
                      ?>
                      <tr>
                        <td><?php echo $c+1;?></td>
                        <td><?php echo date("d-m-Y", strtotime($row_customer_payment[$c]['emi_payment_date']));?></td>
                        <td><?php echo "Rs. ".$row_customer_payment[$c]['paid_amount'];?></td>
                        <td><?php echo "Rs. ".$row_customer_payment[$c]['penalty_charges'];?></td>
                        <td><?php echo "Rs. ".$row_customer_payment[$c]['balance_amount'];?></td>
                        <!--<td>
                          <input class="btn btn-info btn-sm" type="button" value="Pay Emi">
                          <input class="btn btn-warning btn-sm" type="button" value="Statement">
                          <input class="btn btn-danger btn-sm" type="button" value="Profile">
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