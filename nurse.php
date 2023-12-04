<?php
require("connect-db.php");
require("pokemon-db.php");

session_start();

error_reporting(0);

#if not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

$list_of_pokemon = getAllPokemon();


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

   if (!empty($_POST['deleteBtn']))
   {
    deletePokemonByID($_POST['pokemonID_to_delete']);
    $list_of_pokemon = getAllPokemon(); 
   }
   else if (!empty($_POST['addBtn']))
   {
      addPokemon($_POST['pokemon_name'], $_POST['weight'], $_POST['type'], $_POST['date_of_birth'], $_POST['last_visit'], $_POST['insurance']);
      $list_of_pokemon = getAllPokemon();    
   }
   else if (!empty($_POST['updateBtn']))
   {
      echo $_POST['pokemon_to_update'];
   }
   else if (!empty($_POST['confirmUpdateBtn']))
   {
    updatePokemonByID($_POST['pokemon_ID'], $_POST['name'], $_POST['weight'], $_POST['type'], $_POST['insurance']);
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
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
</head>

<body>


<h3>User: <?php echo $_SESSION['user']['username'] ?></h3>

<a href="myprofile.php">My Profile</a>
<a href="logout.php">Logout</a>

<div class="container">
  <h1>Pokemon Hospital Clinic</h1>  
  <h2>Nurse Landing Page</h2>  

  <div>
    <a href="patient-search.php" class="btn btn-primary">Patient Search</a>
    <a href="myprofile.php" class="btn btn-primary">My Profile</a>
    <a href="add-patient.php" class="btn btn-primary">Add New Patient</a>
  </div>

  <!-- <a href="pokemonform.php">Click to open the next page</a> -->



</table>
</div>

  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  
  <!-- for local -->
  <!-- <script src="script.js"></script>  -->
  
</div> 
<?php
  include("footer.html");
?>   
</body>
</html>