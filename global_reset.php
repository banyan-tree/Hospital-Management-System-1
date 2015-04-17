<?php

include('session.php');
if (isset($_POST['reset'])) {
	if (!is_null($_POST['username'])) {
		$username=md5($_POST['username']);
		$query="SELECET * FROM login where username = '";
    	$query.=$username . "';";
	    $result=mysql_query($query);

		if (!$result) {
			if (strcmp($_POST['new-password'], $_POST['re-password']) == 0) {
				$password = md5($_POST['new-password']);
				$query="UPDATE login SET password='$password'";
				$query.=" WHERE username='$username'";
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
    <p align="right">
        <input type="button" value="Logout" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="location.href='logout.php'" />
    </p>
	<?php
    	////*****Admin******\\\\\\\\
	    if (strcmp($login_session_role, "ADMIN")  == 0){
	?>
			<form name="form" action="" method="post">
		        Username: <input type="text" name="username" style="width: 150px;"><br>
		        New Password: <input type="password" name="new-password" style="width: 150px;"><br>
		        Retype Password: <input type="password" name="re-password" style="width: 150px;"><br>
		        <input name="reset" type="submit" value="Submit" style="width: 100px;">
		    	<input type="button" value="Back" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="document.location.href='profile.php'"  />
		    	<span><?php echo $error; ?></span>
    		</form>
    <?php
    	} else {
    		?><p>You do not have enough permissions</p>
    		<input type="button" value="Back" onClick="location.href='profile.php'" />
    		<?php
    	}
    ?>

</div>