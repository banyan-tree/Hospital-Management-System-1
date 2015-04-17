<?php
include('session.php');

if (isset($_POST['doctor_ID']) && isset($_POST['admission_ID'])) {
//    $doctor = $_POST['doctor_ID'];
//    $admission = $_POST['admission_ID'];

    // DEFINE our cipher
    define('AES_256_CBC', 'aes-256-cbc');
    $encrypted1 = $_POST['doctor_ID'];
    $encrypted2 = $_POST['admission_ID'];

//    echo "\n****encryption_key****".$encryption_key;
//    echo "\n****iv****".$iv;
//    echo "Encrypted11: $encrypted1\n";
//    echo "Encrypted22: $encrypted2\n";

    // To decrypt, separate the encrypted data from the initialization vector ($iv)
    $parts = explode(':', $encrypted1);
// $parts[0] = encrypted data
// $parts[1] = initialization vector
    $doctor = openssl_decrypt($parts[0], AES_256_CBC, $encryption_key, 0, $parts[1]);
   // echo "doctor: $doctor\n";

    $parts = explode(':', $encrypted2);
    $admission = openssl_decrypt($parts[0], AES_256_CBC, $encryption_key, 0, $parts[1]);
   // echo "admission: $admission\n";
}

if (isset($_POST['edit'])) {

	$datetime1 = new DateTime($_POST['admission_Date']);
	$datetime2 = new DateTime($_POST['discharge_Date']);
	$interval = date_diff($datetime1, $datetime2);
	if(strcmp($interval->format('%R'), "+") == 0) {
		$query="UPDATE discharge_sheet SET discharge_Date=STR_TO_DATE('" . $_POST['discharge_Date'] ."','%Y-%m-%d')";
		$query .= " WHERE doctor_ID='" . $_POST['doctor_ID'] . "'";
		$query .= " AND admission_ID='" . $_POST['admission_ID'] . "';";
	
		$result = mysql_query($query);
	
		if (!$result) {
			die("Update query failed." . mysql_error() . $query);
		} else {
			header("location: doctor_Discharge.php");
		}
	} else {
		$error="Invalid discharge date";
	}
}

include('header.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Personal Info</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div id="profile">
	    <b id="welcome">Welcome : <i><?php echo ucwords($user_name); ?></i></b>
		<b><center>Edit Personal Info</center></b><br><br>

    	<?php
    	if (strcmp($login_session_role, "DOCTOR")  == 0) {
	        $query = "select patient_name, DATE_FORMAT(admission_Date, '%Y-%m-%d'), DATE_FORMAT(discharge_Date, '%Y-%m-%d'), bed_Number, staff_Name from doctor_patient_discharge where doctor_ID='$user_id' AND admission_ID='$admission'";
	        
	        $result = mysql_query($query);
	        
	        if ($result === FALSE) {
	            die("Error getting result in personal info\n" . $query . mysql_error());
	        }
    	    $num = mysql_numrows($result);
        	if ($num > 1) {
        	    die("More than 1 user returned");
	        } 
	        
	        $i = 0;
	        $name = mysql_result($result, $i, "patient_name");
            $admission_Date = mysql_result($result, $i, "DATE_FORMAT(admission_Date, '%Y-%m-%d')");
            $discharge_Date = mysql_result($result, $i, "DATE_FORMAT(discharge_Date, '%Y-%m-%d')");
            $bed_Number = mysql_result($result,$i,"bed_Number");
            $staff_Name = mysql_result($result, $i, "staff_Name");
        }
    	?>  
	    <form name="form" action="" method="post">
			Name: <?php echo $name; ?><br>
			Admission Date: <?php echo $admission_Date; ?><br>
			Discharge Date: <input type="text" name="discharge_Date" value=<?=$discharge_Date;?> style="width: 150px;"><br>
			Bed Number: <?=$bed_Number; ?><br>
			Staff Name: <?=$staff_Name; ?><br>
			<input type=HIDDEN name="doctor_ID" value=<?=$user_id;?>>
			<input type=HIDDEN name="admission_ID" value=<?=$admission;?>>
			<input type=HIDDEN name="admission_Date" value=<?=$admission_Date;?>>
			<div style="float:left;">
				<button name="edit" type="submit" value="Submit">Submit</button>
				<input name="cancel" type="button" value="Cancel" onClick="document.location.href='doctor_Discharge.php'" />
			</div>
		</form>
		<input type="button" value="Logout" onClick="location.href='logout.php'" />
	</div>
</body>
</html>