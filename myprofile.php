<?php

require("connect-db.php");
require("pokemon-db.php");
require("nurse-db.php");

session_start();

error_reporting(0);

#if not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

$is_charge_nurse = isChargeNurse($_SESSION['user']['nurse_ID']);
$profile_info = getNurseProfileInfo($_SESSION['user']['nurse_ID']);
$phone_numbers = getNursePhoneNumbers($_SESSION['user']['nurse_ID']);
$specialities = getNurseSpecialties($_SESSION['user']['nurse_ID']);
$assigned_pokemon = getAssignedPokemon($_SESSION['user']['nurse_ID']);


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   if (!empty($_POST['deleteBtn']))
   {
    deletePokemonByID($_POST['pokemonID_to_delete']);
    $assigned_pokemon = getAssignedPokemon($_SESSION['user']['nurse_ID']);
   }
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">  
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="styles.css">
    </head>

    <body>
    <!-- navbar -->
    <ul>
        <li><a class="active" href="pokemonform.php">Home</a></li>
        <li><a href="myprofile.php">My Profile</a></li>
        <li><a href="add-patient.php">Add Patient</a></li>
        <li><a href="patient-search.php">Patient Search</a></li>
        <?php if ($is_charge_nurse[0]) : ?>
            <li><a href="nursesearch.php">Nurse Search</a></li>
        <?php endif; ?>
        <li><a href="logout.php">Logout</a></li>
    </ul>


    
    <div class="container">
        <div style="text-align: center;">
        <img src="photos\myprofile.png" height="300">
        </div>
        <br>
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
    </div>
    <br>
    <div class="container">
        <h3>My Patients</h3>
        <div class="row ">
        <table class="w3-table w3-bordered w3-card-4 center" style="width:70%">
        <thead>
        <tr style="background-color:#B0B0B0">

            <!--<th width="30%">Name-->
            <th>ID
            <th>Name
            <th>Weight
            <th>Type
            <th>Date of Birth
            <th>Last Visit
            <th>Insurance
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        </thead>

        <?php foreach ($assigned_pokemon as $pokemon): ?>
        <tr>
            <td><?php echo $pokemon['pokemon_ID']; ?></td>
            <td><?php echo $pokemon['name']; ?></td>
            <td><?php echo $pokemon['weight']; ?></td>
            <td><?php echo $pokemon['type']; ?></td>
            <td><?php echo $pokemon['date_of_birth']; ?></td>
            <td><?php echo $pokemon['last_visit']; ?></td>
            <td><?php echo $pokemon['insurance']; ?></td>
            <td>

                <form action="pokemonform.php" method="post">
                <input type="hidden" name="pokemon_ID_to_update" value="<?php echo $pokemon['pokemon_ID']; ?>"/>
                <input type="hidden" name="pokemon_name_to_update" value="<?php echo $pokemon['name']; ?>"/>
                <input type="hidden" name="weight_to_update" value="<?php echo $pokemon['weight']; ?>"/>
                <input type="hidden" name="type_to_update" value="<?php echo $pokemon['type']; ?>"/>
                <input type="hidden" name="date_of_birth_to_update" value="<?php echo $pokemon['date_of_birth']; ?>"/>
                <input type="hidden" name="last_visit_to_update" value="<?php echo $pokemon['last_visit']; ?>"/>
                <input type="hidden" name="insurance_to_update" value="<?php echo $pokemon['insurance']; ?>"/>
                </form>
            <td>
            
            
            <form action="myprofile.php" method="post">
                <input type="submit" value="Delete" name="deleteBtn" class="btn btn-danger"/>
                <input type="hidden" name="pokemonID_to_delete" value="<?php echo $pokemon['pokemon_ID']; ?>"/>
            </form>
            
            </td>
        </tr>
        <?php endforeach; ?>

        </table>
        </div>
    </div>
    </body>
</html>
