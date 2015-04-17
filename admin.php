<?php
include('session.php');
?>
<html>
<head>
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<?php
    	////*****Admin******\\\\\\\\
	    if (strcmp($login_session_role, "ADMIN")  == 0){
	?>
			<button type="submit" value="Add Doctor" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="document.location.href='add_staff.php'">Add Staff</button>
			<button type="submit" value="Reset Any Password" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="document.location.href='global_reset.php'">Reset Any Password</button>
<?php
    	}
?>
</body>
</html>