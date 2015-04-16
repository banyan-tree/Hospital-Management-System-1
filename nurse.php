<?php
if (isset($_POST['admission_ID'])) {
    $query="DELETE FROM discharge_sheet where admission_ID = '";
    $query.=$_POST['admission_ID'] . "';";
    $result = mysql_query($query);

	if (!$result) {
        die("Update query failed." . mysql_error() . $query);
	} else {
    	header("location: profile.php");
	}
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <b><center>Database Output</center></b><br><br>
	<?php
    	////*****NURSE******\\\\\\\\
	    if (strcmp($login_session_role, "NURSE")  == 0){
	?>
	    	
	    	<button type="submit" value="Add Patient" onClick="document.location.href='new_patient.php'">Add Staff</button>
	    	<hr>
	    	<?php
	    
        	$query="SELECT admission_ID, patient_name,";
        	$query.=" DATE_FORMAT(admission_Date, '%Y-%m-%d'),";
        	$query.=" DATE_FORMAT(discharge_Date, '%Y-%m-%d'), bed_Number,";
        	$query.=" doctor FROM test.nurse_patient_discharge,test.login";
        	$query.=" where test.login.username = '$login_session_user' and";
        	$query.=" login.unique_ID = nurse_patient_discharge.incharge;";

        	$result = mysql_query($query);
	        if ($result === FALSE) {
    	        die("Error getting Nurse info\n" . mysql_error());
	        }

    	    $num = mysql_numrows($result);
	        $i = 0;
    	    while ($i < $num) {
	            $admission_ID = mysql_result($result,$i,"admission_ID");
    	        $name = mysql_result($result, $i, "patient_name");
        	    $admission_Date = mysql_result($result, $i, "DATE_FORMAT(admission_Date, '%Y-%m-%d')");
            	$date = mysql_result($result, $i, "DATE_FORMAT(discharge_Date, '%Y-%m-%d')");
	            $bed_Number = mysql_result($result, $i, "bed_Number");
    	        $doctor = mysql_result($result, $i, "doctor");
	            ?><p><?php
	            echo "<b>Admission ID: $admission_ID</b><br>Name: $name<br>Admission_Date: $admission_Date<br>Discharge Date: $date<br>Bed Number: $bed_Number<br>Doctor: $doctor<br>";

    	        $datetime1 = new DateTime($date);
        	    $datetime2 = new DateTime('NOW');
            	$interval = date_diff($datetime1, $datetime2);
	
	            if (strcmp($interval->format('%a'),'0') == 0) {
    	            ?>
					<form method="POST" action="">
						<input type="HIDDEN" name="admission_ID" value=<?=$admission_ID?> />
						<button type="submit" name="submit" value="Discharge">Discharge</button>
					</form>
       				</p><?php
	            }
            	?><hr><?php
	            $i++;
    	    }
    	}
		?>
</body>
</html>