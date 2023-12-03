<?php
function addNurse($name_first, $name_first, $is_charge_nurse)
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
  $query = "select * from nurse";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function updateNurseByID($nurse_ID, $name_first, $name_last, $position)
{
  global $db;
  $query = "update nurse set name_first=:name_first, name_last=:name_last, position=:position where nurse_ID=:nurse_ID";

  $statement = $db->prepare($query);
  $statement->bindValue(':name_first', $name_first);
  $statement->bindValue(':name_last', $name_last);
  $statement->bindValue(':position', $position);
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
