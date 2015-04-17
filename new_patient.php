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
		    	$num = (intval($num)+1);
			    $query="INSERT INTO patient_record VALUES('p".$num;
		    	$query.="', '".$_POST['name']."', '".$_POST['address']."',";
			    $query.=" '".$_POST['email']."', '".$_POST['phone']."',";
			    $query.=" '".$_POST['age']."');";
			    $result=mysql_query($query);
				if ($result === FALSE) {
					$error="Some error";
				} else {
					$new_user = md5("p" . $num . $_POST['name']);
					$query="INSERT INTO login values('".$new_user;
					$query.="','".md5($_POST['name'])."','PATIENT'";
					$query.=",'p".$num."');";
					$result=mysql_query($query);
					if (!$result) {
						$error="Login not updated";
					} else {
						$query="SELECT COUNT(*) FROM prescription;";
	    				$result=mysql_query($query);
				 	    if ($result === FALSE) {
					    	$error="Can't retrieve list";
					    } else {
					    	if($row = mysql_fetch_assoc($result)){
						    	$num1 = $row['COUNT(*)'];
						    	$num1 = (intval($num1)+1);
						    	$datetime=new DateTime('NOW');
			    				$datetime=$datetime->format('Y-m-d');
						    	$query="INSERT INTO prescription VALUES('c".$num1;
		    	$query.="', '$datetime', '".$_POST['diagnosis']."',";
			    $query.=" '".$_POST['drugs']."', '".$_POST['insurance_Company']."',";
			    $query.=" '".$_POST['insurance_id']."', '$user_id', 'p".$num."');";
			    $result=mysql_query($query);
								if ($result === FALSE) {
									$error="Some error";
								} else {
									header("location: profile.php");
									}
							} else {
								$error="Wrong count1";
							}
						}
					}
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
<p align="right">
    <br><br>
    <input align="right" type="button" value="Logout" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="location.href='logout.php'" /></p>
<div id="profile">
	<?php
    	////*****Admin******\\\\\\\\
	    if (strcmp($login_session_role, "DOCTOR")  == 0){
	?>
			<form name="form" action="" method="post">
                NEW PATIENT <br>

		        Patient Name: <input type="text" name="name" style="width: 150px;"><br>
		        Address: <input type="text" name="address" style="width: 150px;"><br>
		        Email: <input type="text" name="email" style="width: 150px;"><br>
		        Phone: <input type="number" name="phone" style="width: 150px;"><br>
		        Age: <input type="number" name="age" style="width: 150px;"><br>
		        Diagnosis: <input type="text" name="diagnosis" style="width: 150px;"><br>
		        Drugs: <input type="text" name="drugs" style="width: 150px;"><br>
		        Insurance Company: <input type="text" name="insurance_Company" style="width: 150px;"><br>
		        Insurance ID: <input type="text" name="insurance_id" style="width: 150px;"><br>
		        <input name="new_patient" type="submit" value="Submit" style="width: 100px;">
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
    	}
    ?>
</div>