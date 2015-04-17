<?php

include('session.php');
if (isset($_POST['add_staff'])) {
	if (!empty($_POST['name']) and !empty($_POST['email'])) {
		$query="SELECT COUNT(*) FROM staff;";
	    $result=mysql_query($query);
	    if ($result === FALSE) {
	    	$error="Can't retrieve list";
	    } else {
	    	if($row = mysql_fetch_assoc($result)){
		    	$num = $row['COUNT(*)'];
		    	$num=(intval($num)+1);
			    $datetime=new DateTime('NOW');
			    $datetime=$datetime->format('Y-m-d');;
			    $query="INSERT INTO staff VALUES('s" . $num . "',";
		    	$query.="'".$_POST['name']."', '".$_POST['email']."',";
			    $query.=" '".$_POST['type']."', '$datetime');";
			    $result=mysql_query($query);
				if ($result === FALSE) {
					$error="Some error";
				} else {
					$new_user = md5("s" . $num . $_POST['name']);
					$query="INSERT INTO login values('".$new_user;
					$query.="','".md5($_POST['name'])."','".$_POST['type'];
					$query.="','s".$num."');";
					$result=mysql_query($query);
					if ($result === FALSE) {
						$error="Login not updated";
					} else {
						header("location: profile.php");
					}
				}
			} else {
				$error="Wrong count";
			}
		}
	} else {
		$error="Name or Email cannot be blank";
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
    </p align = "right">
    <input type="button" value="Logout" style="float: right; background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px"  onClick="location.href='logout.php'" />
    </p>
	<?php
    	////*****Admin******\\\\\\\\
	    if (strcmp($login_session_role, "ADMIN")  == 0){
	?>
			<form name="form" action="" method="post">
		        Staff Name: <input type="text" name="name" style="width: 150px;"><br>
		        Email: <input type="text" name="email" style="width: 150px;"><br>
				<SELECT NAME="type" style="
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" >
					<OPTION VALUE="DOCTOR">Doctor
					<OPTION VALUE="NURSE">Nurse
				</SELECT>
		        <input name="add_staff" type="submit" value="Submit" style="width: 100px;">
		    	<input type="button" value="Back" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px"  onClick="document.location.href='profile.php'"  />
		    	<span><?php echo $error; ?></span>
    		</form>
    <?php
    	}
    ?>

</div>