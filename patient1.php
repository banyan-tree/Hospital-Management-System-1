<?php
include('session.php');

// define variables and set to empty values
$nameErr = $emailErr  = $contactErr = $ageErr = $addressErr = $insuranceCompErr = $insuranceIDErr = "" ;
$name = $email = $gender = $comment = $website = "";

if (isset($_POST['hero'])) {
    $id = $_POST['patient_ID'];
    $age=$_POST['age'];
    if (($_POST['age'])!="") {
        $age = $_POST['age'];
        if(!preg_match("/^[0-9]{2}$/", $age)) {
            $ageErr = "Error in age input";
        }

        else {
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
    }

 if (($_POST['contact'])!="") {
     $contact = $_POST['contact'];
     echo $contact;
     if((preg_match("/[^0-9]{10}$/", $contact))) {
         $contactErr = "Only numbers allowed";
     }
     else {
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
    }

    if (($_POST['address'])!="") {
        $address = $_POST['address'];
        $regex = '/^[A-Za-z0-9\-\\,.]+$/';
        if(!preg_match($regex, $address)){
            $addressErr = "Invalid Address";
        }
        else {

            //MySqli Update Query
            $db = new mysqli('localhost', 'root', 'infinite', 'test');
            $sql = <<<SQL
            echo "id is --" .$id;
        UPDATE `patient_record`
        SET `patient_address` = '$address'
        WHERE `patient_ID`= '$id';

SQL;

            if (!$result1 = $db->query($sql)) {
                die('There was an error running the query [' . $db->error . ']');
            } else
                header("location: profile.php");
        }
    }

    if (($_POST['name'])!="") {
        $name = $_POST['name'];
        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
           // echo $nameErr;
        }
//        elseif(strcmp($_POST['name']{
//
//        }
        else{
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

    }

    if (($_POST['email'])!="") {

        $email = $_POST['email'];

        $email = test_input($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
        else {
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


function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


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
    <p align="right">
        <button type="submit" value="Reset Password" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="document.location.href='reset.php'">Reset Password</button>
        <input align="right" type="button" value="Logout" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="location.href='logout.php'" />
    </p>
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
            echo $name;
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
    <form name="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        Name: <input type="text" name="name" placeholder=<?php echo $name; ?> style="width: 200px;">
        <span class="error"> <?php echo "*".$nameErr;?></span>
        <br>
        Age: <input type="text" name="age" placeholder=<?php echo $age; ?> style="width: 150px;">
        <span class="error"> <?php echo "*".$ageErr;?></span>
        <br>
        Email: <input type="text" name="email" placeholder=<?php echo $email; ?> style="width: 150px;">
        <span class="error"> <?php echo "*".$emailErr;?></span>
        <br>
        Contact: <input type="text" name="contact" placeholder=<?php echo $contact; ?> style="width: 150px;">
        <span class="error"> <?php echo "*".$contactErr;?></span>
        <br>
        Address: <input type="text" name="address" placeholder=<?php echo $address; ?> style="width: 150px;">
        <span class="error"> <?php echo "*".$addressErr;?></span>
        <br>
        Insurance Company: <input type="text" name="insuranceCompany"
                                  placeholder=<?php echo $insurance_Company; ?> style="width: 150px;" >
        <span class="error"> <?php echo "*".$insuranceCompErr;?></span>
        <br>
        Insurance ID: <input type="text" name="insuranceID" placeholder=<?php echo $insurance_ID; ?> style="width: 150px;" >
        <span class="error"> <?php echo "*".$insuranceIDErr;?></span>
        <br>
        <input type=HIDDEN name="patient_ID" value=<?php echo $patient_ID; ?> >
         <input name="hero" type="submit" value="Submit" style="width: 100px;">
        <input type="button" value="Back"  id="logout" style=" background-color:#FFBC00; color:#fff;
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" onClick="document.location.href='profile.php'"  />
    </form>
</div>
</body>
</html>