<?php

include('session.php');
if (isset($_POST['reset'])) {
	if (!is_null($_POST['new-password'])) {
		$query="SELECET * FROM login where username = '";
    	$query.=$user_check . "';";
	    $result=mysql_query($query);

		if (!$result) {
			if (strcmp($_POST['new-password'], $_POST['re-password']) == 0) {
				$password = md5($_POST['new-password']);
				$query="UPDATE login SET password='$password'";
				$query.=" WHERE username='$user_check'";
				$result=mysql_query($query);
				if($result) {
					header("location: profile.php");
				} else {
					$error="Error updating";
				}
			} else {
				$error="Both passwords must be equal";
			}
		} else {
			$error="User probably does not exist";
		}
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
	Username: <?php echo $user_name;?><br>
	New Password: <input type="password" name="new-password" style="width: 150px;"><br>
	Retype Password: <input type="password" name="re-password" style="width: 150px;"><br>
	<input name="reset" type="submit" value="Submit" style="width: 100px;">
	<input type="button" value="Back" style="float: right" onClick="document.location.href='profile.php'"  />
	<span><?php echo $error; ?></span>
</form>
<input type="button" value="Logout" onClick="location.href='logout.php'" />
</div>