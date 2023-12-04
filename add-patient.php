<!--https://stackoverflow.com/questions/3512507/proper-way-to-logout-from-a-session-in-php-->

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

$list_of_pokemon = getAllPokemon();

$list_of_trainers = getAllTrainers();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

   if (!empty($_POST['addBtn']))
   {
      addPokemon($_POST['pokemon_name'], $_POST['weight'], $_POST['type'], $_POST['date_of_birth'], $_POST['last_visit'], $_POST['insurance'], $_POST['trainer'], $_SESSION['user']['nurse_ID']);
      $list_of_pokemon = getAllPokemon();    
   }
   
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="your name">
  <meta name="description" content="include some description about your page">  
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
  <li><a href="add-patient.php">Add Patient</a></li>
  <li><a href="patient-search.php">Patient Search</a></li>
  <?php if ($is_charge_nurse[0]) : ?>
    <li><a href="nursesearch.php">Nurse Search</a></li>
  <?php endif; ?>
  <li><a href="logout.php">Logout</a></li>
</ul>

<div class="container">
  <div style="text-align: center;">
    <img src="photos\add-patient.png" height="300">
  </div>
  <!-- <a href="pokemonform.php">Click to open the next page</a> -->
 
  <form name="mainForm" action="add-patient.php" method="post">   
      <div class="row mb-3 mx-3">
        Pokemon name:
        <input type="text" class="form-control" name="pokemon_name" required value="<?php echo $_POST['pokemon_name_to_update'];?>"/>        
      </div>
      <div class="row mb-3 mx-3">
        Weight:
        <input type="number" class="form-control" name="weight" required value="<?php echo $_POST['weight_to_update'];?>"/>        
      </div>  
      <div class="row mb-3 mx-3">
        Type:
        <input type="text" class="form-control" name="type" required value="<?php echo $_POST['type_to_update'];?>"/>        
      </div>  
      <div class="row mb-3 mx-3">
        Date of Birth:
        <input type="date" class="form-control" name="date_of_birth" required value="<?php echo $_POST['date_of_birth_to_update'];?>"/>        
      </div>
      <div class="row mb-3 mx-3">
        Last Visit:
        <input type="date" class="form-control" name="last_visit" required value="<?php echo $_POST['last_visit_to_update'];?>"/>        
      </div>  
      <div class="row mb-3 mx-3">
        Insurance:
        <input type="text" class="form-control" name="insurance" required value="<?php echo $_POST['insurance_to_update'];?>"/>        
      </div>
      <div class="row mb-3 mx-3">
        Trainer:
        <select name="trainer">
        <?php foreach ($list_of_trainers as $trainer): ?>
            <option required value="<?php echo $trainer["trainer_ID"];?>">
            <?php echo $trainer["name_first"];?> <?php echo $trainer["name_last"];?>
            </option>
        <?php endforeach; ?>
        </select>
      </div>
      <div class="row mb-3 mx-3">
        <input type="submit" value="Add Patient" name="addBtn" 
                class="btn btn-primary" title="Add a patient to the pokemon health center" />
      </div>
    </form>     

<hr/>


</div>

  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  <!-- for local -->
  <!-- <script src="script.js"></script>  -->
  
</div> 
  
</body>
</html>