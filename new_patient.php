<?php
ob_start();
include('session.php');
if (isset($_POST['new_patient'])) {

        if (($_POST['age'])!="") {
            $age = $_POST['age'];
            if (!preg_match("/^[0-9]{2}$/", $age)) {
                $ageErr = "Error in age input";
            }
        }
        if (($_POST['phone'])!="") {
            $contact = $_POST['phone'];
            //echo $contact;
            if (!(preg_match("/[^0-9]{10}$/", $contact))) {
                $contactErr = "Only numbers allowed";
            }
        }
        if (($_POST['address'])!="") {
            $address = $_POST['address'];
            $regex = '/^[A-Za-z0-9\-\\,.]+$/';
            if (!preg_match($regex, $address)) {
                $addressErr = "Invalid Address";
            }
        }
        if (($_POST['name'])!="") {
            $name = $_POST['name'];

            if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                echo "in here";
                $nameErr = "Only letters and white space allowed";
                // echo $nameErr;
            }
        }
        if (($_POST['email'])!="") {

            $email = $_POST['email'];

            $email = test_input($_POST["email"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Invalid email format";
            }
        }


    if (($_POST['insurance_id'])!="") {

        $insuranceID = $_POST['insurance_id'];
        $regex = '/^[A-Za-z0-9]+$/';
        if(!preg_match($regex, $insuranceID)){
            $insuranceIDErr = "Invalid Insurance ID";
        }
    }

    if (($_POST['insurance_Company'])!="") {
        $insuranceCompany = $_POST['insurance_Company'];

        $regex = '/^[A-Za-z0-9]+$/';
        if (!preg_match($regex, $insuranceCompany)) {
            $insuranceCompErr = "Invalid Insurance Company Name";
        }
    }

    if (($_POST['diagnosis'])!="") {
        $diagnosis = $_POST['diagnosis'];
        $regex = '/^[A-Za-z0-9\-\\,.]+$/';
        if (!preg_match($regex, $diagnosis)) {
            $diagnosisErr = "Invalid characters not allowed";
        }
    }

    if (($_POST['drugs'])!="") {
        $drugs = $_POST['drugs'];
        $regex = '/^[A-Za-z0-9\-\\,.]+$/';
        if (!preg_match($regex, $drugs)) {
            $drugsErr = "Invalid characters not allowed";
        }
    }


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
						    	$cnum = $row['COUNT(*)'];
						    	$cnum = (intval($cnum)+1);
						    	$datetime=new DateTime('NOW');
			    				$datetime=$datetime->format('Y-m-d');
						    	$query="INSERT INTO prescription VALUES('c".$cnum;
		    	$query.="', '$datetime', '".$_POST['diagnosis']."',";
			    $query.=" '".$_POST['drugs']."', '".$_POST['insurance_Company']."',";
			    $query.=" '".$_POST['insurance_id']."', '$user_id', 'p".$num."');";
			    $result=mysql_query($query);
								if ($result === FALSE) {
									$error="Some error";
								} else {
									$query="SELECT COUNT(*) FROM discharge_sheet;";
	    							$result=mysql_query($query);
								    if ($result === FALSE) {
								    	$error="Can't retrieve list";
								    } else {
								    	if($row = mysql_fetch_assoc($result)){
									    	$anum = $row['COUNT(*)'];
									    	$anum = (intval($anum)+1);
										    $discharge=new DateTime('NOW');
											$discharge->modify('+5 day');
											$discharge = $discharge->format('Y-m-d');
											$query="INSERT INTO discharge_sheet VALUES('a". $anum."', 'p" . $num . "', '" . $datetime . "', '".$discharge."', ".$_POST['bed'].", '$user_id', '".$_POST['nurse']."');";
											$result=mysql_query($query);
											if ($result === FALSE) {
												$error="Some error";
											} else {
												header("location: profile.php");
											}
										}
									}
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
	}
else {
		$error="Name, Email, Address, Phone or Age cannot be blank";
	}
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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
                        <table  style="width:70%">
                            <tr>
                                <td align=left width = "25%" ><font size=5>Patient Name:  </font></td>
                                <td align=left width = "45%"><input type="text" name="name" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$nameErr;?></span>
                                </td>
                                </tr>
                            <tr>
                                <td align=left width = "25%" ><font size=5>Address:  </font></td>
                                <td align=left width = "45%"><input type="text" name="address" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$addressErr;?></span>
                                </td>
                            </tr>
                            <tr>
                                <td align=left width = "25%" ><font size=5>Email:  </font></td>
                                <td align=left width = "45%"><input type="text" name="email" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$emailErr;?></span>
                                </td>
                            </tr>
                            <tr>
                                <td align=left width = "25%" ><font size=5>Phone: </font> </td>
                                <td align=left width = "45%"><input type="text" name="phone" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$contactErr;?></span>
                                </td>
                            </tr>
                            <tr>
                                <td align=left width = "25%" ><font size=5>Age: </font> </td>
                                <td align=left width = "45%"><input type="number" name="age" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$ageErr;?></span>
                                </td>
                            </tr>
                            <tr>
                                <td align=left width = "25%" ><font size=5>Diagnosis: </font> </td>
                                <td align=left width = "45%"><input type="text" name="diagnosis" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$diagnosisErr;?></span>
                                </td>
                            </tr
                            <tr>
                                <td align=left width = "25%" ><font size=5>Drugs: </font> </td>
                                <td align=left width = "45%"><input type="text" name="drugs" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$drugsErr;?></span>
                                </td>
                            </tr
                            <tr>
                                <td align=left width = "25%" ><font size=5>Insurance Company: </font> </td>
                                <td align=left width = "45%"><input type="text" name="insurance_Company" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$insuranceCompErr;?></span>
                                </td>
                            </tr>
                            <tr>
                                <td align=left width = "15%" ><font size=5>Insurance ID: </font> </td>
                                <td align=left width = "35%"><input type="text" name="insurance_id" style="width: 150px;">
                                    <span class="error"> <?php echo "*".$insuranceIDErr;?></span>
                                </td>
                            </tr>
                            <tr>
                            	<td align=left width = "15%" ><font size=5>Nurse: </font> </td>
                            	<td align=left width = "35%"><SELECT NAME="nurse" style="
	        margin-top: 15px;
            border:2px solid #FFCB00;
            padding:10px;
            font-size:20px;
            cursor:pointer;
            border-radius:5px;
            margin-bottom:15px" >

            		<?php
            		
            			$query="SELECT staff_ID, staff_Name FROM staff WHERE";
            			$query.=" designatoin='NURSE';";
            			$result = mysql_query($query);
			            if ($result === FALSE) {
            			    die(mysql_error());
			            }
			            while ($row = mysql_fetch_assoc($result)) {
			            	echo '<option   value="'.$row["staff_ID"].'">'.ucwords($row["staff_Name"]).'</option>';
						}
						?>
				</SELECT></td>
							</tr>
							
							<tr>
                                <td align=left width = "15%" ><font size=5>Bed No: </font> </td>
                                <td align=left width = "35%"><input type="text" name="bed" style="width: 150px;"></td>
                            </tr>

                        </table>
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