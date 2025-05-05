<?php
session_start();
require_once "conn.php";
require_once "check_login.php";
if(isset($_POST['customer_submit']))
{
  extract($_POST);
  $stmt = $conn->prepare("INSERT INTO customer(full_name, mobile_no, c_email, full_address, vehical_name, vehicle_modal_no, emi_duration, reg_date, loan_sanction_date, proposal_no, meeting_no, loan_given_date, last_date_of_loan, loan_amount, loan_net_amount, cheque_no, bank_name, cheque_amount, amount_in_words, monthly_emi_amount, emi_amount_in_words, witness_type1, w_full_name1, w_age1, w_occupation1, w_annual_income1, w_mobile_no1, w_full_address1, w_cheque_no1, witness_type2, w_full_name2, w_age2, w_occupation2, w_annual_income2, w_mobile_no2, w_full_address2, w_cheque_no2, added_on) VALUES (:full_name, :mobile_no, :c_email, :full_address, :vehical_name, :vehicle_modal_no, :emi_duration, :reg_date, :loan_sanction_date, :proposal_no, :meeting_no, :loan_given_date, :last_date_of_loan, :loan_amount, :loan_net_amount, :cheque_no, :bank_name, :cheque_amount, :amount_in_words, :monthly_emi_amount, :emi_amount_in_words, :witness_type1, :w_full_name1, :w_age1, :w_occupation1, :w_annual_income1, :w_mobile_no1, :w_full_address1, :w_cheque_no1, :witness_type2, :w_full_name2, :w_age2, :w_occupation2, :w_annual_income2, :w_mobile_no2, :w_full_address2, :w_cheque_no2, :added_on)");
   $executed=$stmt->execute(array(':full_name' => $full_name, ':mobile_no' => $mobile_no, ':c_email' => $c_email, ':full_address' => $full_address, ':vehical_name' => $vehical_name, ':vehicle_modal_no' => $vehicle_modal_no, ':emi_duration' => $emi_duration, ':reg_date' => $reg_date, ':loan_sanction_date' => $loan_sanction_date, ':proposal_no' => $proposal_no, ':meeting_no' => $meeting_no, ':loan_given_date' => $loan_given_date, ':last_date_of_loan' => $last_date_of_loan, ':loan_amount' => $loan_amount, ':loan_net_amount' => $loan_net_amount, ':cheque_no' => $cheque_no, ':bank_name' => $bank_name, ':cheque_amount' => $cheque_amount, ':amount_in_words' => $amount_in_words, ':monthly_emi_amount' => $monthly_emi_amount, ':emi_amount_in_words' => $emi_amount_in_words, ':witness_type1' => $witness_type1, ':w_full_name1' => $w_full_name1, ':w_age1' => $w_age1, ':w_occupation1' => $w_occupation1, ':w_annual_income1' => $w_annual_income1, ':w_mobile_no1' => $w_mobile_no1, ':w_full_address1' => $w_full_address1, ':w_cheque_no1' => $w_cheque_no1, ':witness_type2' => $witness_type2, ':w_full_name2' => $w_full_name2, ':w_age2' => $w_age2, ':w_occupation2' => $w_occupation2, ':w_annual_income2' => $w_annual_income2, ':w_mobile_no2' => $w_mobile_no2, ':w_full_address2' => $w_full_address2, ':w_cheque_no2' => $w_cheque_no2, ':added_on' => date("Y-m-d H:i:s")));
   if($executed){
       echo '<script>alert("Customer added successfully.");window.location.href = "customeremidetails";</script>';

   }      
   else{
       echo '<script>alert("There is some error. Please try again");window.location.href = "dashboard";</script>';

   }
}


