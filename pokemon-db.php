<?php
function addPokemon($name, $weight, $type, $date_of_birth, $last_visit, $insurance)
{
  global $db;

  $query = "insert into pokemon (name, weight, type, date_of_birth, last_visit, insurance) values (:name, :weight, :type, :date_of_birth, :last_visit, :insurance) ";
  // prepare:
  // 1. prepare (compile)
  // 2. bindValue + exe

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':weight', $weight);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':date_of_birth', $date_of_birth);
  $statement->bindValue(':last_visit', $last_visit);
  $statement->bindValue(':insurance', $insurance);
  $statement->execute();
  $statement->closeCursor();
}

function getAllPokemon()
{
  global $db;
  $query = "select * from pokemon";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function getAssignedPokemon($nurse_ID){
  global $db;
  $query = "select * from pokemon where nurse_ID='".$nurse_ID."'";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function updatePokemonByID($pokemon_ID, $name, $weight, $type, $date_of_birth, $last_visit, $insurance)
{
  global $db;
  $query = "update pokemon set name=:name, weight=:weight, type=:type, date_of_birth=:date_of_birth, last_visit=:last_visit, insurance=:insurance where pokemon_ID=:pokemon_ID";

  $statement = $db->prepare($query);
  $statement->bindValue(':name', $name);
  $statement->bindValue(':weight', $weight);
  $statement->bindValue(':type', $type);
  $statement->bindValue(':date_of_birth', $date_of_birth);
  $statement->bindValue(':last_visit', $last_visit);
  $statement->bindValue(':pokemon_ID', $pokemon_ID); // Add this line to bind the ID
  $statement->bindValue(':insurance', $insurance);
  $statement->execute();
  $statement->closeCursor();
}

function deletePokemonByID($pokemon_ID)
{
  global $db;
  $query = "delete from pokemon where pokemon_ID=:pokemon_ID";
  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_ID', $pokemon_ID);
  $statement->execute();
  $statement->closeCursor();

}


function getNurseProfileInfo($nurse_ID)
{
  global $db;
  $query = "select * from nurse where nurse_ID=$nurse_ID";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetch();   // fetch()
  $statement->closeCursor();
  return $results;
}

function getNursePhoneNumbers($nurse_ID)
{
  global $db;
  $query = "select phone_number from nurse_phone where nurse_ID=$nurse_ID";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetch();   // fetch()
  $statement->closeCursor();
  return $results;
}

function getNurseSpecialties($nurse_ID)
{
  global $db;
  $query = "select specialty from nurse_specialties where nurse_ID=$nurse_ID";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}

function searchPokemon($name)
{
  global $db;
  $query = "select * from pokemon where name='".$name."'";
  $statement = $db->prepare($query);
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}


?>
