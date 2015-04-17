<!DOCTYPE html>
<html>
<head>
    <title>Your Home Page</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">


    <p><?php


        if (strcmp($login_session_role, "DOCTOR") == 0) {
            $query = "select patient_name,patient_Age,patient_Email_ID,prescribed_Date,diagnosis,drugs
            from test.doctor_patient_info,test.login where test.login.username = '$login_session_user'
            and login.unique_ID = doctor_patient_info.staff_ID;";
            $result = mysql_query($query);
            if ($result === FALSE) {
                die(mysql_error());
            }
            $num = mysql_numrows($result);
            echo "<b><center>Patient's Information</center></b><br><br>";
            $i = 0;
            while ($i < $num) {
                $name = mysql_result($result, $i, "patient_name");
                $age = mysql_result($result, $i, "patient_Age");
                $email = mysql_result($result, $i, "patient_Email_ID");
                $date = mysql_result($result, $i, "prescribed_Date");
                $diag = mysql_result($result, $i, "diagnosis");
                $drugs = mysql_result($result, $i, "drugs");

                echo "<b>Patient's Name: $name</b><br>Age: $age<br>Email: $email<br>Prescription  Date: $date<br>Diagnosis: $diag<br>
            Drugs: $drugs<br><hr><br>";

                $i++;

            }
        }
        ////***********\\\\\\\\
     ?>
<div style="float: left">
    <button type="submit" value="Add Patient" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="document.location.href='new_patient.php'">Add Patient</button>
    <button type="submit" value="Discharge Info" name="d_info"  id="d_info" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onclick="document.location.href='doctor_Discharge.php'">Discharge Info</button>
    </div>
</div>
</body>
</html>