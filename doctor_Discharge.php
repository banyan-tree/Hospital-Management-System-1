<?php
include('session.php');
include('header.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Discharge Info</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
    <b id="welcome">Welcome : <i><?php echo ucwords($user_name); ?></i></b>
    <b><center>Database Output</center></b><br><br>

    <?php

    ////*****DOCTOR******\\\\\\\\
    if (strcmp($login_session_role, "DOCTOR")  == 0){
        $query = "select admission_ID, patient_name, DATE_FORMAT(admission_Date, '%Y-%m-%d'), DATE_FORMAT(discharge_Date, '%Y-%m-%d'), bed_Number, staff_Name from doctor_patient_discharge where doctor_ID='$user_id';";

        $result = mysql_query($query);

        if ($result === FALSE) {
            die("Error getting Doctor info\n" . mysql_error());
        }

        $num = mysql_numrows($result);
        $i = 0;

        while ($i < $num) {
            $admission_ID = mysql_result($result, $i, "admission_ID");
            $name = mysql_result($result, $i, "patient_name");
            $date_admission = mysql_result($result, $i, "DATE_FORMAT(admission_Date, '%Y-%m-%d')");
            $discharge_Date = mysql_result($result, $i, "DATE_FORMAT(discharge_Date, '%Y-%m-%d')");
            $bed_Number = mysql_result($result, $i, "bed_Number");
            $staff_Name = mysql_result($result, $i, "staff_Name");

            ?><p><?php

            echo "<b>Name: $name</b><br>Admission Date: $date_admission<br>Discharge Date: $discharge_Date<br>Bed Number: $bed_Number<br>Staff Name: $staff_Name<br>";

            ?></p>

            <form method="POST" action="edit_discharge_info.php">
                <input type="HIDDEN" name="admission_ID" value=<?=$admission_ID?> />
                <input type="HIDDEN" name="doctor_ID" value=<?=$user_id?> />
                <button type="submit" name="edit_discharge_info" value="Edit Discharge Date">Edit Discharge Date</button>
            </form>

            <hr>

            <?php

            $i++;
        }
    } else {
        ?>
        <p>You do not have sufficient privileges</p>
    <?php
    }

    ?>
    <input type="button" value="Back" onClick="location.href='profile.php'" />
    <input type="button" value="Logout" onClick="location.href='logout.php'" />
</div>
</body>
</html>