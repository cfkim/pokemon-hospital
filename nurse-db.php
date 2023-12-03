<?php
function addNurse($name_first, $name_last, $is_charge_nurse)
{
  global $db;

  $query = "insert into nurse (name_first, name_last, is_charge_nurse) values (:name_first, :name_last, :is_charge_nurse) ";

  $statement = $db->prepare($query);
  $statement->bindValue(':name_first', $name_first);
  $statement->bindValue(':name_last', $name_last);
  $statement->bindValue(':is_charge_nurse', $is_charge_nurse);
  $statement->execute();
  $statement->closeCursor();
}

function getAllNurses()
{
  global $db;
  $query = "SELECT nurse.*, nurse_phone.phone_number, GROUP_CONCAT(nurse_specialties.specialty) AS specialties
              FROM nurse
              LEFT JOIN nurse_phone ON nurse.nurse_ID = nurse_phone.nurse_ID
              LEFT JOIN nurse_specialties ON nurse.nurse_ID = nurse_specialties.nurse_ID
              GROUP BY nurse.nurse_ID";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function updateNurseByID($nurse_ID, $name_first, $name_last, $is_charge_nurse)
{
  global $db;
  $query = "update nurse set name_first=:name_first, name_last=:name_last, is_charge_nurse=:is_charge_nurse where nurse_ID=:nurse_ID";

  $statement = $db->prepare($query);
  $statement->bindValue(':name_first', $name_first);
  $statement->bindValue(':name_last', $name_last);
  $statement->bindValue(':is_charge_nurse', $is_charge_nurse);
  $statement->bindValue(':nurse_ID', $nurse_ID);
  $statement->execute();
  $statement->closeCursor();
}

function deleteNurseByID($nurse_ID)
{
  global $db;
  $query = "delete from nurse where nurse_ID=:nurse_ID";
  $statement = $db->prepare($query);
  $statement->bindValue(':nurse_ID', $nurse_ID);
  $statement->execute();
  $statement->closeCursor();

}
?>
