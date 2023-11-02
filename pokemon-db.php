<?php
function addPokemon($name, $weight, $type, $date_of_birth, $last_visit, $insurance) 
{
  global $db; 

  $query = "insert into pokemon values (:name, :weight, :type, :date_of_birth, :last_visit, :insurance) ";
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

function deletePokemonByID($pokemon_ID)
{
  global $db;
  $query = "delete from pokemon where pokemon_ID=:pokemon_ID";
  $statement = $db->prepare($query); 
  $statement->bindValue(':pokemon_ID', $pokemon_ID);
  $statement->execute();
  $statement->closeCursor();

}
?>
