<?php

require("connect-db.php");
require("pokemon-db.php");

session_start();

//error_reporting(0);

#if not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

$profile_info = getNurseProfileInfo($_SESSION['user']['nurse_ID']);
$phone_numbers = getNursePhoneNumbers($_SESSION['user']['nurse_ID']);
$specialities = getNurseSpecialties($_SESSION['user']['nurse_ID'])

?>

<!DOCTYPE html>
<html>
    <head>
        
    
    </head>

    <body>
        <a href="myprofile.php">My Profile</a>
        <a href="patient-search.php">Patient Search</a>
        <a href="add-patient.php">Add New Patient</a>
        <a href="logout.php">Logout</a>
        
        <h3> My Profile </h3>
        <p>First Name: <?php echo $profile_info['name_first']; ?> </p>
        <p>Last Name: <?php echo $profile_info['name_last']; ?> </p>
        <p>Nurse ID: <?php echo $profile_info['nurse_ID']; ?> </p>
        <p>Phone number(s):
            <?php
            //if the nurse has more than 1 number
            if (is_array($phone_numbers[0])) {
                $phone_array = array();
                foreach ($phone_numbers as $phone_number):
                    array_push($phone_array, $phone_number[0]);
                endforeach;
                echo implode(",", $phone_array);
            } else { // if the nurse only has one phone number
                echo $phone_numbers[0];
            }
            ?>

        </p>
        <p>Specialties:
        <?php
            //if the nurse has more than 1 specialty
            if (is_array($specialities[0])) {
                $specialty_array = array();
                foreach ($specialities as $specialty):
                    array_push($specialty_array, $specialty[0]);
                endforeach;
                echo implode(", ", $specialty_array);
            } else { // if the nurse only has one specialty
                echo $specialities[0];
            }
            ?>
        </p>
    </body>
</html>
