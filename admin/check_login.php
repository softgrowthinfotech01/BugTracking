<?php
if(!isset($_SESSION['admin_username']))
{
    echo "<script>alert('Please login to view this page.');window.location.href = '../select_login';</script>";
 }else
    {
        $admin_login=$_SESSION['admin_username'];
        $stmt_admin_details = $conn->prepare("SELECT * FROM admin_details WHERE admin_login='$admin_login'");
        $stmt_admin_details->execute();
        $row_admin_details = $stmt_admin_details->fetchAll(PDO::FETCH_ASSOC);
        
    }
?>