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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
        <!-- navbar-->
        <ul>
            <li><a class="active" href="pokemonform.php">Home</a></li>
            <li><a href="myprofile.php">My Profile</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
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
