<?php

include('session.php');
if (isset($_POST['reset'])) {
    if (!empty($_POST['new-password'])) {
        $pass=md5($_POST['old-password']);
        $ses_sql=mysql_query("select password from login where username='$user_check'", $connection);
        $row = mysql_fetch_assoc($ses_sql);
        $newPass =$row['password'];

        if ($pass!=$newPass) {
            $error="Incorrect old password";
        } else {
            if(strlen($_POST['new-password'])<6){
                $error="Password Too Short";
            }
            elseif (strcmp($_POST['new-password'], $_POST['re-password']) == 0) {
                $password = md5($_POST['new-password']);
                $query="UPDATE login SET password='$password'";
                $query.=" WHERE username='$user_check' and password='$pass'";
                $result=mysql_query($query);
                if(!$result) {
                    $error="Error updating";
                } else {
                    header("location: profile.php");
                }
            } else {
                $error="Both passwords must be equal";
            }

        }
    } else {
        $error="Password cannot be empty";
    }
}
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<form name="form" action="" method="post">
    <p align="right">
        <input align="right" type="button" style="float right; background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" value="Logout" onClick="location.href='logout.php'" />
    </p>
	Username: <?php echo $user_name;?><br>
	Old Password: <input type="password" name="old-password" style="width: 150px;"><br>
	New Password: <input type="password" name="new-password" style="width: 150px;"><br>
	Retype Password: <input type="password" name="re-password" style="width: 150px;"><br>
	<input name="reset" type="submit" value="Submit" style="width: 100px;">
	<input type="button" value="Back" style="float right; background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="document.location.href='profile.php'"  />
	<span><?php echo $error; ?></span>
</form>
</div>