//get all categories
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

    <title>Customer Registration</title>
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
          <h5>Customer Registration</h5>
          <hr>
        </div>
    <form method="post" action="">
        <div class="form-row w-100">
            <div class="form-group col-md-3">
              <label class="col-12">Full Name</label>
              <input type="text" class="form-control col-12" name="full_name">
            </div>
            <div class="form-group col-md-2">
              <label class="col-12">Mobile No</label>
              <input type="text" class="form-control col-12" name="mobile_no" maxlength="10">
            </div>
            <div class="form-group col-md-3">
              <label class="col-12">Email</label>
              <input type="text" class="form-control col-12" name="c_email">
            </div>
            <div class="form-group col-md-4">
              <label class="col-12">Full Address</label>
              <textarea class="form-control" name="full_address"></textarea>
            </div>
        </div>
        <div class="col-12">
          <h5>Loan Details :</h5>
          <hr>
        </div>
        <div class="form-row">
             <div class="form-group col-4">
            <label class="col-12">Vehical Name</label>
            <input type="text" class="form-control col-12" name="vehical_name">
          </div>
            <div class="form-group col-4">
            <label class="col-12">Vehical Modal Number</label>
            <input type="text" class="form-control col-12" name="vehicle_modal_no">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Emi Month Duration</label>
            <input type="text" class="form-control col-12" name="emi_duration">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Registration Date</label>
            <input type="date" class="form-control col-12" name="reg_date">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Loan Sanction Date</label>
            <input type="date" class="form-control col-12" name="loan_sanction_date">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Proposal No.</label>
            <input type="text" class="form-control col-12" name="proposal_no">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Meeting No</label>
            <input type="text" class="form-control col-12" name="meeting_no">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Loan Given Date</label>
            <input type="date" class="form-control col-12" name="loan_given_date">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Last Date of Loan</label>
            <input type="date" class="form-control col-12" name="last_date_of_loan">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Loan Amount</label>
            <input type="text" class="form-control col-12" name="loan_amount">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Loan Net Amount</label>
            <input type="text" class="form-control col-12" name="loan_net_amount">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Cheque No.</label>
            <input type="text" class="form-control col-12" name="cheque_no">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Bank Name</label>
            <input type="text" class="form-control col-12" name="bank_name">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Cheque Amount</label>
            <input type="text" class="form-control col-12" name="cheque_amount">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Amount In Words</label>
            <input type="text" class="form-control col-12" name="amount_in_words">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Monthly Emi Amount</label>
            <input type="text" class="form-control col-12" name="monthly_emi_amount">
          </div>
          <div class="form-group col-4">
            <label class="col-12">Amount In Words</label>
            <input type="text" class="form-control col-12" name="emi_amount_in_words">
          </div>
        </div>

        <div class="col-12">
          <h5>Witness 1 Details:</h5>
          <hr>
        </div>
        <div class="form-row w-100">
          <div class="form-group col-md-3">
            <label class="col-12">Witness Type</label>
            <select class="form-control" name="witness_type1">
              <option value="Witness">Witness</option>
              <option value="Guaranter">Guaranter</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label class="col-12">Full Name</label>
            <input type="text" class="form-control col-12" name="w_full_name1">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Age</label>
            <input type="text" class="form-control col-12" name="w_age1">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Occupation</label>
            <input type="text" class="form-control col-12" name="w_occupation1">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Annual Income</label>
            <input type="text" class="form-control col-12" name="w_annual_income1">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Mobile No</label>
            <input type="text" class="form-control col-12" name="w_mobile_no1" maxlength="10">
          </div>
          <div class="form-group col-md-4">
            <label class="col-12">Full Address</label>
            <textarea class="form-control" name="w_full_address1"></textarea>
          </div>
          <div class="form-group col-md-4">
            <label class="col-12">Cheque No.</label>
            <input type="text" class="form-control col-12" name="w_cheque_no1">
          </div>
        </div>
        <div class="col-12">
          <h5>Witness 2 Details:</h5>
          <hr>
        </div>
        <div class="form-row w-100">
          <div class="form-group col-md-3">
            <label class="col-12">Witness Type</label>
            <select class="form-control" name="witness_type2">
              <option value="Witness">Witness</option>
              <option value="Guaranter">Guaranter</option>
            </select>
          </div>
          <div class="form-group col-md-3">
            <label class="col-12">Full Name</label>
            <input type="text" class="form-control col-12" name="w_full_name2">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Age</label>
            <input type="text" class="form-control col-12" name="w_age2">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Occupation</label>
            <input type="text" class="form-control col-12" name="w_occupation2">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Annual Income</label>
            <input type="text" class="form-control col-12" name="w_annual_income2">
          </div>
          <div class="form-group col-md-2">
            <label class="col-12">Mobile No</label>
            <input type="text" class="form-control col-12" name="w_mobile_no2" maxlength="10">
          </div>
          <div class="form-group col-md-4">
            <label class="col-12">Full Address</label>
            <textarea class="form-control" name="w_full_address2"></textarea>
          </div>
          <div class="form-group col-md-4">
            <label class="col-12">Cheque No.</label>
            <input type="text" class="form-control col-12" name="w_cheque_no2">
          </div>
        </div>
        <div class="form-row w-100">
          <!--<table class="table table-bordered">
            <thead>
              <tr>
                <th>Sr. No.</th>
                <th>Witness Type</th>
                <th>Name</th>
                <th>Age</th>
                <th>Occupation</th>
                <th>Income</th>
                <th>Mobiel</th>
                <th>Address</th>
                <th>Home</th>
                <th>Farm</th>
                <th>Cheque</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Gaurater</td>
                <td>abc</td>
                <td>35</td>
                <td>Business</td>
                <td>1500000</td>
                <td>123456789</td>
                <td>Nagbhid</td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>-->
        </div>
        <div class="form-row">
          <div class="col">
            <input type="submit" name="customer_submit" class="btn btn-success" value="Save">
          </div>
          <!--<div class="col">
            <input type="button" class="btn btn-info" value="New">
          </div>
          <div class="col">
            <input type="button" class="btn btn-danger" value="Cancel">
          </div>-->
        </div>

      </div>
      </form>
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