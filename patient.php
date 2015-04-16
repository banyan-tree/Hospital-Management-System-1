<!DOCTYPE html>
<html>
<head>
    <title>Personal Info</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<?php
if (strcmp($login_session_role, "PATIENT")  == 0){
    $query="SELECT patient_ID, patient_name, patient_Age, patient_address, patient_Email_ID, patient_Contact, diagnosis, drugs, staff_Name, insurance_Company, insurance_ID FROM test.personal_info, test.login             where test.login.username = '$login_session_user' and login.unique_ID = personal_info.patient_ID;";
    $result = mysql_query($query);
    if ($result === FALSE) {
        die(mysql_error()); // TODO: better error handling
    }
    
    $num = mysql_numrows($result);
    $i = 0;
    echo "<b>Personal Data</b><br><br>";
    if ($num > 1) {
        die("More than 1 user returned");
    } else {
        $name = mysql_result($result, $i, "patient_name");
        $age = mysql_result($result, $i, "patient_Age");
        $email = mysql_result($result, $i, "patient_Email_ID");
        $contact = mysql_result($result,$i,"patient_Contact");
        $address = mysql_result($result, $i, "patient_address");
        $diag = mysql_result($result, $i, "diagnosis");
        $drugs = mysql_result($result, $i, "drugs");
        $staff_Name = mysql_result($result, $i, "staff_Name");
        $insurance_Company = mysql_result($result, $i, "insurance_Company");
        $insurance_ID = mysql_result($result,$i,"insurance_ID");
        $patient_ID = mysql_result($result,$i,"patient_ID");
    }
}
?>
	Name: <?php echo $name;?><br>
    Age: <?php echo $age;?> <br>
    Email: <?php echo $email;?> <br>
    Contact: <?php echo $contact;?> <br>
    Address: <?php echo $address;?> <br>
    Diagnosis: <?php echo $diag; ?><br>
    Drugs: <?php echo $drugs; ?><br>
    Doctor's Name: <?php echo $staff_Name; ?><br>
    Insurance Company: <?php echo $insurance_Company; ?><br>
    Insurance ID: <?php echo $insurance_ID; ?><br>
    <input type="button" value="Update Personal Info"  id="logout" style="float: left" onClick="document.location.href='patient1.php'"  />
</div>
</body>
</html>