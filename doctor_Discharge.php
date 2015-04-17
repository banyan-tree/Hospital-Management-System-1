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
    <p align="right">
        <input type="button" value="Logout" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px"  onClick="location.href='logout.php'" />
    </p>
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


            // DEFINE our cipher
            define('AES_256_CBC', 'aes-256-cbc');
// Create some data to encrypt
            $data1 = $admission_ID;
            $data2 = $user_id;

//            echo "Before admission_ID: $data1\n";
//            echo "Before user_id: $data2\n";
//            echo "\n****encryption_key****".$encryption_key;
//            echo "\n****iv****".$iv;


// Encrypt $data using aes-256-cbc cipher with the given encryption key and
// our initialization vector. The 0 gives us the default options, but can
// be changed to OPENSSL_RAW_DATA or OPENSSL_ZERO_PADDING
            $encrypted1 = openssl_encrypt($data1, AES_256_CBC, $encryption_key, 0, $iv);
           // echo "Encrypted1: $encrypted1\n";
            $encrypted2 = openssl_encrypt($data2, AES_256_CBC, $encryption_key, 0, $iv);
           // echo "Encrypted2: $encrypted2\n";

// If we lose the $iv variable, we can't decrypt this, so append it to the
// encrypted data with a separator that we know won't exist in base64-encoded
// data
            $encrypted1 = $encrypted1 . ':' . $iv;
            $encrypted2 = $encrypted2 . ':' . $iv;

          //  echo "Encrypted11: $encrypted1\n";
          //  echo "Encrypted22: $encrypted2\n";

            ?><p><?php

            echo "<b>Name: $name</b><br>Admission Date: $date_admission<br>Discharge Date: $discharge_Date<br>Bed Number: $bed_Number<br>Staff Name: $staff_Name<br>";

            ?></p>

            <form method="POST" action="edit_discharge_info.php">

                <input type="HIDDEN" name="admission_ID" value=<?=$encrypted1?> />
                <input type="HIDDEN" name="doctor_ID" value=<?=$encrypted2?> />

<!--                <input type="HIDDEN" name="admission_ID" value=--><?//=$admission_ID?><!-- />-->
<!--                <input type="HIDDEN" name="doctor_ID" value=--><?//=$user_id?><!-- />-->
                <button type="submit" name="edit_discharge_info" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" value="Edit Discharge Date">Edit Discharge Date</button>
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
    <input type="button" value="Back" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px"  onClick="location.href='profile.php'" />

</div>
</body>
</html>