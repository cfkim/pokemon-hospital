<?php
require("connect-db.php");
require("nurse-db.php");

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
      addNurse($_POST['nurse_ID'], $_POST['first_name'], $_POST['last_name'], $_POST['is_charge_nurse']);
      $list_of_nurses = getAllNurses();
   }
   else if (!empty($_POST['updateBtn']))
   {
      echo $_POST['nurse_ID_to_update'];
   }
   else if (!empty($_POST['confirmUpdateBtn']))
   {
    echo $_POST['nurse_ID'];
    updateNurseByID($_POST['nurse_ID'], $_POST['first_name'], $_POST['last_name'], $_POST['is_charge_nurse']);
    $list_of_nurses = getAllNurses();
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

  <!-- will show this link if the user session is charge nurse is true
  <?= if ($_SESSION['is_charge_nurse'] != 0){
        <a href="nursesearch.php">View nurses</a>
       }
  ?> -->

  <form name="mainForm" action="nursesearch.php" method="post">
      <input type="hidden" name="nurse_ID" value="<?php echo $_POST['nurse_ID_to_update'];?>">
      <div class="row mb-3 mx-3">
        Nurse first name:
        <input type="text" class="form-control" name="nurse_name" required value="<?php echo $_POST['nurse_firstname_to_update'];?>"/>
      </div>

      <div class="row mb-3 mx-3">
        Nurse last name:
        <input type="text" class="form-control" name="nurse_name" required value="<?php echo $_POST['nurse_lastname_to_update'];?>"/>
      </div>

      <div class="row mb-3 mx-3">
        Nurse position:
        <input type="text" class="form-control" name="nurse_name" required value="<?php echo $_POST['nurse_position_to_update'];?>"/>
      </div>

      <div class="row mb-3 mx-3">
        <input type="submit" value="Add Patient" name="addBtn"
                class="btn btn-primary" title="Add a nurse to the pokemon health center" />
      </div>
      <div class="row mb-3 mx-3">
        <input type="submit" value="Confirm Update" name="confirmUpdateBtn"
                class="btn btn-secondary" title="Update a nurse into nurse table" />
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
    <th>First name
    <th>Last name
    <th>Is charge nurse
    <th>&nbsp;</th>
    <th>&nbsp;</th>
  </tr>
  </thead>

  <?php foreach ($list_of_nurses as $nurse): ?>
  <tr>
     <td><?php echo $nurse['nurse_ID']; ?></td>
     <td><?php echo $nurse['name_first']; ?></td>
     <td><?php echo $nurse['name_last']; ?></td>
     <td><?php echo $nurse['is_charge_nurse']; ?></td>

    <td>
        <form action="nursesearch.php" method="post">
          <input type="submit" value="Update" name="updateBtn" class="btn btn-secondary"/></td>
          <input type="hidden" name="nurse_ID_to_update" value="<?php echo $nurse['nurse_ID']; ?>"/>
          <input type="hidden" name="nurse_firstname_to_update" value="<?php echo $nurse['name_first']; ?>"/>
          <input type="hidden" name="nurse_lastname_to_update" value="<?php echo $nurse['name_last']; ?>"/>
          <input type="hidden" name="nurse_position_to_update" value="<?php echo $nurse['is_charge_nurse']; ?>"/>
        </form>
    <td>
      <form action="nursesearch.php" method="post">
        <input type="submit" value="Delete" name="deleteBtn" class="btn btn-danger"/>
        <input type="hidden" name="nurseID_to_delete" value="<?php echo $nurse['nurse_ID']; ?>"/>
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


