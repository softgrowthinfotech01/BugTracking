  <?php 
	$servername="localhost";
	$dbname="softgrow_bug_tracking";
	$username="root";
	$password="";
		   $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		   ?>