<?php
ob_start();
include('session.php');
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Your Home Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
    <b id="welcome">Welcome : <i><?php echo ucwords($user_name);?></i></b>
    <p><?php
		if (strcmp($login_session_role, "DOCTOR") == 0) {
		    include('doctor.php');
		}

		////***********\\\\\\\\
		if (strcmp($login_session_role, "NURSE") == 0) {
			include('nurse.php');
		}

		////***********\\\\\\\\
		if (strcmp($login_session_role, "PATIENT") == 0) {
		    include('patient.php');
		}
	?></p>
    <input type="button" value="Logout" onClick="location.href='logout.php'" />
</div>
</body>
</html>