<?php
require("connect-db.php");
require("pokemon-db.php");
require("nurse-db.php");

session_start();
#if not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

$is_charge_nurse = isChargeNurse($_SESSION['user']['nurse_ID']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   if (!empty($_POST['exportBtn']))
   {
    exportHealthRecords($_POST['pokemon_ID_export'], $_POST['pokemon_name_export']);
   }
}

if (isset($_GET['id'])) {
    $pokemonId = $_GET['id'];
    $pokemon = getPokemonInfo($pokemonId);
    $trainer = getTrainerInfo($pokemon[0]['trainer_ID']);
    $nurse = getNurseName($pokemon[0]['nurse_ID']);

} else {
    echo 'No Pokémon ID specified';
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">
  <style>
        #exportBtn {
            top: 80px;
            right: 80px;
            padding: 10px;
            background-color: #3498db;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
  <title>Pokemon Hospital Clinic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="styles.css">
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>


<!-- navbar -->
<ul>
  <li><a class="active" href="pokemonform.php">Home</a></li>
  <li><a href="myprofile.php">My Profile</a></li>
  <li><a href="patient-search.php">Patient Search</a></li>
  <?php if ($is_charge_nurse[0]) : ?>
    <li><a href="nursesearch.php">Nurse Search</a></li>
  <?php endif; ?>
  <li><a href="nurse.php">Nurse</a></li>
  <li><a href="add-patient.php">Add Patient</a></li>
  <li><a href="logout.php">Logout</a></li>
</ul>

<div class="container">
  <h1>Pokemon Hospital Clinic</h1>
  <h2>Patient Profile</h2>

  <form action="pokemon_details.php" method="post">
    <input type="hidden" name="pokemon_ID_export" value="<?php echo $pokemon[0]['pokemon_ID']; ?>"/>
    <input type="hidden" name="pokemon_name_export" value="<?php echo $pokemon[0]['name']; ?>"/>
    <input type="submit" value="Export Patient Health Records" name="exportBtn" id="exportBtn" class="btn btn-secondary"/>
</form>

  <?php
  if (!empty($pokemon)) {
    ?>
    <h3><?php echo $pokemon[0]['name']; ?></h3>
    <p>Nurse: <?php echo $pokemon[0]['nurse_ID']; ?> </p>
    <p>Trainer: <?php echo $pokemon[0]['trainer_ID']; ?> </p>
    <p>Weight: <?php echo $pokemon[0]['weight']; ?> lbs</p>
    <p>Type: <?php echo $pokemon[0]['type']; ?> </p>
    <p>Date of Birth: <?php echo $pokemon[0]['date_of_birth']; ?> </p>
    <p>Last visit: <?php echo $pokemon[0]['last_visit']; ?> </p>
    <p>Insurance: <?php echo $pokemon[0]['insurance']; ?> </p>
    <p>Allergies: <?php echo $pokemon[0]['allergies']; ?> </p>
    <p>Illnesses: <?php echo $pokemon[0]['illnesses']; ?> </p>
    <p>Injuries: <?php echo $pokemon[0]['injuries']; ?> </p>
    <p>Medications: <?php echo $pokemon[0]['medications']; ?> </p>

    <?php
    } else {
        echo "No information available for the given Pokemon ID.";
  }?>

  <?php
  if (!empty($trainer)) {
    ?>
    <h3>Trainer:</h3>
    <h4><?php echo $trainer[0]['name_first'] . " " . $trainer[0]['name_last']; ?></h4>
    <p>Date of Birth: <?php echo $trainer[0]['date_of_birth']; ?> </p>
    <p>Email: <?php echo $trainer[0]['email']; ?> </p>
    <p>Phone: <?php echo $trainer[0]['phone_number']; ?> </p>
    <?php
    } else {
        echo "No trainer information available for the given Pokemon ID.";
  }?>

  <?php
  if (!empty($trainer)) {
    ?>
    <h3>Assigned Nurse: </h3>
    <p><?php echo $nurse[0]['name_first'] . " " . $nurse[0]['name_last']; ?> </p>
    <?php
    } else {
        echo "No nurse information available for the given Pokemon ID.";
  }?>

  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- for local -->
  <!-- <script src="script.js"></script>  -->

</div>

</body>
</html>



