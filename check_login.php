<?php
if(!isset($_SESSION['employee_id']))
{
    echo "<script>alert('Please login to view this page.');window.location.href = 'employee_login';</script>";
 }else
    {
        $employee_id=$_SESSION['employee_id'];
        $stmt_employee_details = $conn->prepare("SELECT * FROM employee WHERE employee_id='$employee_id'");
        $stmt_employee_details->execute();
        $row_employee_details = $stmt_employee_details->fetchAll(PDO::FETCH_ASSOC);
        
    }
?>