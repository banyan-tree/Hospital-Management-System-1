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
    <p align="right">
        <button type="submit" value="Reset Password" style="float right; background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px"onClick="document.location.href='reset.php'">Reset Password</button>
        <input align="right" type="button" value="Logout" style="float right; background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="location.href='logout.php'" />
    </p>
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
		
		////***********\\\\\\\\
		if (strcmp($login_session_role, "ADMIN") == 0) {
		    include('admin.php');
		}
	?></p>
</div>
</body>
</html>