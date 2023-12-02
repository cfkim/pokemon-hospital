<?php
require("connect-db.php");
require("pokemon-db.php");

$list_of_nurses = getAllNurses();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

   if (!empty($_POST['deleteBtn']))
   {
    deleteNurseByID($_POST['nurseID_to_delete']);
    $list_of_nurses = getAllNurses();
   }
   else if (!empty($_POST['addBtn']))
   {
      addNurse($_POST['pokemon_name'], $_POST['weight'], $_POST['type'], $_POST['date_of_birth'], $_POST['last_visit'], $_POST['insurance']);
      $list_of_pokemon = getAllPokemon();
   }
   else if (!empty($_POST['updateBtn']))
   {
      echo $_POST['pokemon_ID_to_update'];
   }
   else if (!empty($_POST['confirmUpdateBtn']))
   {
    echo $_POST['pokemon_ID'];
    updatePokemonByID($_POST['pokemon_ID'], $_POST['pokemon_name'], $_POST['weight'], $_POST['type'], $_POST['date_of_birth'], $_POST['last_visit'], $_POST['insurance']);
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
<div class="container">
  <h1>Pokemon Hospital Clinic</h1>

  <!-- <a href="pokemonform.php">Click to open the next page</a> -->
  <!-- will show this link if the user session is charge nurse is true -->
  <?= if ($_SESSION['is_charge_nurse'] != 0){
        <a href="nursesearch.php">View nurses</a>
       }
  ?>

  <form name="mainForm" action="pokemonform.php" method="post">
      <input type="hidden" name="pokemon_ID" value="<?php echo $_POST['pokemon_ID_to_update'];?>">
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
        <input type="submit" value="Add Patient" name="addBtn"
                class="btn btn-primary" title="Add a patient to the pokemon health center" />
      </div>
      <div class="row mb-3 mx-3">
        <input type="submit" value="Confirm Update" name="confirmUpdateBtn"
                class="btn btn-secondary" title="Update a pokemon into pokemon table" />
      </div>
    </form>

<hr/>
<h3>List of Patients</h3>
<div class="row justify-content-center">
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

  <?php foreach ($list_of_pokemon as $pokemon): ?>
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
          <input type="submit" value="Update" name="updateBtn" class="btn btn-secondary"/></td>
          <input type="hidden" name="pokemon_ID_to_update" value="<?php echo $pokemon['pokemon_ID']; ?>"/>
          <input type="hidden" name="pokemon_name_to_update" value="<?php echo $pokemon['name']; ?>"/>
          <input type="hidden" name="weight_to_update" value="<?php echo $pokemon['weight']; ?>"/>
          <input type="hidden" name="type_to_update" value="<?php echo $pokemon['type']; ?>"/>
          <input type="hidden" name="date_of_birth_to_update" value="<?php echo $pokemon['date_of_birth']; ?>"/>
          <input type="hidden" name="last_visit_to_update" value="<?php echo $pokemon['last_visit']; ?>"/>
          <input type="hidden" name="insurance_to_update" value="<?php echo $pokemon['insurance']; ?>"/>
        </form>
    <td>
      <form action="pokemonform.php" method="post">
        <input type="submit" value="Delete" name="deleteBtn" class="btn btn-danger"/>
        <input type="hidden" name="pokemonID_to_delete" value="<?php echo $pokemon['pokemon_ID']; ?>"/>
      </form>
    </td>
  </tr>
  <?php endforeach; ?>

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


