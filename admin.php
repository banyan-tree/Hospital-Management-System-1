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
			<button type="submit" value="Add Doctor" onClick="document.location.href='add_staff.php'">Add Staff</button>
			<button type="submit" value="Reset Any Password" onClick="document.location.href='global_reset.php'">Reset Any Password</button>
<?php
    	}
?>
</body>
</html>