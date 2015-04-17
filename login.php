<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{


// Define $username and $password
$username1=$_POST['username'];
    $username=md5($username1);
$password=$_POST['password'];
    $password=md5($password);
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "infinite");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("test", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from login where password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['login_name']=$username1;

    // Encryption for data in transit

// Generate a 256-bit encryption key
// This should be stored somewhere instead of recreating it each time
    $encryption_keyinLogin = openssl_random_pseudo_bytes(32);
// Generate an initialization vector
// This *MUST* be available for decryption as well
    $iv_inLogin = openssl_random_pseudo_bytes(openssl_cipher_iv_length(AES_256_CBC));
    $_SESSION['encrypt_key']=$encryption_keyinLogin; // Initializing Session
    $_SESSION['encrypt_iv']=$iv_inLogin;

    header("location: profile.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>