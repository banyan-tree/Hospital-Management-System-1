<?php

include('session.php');
if (isset($_POST['new_patient'])) {
	if (!empty($_POST['name']) and !empty($_POST['email']) and
	 !empty($_POST['address']) and !empty($_POST['phone']) and
	  !empty($_POST['age'])) {
		$query="SELECT COUNT(*) FROM patient_record;";
	    $result=mysql_query($query);
	    if ($result === FALSE) {
	    	$error="Can't retrieve list";
	    } else {
	    	if($row = mysql_fetch_assoc($result)){
		    	$num = $row['COUNT(*)'];
			    $query="INSERT INTO patient_record VALUES('p".(intval($num)+1);
		    	$query.="', '".$_POST['name']."', '".$_POST['address']."',";
			    $query.=" '".$_POST['email']."', '".$_POST['phone']."',";
			    $query.=" '".$_POST['age']."');";
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
	} else {
		$error="Name, Email, Address, Phone or Age cannot be blank";
	}
}
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>New Patient</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
	<?php
    	////*****Admin******\\\\\\\\
	    if (strcmp($login_session_role, "NURSE")  == 0){
	?>
			<form name="form" action="" method="post">
		        Patient Name: <input type="text" name="name" style="width: 150px;"><br>
		        Address: <input type="text" name="address" style="width: 150px;"><br>
		        Email: <input type="text" name="email" style="width: 150px;"><br>
		        Phone: <input type="number" name="phone" style="width: 150px;"><br>
		        Age: <input type="number" name="age" style="width: 150px;"><br>
		        <input name="new_patient" type="submit" value="Submit" style="width: 100px;">
		    	<input type="button" value="Back" style="float: right" onClick="document.location.href='profile.php'"  />
		    	<span><?php echo $error; ?></span>
    		</form>
    <?php
    	}
    ?>
	<input type="button" value="Logout" onClick="location.href='logout.php'" />
</div>