<?php

include('session.php');
if (isset($_POST['add_staff'])) {
	if (!is_null($_POST['name'])) {
		$query="SELECT COUNT(*) FROM staff;";
	    $result=mysql_query($query);
	    if ($result === FALSE) {
	    	$error="Can't retrieve list";
	    } else {
	    	if($row = mysql_fetch_assoc($result)){
		    	$num = $row['COUNT(*)'];
			    $datetime=new DateTime('NOW');
			    $datetime=$datetime->format('Y-m-d');;
			    $query="INSERT INTO staff VALUES('s" . (intval($num)+1) . "',";
		    	$query.="'".$_POST['name']."', '".$_POST['email']."',";
			    $query.=" '".$_POST['type']."', '$datetime');";
			    $result=mysql_query($query);
				if ($result === FALSE) {
					$error="Some error";
				} else {
				
//	need to insert values in to login after talking to varun
//	INSERT INTO login values('','','','s'+num);
				
					header("location: profile.php");
				}
			} else {
				$error="Wrong count";
			}
		}
	}
}
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Doctor</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
	<?php
    	////*****Admin******\\\\\\\\
	    if (strcmp($login_session_role, "ADMIN")  == 0){
	?>
			<form name="form" action="" method="post">
		        Doctor Name: <input type="text" name="name" style="width: 150px;"><br>
		        Email: <input type="text" name="email" style="width: 150px;"><br>
				<SELECT NAME="type">
					<OPTION VALUE="DOCTOR">Doctor
					<OPTION VALUE="NURSE">Nurse
				</SELECT>
		        <input name="add_staff" type="submit" value="Submit" style="width: 100px;">
		    	<input type="button" value="Back" style="float: right" onClick="document.location.href='profile.php'"  />
		    	<span><?php echo $error; ?></span>
    		</form>
    <?php
    	}
    ?>
	<input type="button" value="Logout" onClick="location.href='logout.php'" />
</div>