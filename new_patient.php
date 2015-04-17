<?php

include('session.php');
if (isset($_POST['new_patient'])) {

    if (($_POST['age'])!="") {
        $age = $_POST['age'];
        if(!preg_match("/^[0-9]{2}$/", $age)) {
            $ageErr = "Error in age input";
        }
    }
//
//    if (($_POST['phone'])!="") {
//        $contact = $_POST['phone'];
//        //echo $contact;
//        if((preg_match("/[^0-9]{10}$/", $contact))) {
//            echo "wrong phone";
//            $contactErr = "Only numbers allowed";
//        }
//    }
//
//    if (($_POST['address'])!="") {
//        $address = $_POST['address'];
//        $regex = '/^[A-Za-z0-9\-\\,.]+$/';
//        if(!preg_match($regex, $address)){
//            $addressErr = "Invalid Address";
//        }
//    }
//
//    if (($_POST['name'])!="") {
//        $name = $_POST['name'];
//        if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
//            $nameErr = "Only letters and white space allowed";
//            // echo $nameErr;
//        }
//    }
//
//    if (($_POST['email'])!="") {
//
//        $email = $_POST['email'];
//
//        $email = test_input($_POST["email"]);
//        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//            $emailErr = "Invalid email format";
//        }
//    }

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
			    $query="INSERT INTO patient_record VALUES('p".(intval($num)+1);
		    	$query.="', '".$_POST['name']."', '".$_POST['address']."',";
			    $query.=" '".$_POST['email']."', '".$_POST['phone']."',";
			    $query.=" '".$_POST['age']."');";
			    $result=mysql_query($query);
				if ($result === FALSE) {
					$error="Some error";
				} else {
					$query="INSERT INTO login values('".md5($_POST['name']);
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
	    if (strcmp($login_session_role, "NURSE")  == 0){
	?>
			<form name="form" action="" method="post">
                NEW PATIENT <br>

		        Patient Name: <input type="text" name="name" style="width: 150px;">
                <span class="error"> <?php echo "*".$nameErr;?></span>
                <br>
		        Address: <input type="text" name="address" style="width: 150px;">
                <span class="error"> <?php echo "*".$addressErr;?></span>
                <br>
		        Email: <input type="text" name="email" style="width: 150px;">
                <span class="error"> <?php echo "*".$emailErr;?></span>
                <br>
		        Phone: <input type="number" name="phone" style="width: 150px;">
                <span class="error"> <?php echo "*".$contactErr;?></span>
                <br>
		        Age: <input type="number" name="age" style="width: 150px;">
                <span class="error"> <?php echo "*".$ageErr;?></span>
                <br>
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