<?php
// Setting the timezone
date_default_timezone_set('America/New_York');

// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "infinite");
// Selecting Database
$db = mysql_select_db("test", $connection);
session_start();// Starting Session
// Storing Session
$user_check=$_SESSION['login_user'];
$user_name=$_SESSION['login_name'];
// SQL Query To Fetch Complete Information Of User
$ses_sql=mysql_query("select username, role,unique_ID from login where username='$user_check'", $connection);
$row = mysql_fetch_assoc($ses_sql);
$login_session_user =$row['username'];
$login_session_role =$row['role'];
$user_id=$row['unique_ID'];
if (strcmp($login_session_role, "doctor")  == 0) {
	$ses_sql=mysql_query("select level from doctor where username='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session_level = $row['level'];
} else if (strcmp($login_session_role, "patient")  == 0){
	$ses_sql=mysql_query("select address from patient where username='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session_address = $row['address'];
} else if (strcmp($login_session_role, "nurse")  == 0){
	$ses_sql=mysql_query("select duty from nurse where username='$user_check'", $connection);
	$row = mysql_fetch_assoc($ses_sql);
	$login_session_duty = $row['duty'];
}
if(!isset($login_session_user)){
mysql_close($connection); // Closing Connection
header('Location: index.php'); // Redirecting To Home Page
}
?>