<?php
include('session.php');

if (isset($_POST['hero'])) {
    $id = $_POST['patient_ID'];
    if (($_POST['age'])!="") {
        $age = $_POST['age'];
            //MySqli Update Query
            $db = new mysqli('localhost', 'root', 'infinite', 'test');
            $sql = <<<SQL
    UPDATE `patient_record`
    SET `patient_Age` = $age
    WHERE `patient_ID`='$id';

SQL;

            if (!$result = $db->query($sql)) {
                die('There was an error running the query [' . $db->error . ']');
            } else
                header("location: profile.php");
        }

 if (($_POST['contact'])!="") {
     $contact = $_POST['contact'];
        //MySqli Update Query
        $db = new mysqli('localhost', 'root', 'infinite', 'test');
        $sql = <<<SQL
    UPDATE `patient_record`
    SET `patient_Contact` = $contact
    WHERE `patient_ID`="$id";

SQL;

        if (!$result1 = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        } else
            header("location: profile.php");
    }

    if (($_POST['address'])!="") {
        $address = $_POST['address'];
        //MySqli Update Query
        $db = new mysqli('localhost', 'root', 'infinite', 'test');
        $sql = <<<SQL
        UPDATE `patient_record`
        SET `patient_address` = '$address'
        WHERE `patient_ID`= '$id';

SQL;

        if (!$result1 = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        } else
            header("location: profile.php");
    }

    if (($_POST['name'])!="") {
        $name = $_POST['name'];
        //MySqli Update Query
        $db = new mysqli('localhost', 'root', 'infinite', 'test');
        $sql = <<<SQL
        UPDATE `patient_record`
        SET `patient_name` = '$name'
        WHERE `patient_ID`= '$id';

SQL;

        if (!$result1 = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        } else
        	header("location: profile.php");
    }

    if (($_POST['email'])!="") {

        $email = $_POST['email'];
        //MySqli Update Query
        $db = new mysqli('localhost', 'root', 'infinite', 'test');
        $sql = <<<SQL
        UPDATE `patient_record`
        SET `patient_Email_ID` = '$email'
        WHERE `patient_ID`= '$id';

SQL;

        if (!$result1 = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        } else
            header("location: profile.php");
    }

    if (($_POST['insuranceID'])!="") {

        $insuranceID = $_POST['insuranceID'];
        //MySqli Update Query
        $db = new mysqli('localhost', 'root', 'infinite', 'test');
        $sql = <<<SQL
        UPDATE `prescription`
        SET `insurance_ID` = '$insuranceID'
        WHERE `patient_ID`= '$id';

SQL;

        if (!$result1 = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        } else
            header("location: profile.php");
    }

    if (($_POST['insuranceCompany'])!="") {

        $insuranceCompany = $_POST['insuranceCompany'];
        //MySqli Update Query
        $db = new mysqli('localhost', 'root', 'infinite', 'test');
        $sql = <<<SQL
        UPDATE `prescription`
        SET `insurance_Company` = '$insuranceCompany'
        WHERE `patient_ID`= '$id';

SQL;

        if (!$result1 = $db->query($sql)) {
            die('There was an error running the query [' . $db->error . ']');
        } else
            header("location: profile.php");
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
    <?php
    if (strcmp($login_session_role, "PATIENT") == 0) {
        $query = "SELECT patient_ID, patient_name, patient_Age, patient_address, patient_Email_ID, patient_Contact, diagnosis, drugs, staff_Name, insurance_Company, insurance_ID FROM test.personal_info, test.login             where test.login.username = '$login_session_user' and login.unique_ID = personal_info.patient_ID;";
        $result = mysql_query($query);
        if ($result === FALSE) {
            die(mysql_error()); // TODO: better error handling
        }
        $num = mysql_numrows($result);
        $i = 0;
        echo "<b><center>Update Profile</center></b><br><br>";
        if ($num > 1) {
            die("More than 1 user returned");
        } else {
            $name = mysql_result($result, $i, "patient_name");
            $age = mysql_result($result, $i, "patient_Age");
            $email = mysql_result($result, $i, "patient_Email_ID");
            $contact = mysql_result($result, $i, "patient_Contact");
            $address = mysql_result($result, $i, "patient_address");
            $diag = mysql_result($result, $i, "diagnosis");
            $drugs = mysql_result($result, $i, "drugs");
            $staff_Name = mysql_result($result, $i, "staff_Name");
            $insurance_Company = mysql_result($result, $i, "insurance_Company");
            $insurance_ID = mysql_result($result, $i, "insurance_ID");
            $patient_ID = mysql_result($result, $i, "patient_ID");
        }
    }
    ?>
    <form name="form" action="" method="post">
        Name: <input type="text" name="name" placeholder=<?php echo $name; ?> style="width: 150px;"><br>
        Age: <input type="text" name="age" placeholder=<?php echo $age; ?> style="width: 150px;"><br>
        Email: <input type="text" name="email" placeholder=<?php echo $email; ?> style="width: 150px;"><br>
        Contact: <input type="text" name="contact" placeholder=<?php echo $contact; ?> style="width: 150px;"><br>
        Address: <input type="text" name="address" placeholder=<?php echo $address; ?> style="width: 150px;"><br>
        Insurance Company: <input type="text" name="insuranceCompany"
                                  placeholder=<?php echo $insurance_Company; ?> style="width: 150px;" ><br>
        Insurance ID: <input type="text" name="insuranceID" placeholder=<?php echo $insurance_ID; ?> style="width: 150px;" >
        <br>
        <input type=HIDDEN name="patient_ID" value=<?php echo $patient_ID; ?>>
        <input name="hero" type="submit" value="Submit" style="width: 100px;">
        <input type="button" value="Back"  id="logout" style="float: right" onClick="document.location.href='profile.php'"  />
    </form>

    <b id="logout"><a href="logout.php">Log Out</a></b>
</div>
</body>
</html>