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

function getPokemonInfo($pokemon_ID){
  global $db;

  $query = "SELECT pokemon.*, GROUP_CONCAT(DISTINCT pokemon_allergies.allergy) as allergies,
  GROUP_CONCAT(DISTINCT pokemon_illnesses.illness) as illnesses,
  GROUP_CONCAT(DISTINCT pokemon_injuries.injury) as injuries,
  GROUP_CONCAT(DISTINCT pokemon_medications.medication) as medications
  FROM pokemon
  LEFT JOIN pokemon_allergies ON pokemon.pokemon_ID = pokemon_allergies.pokemon_ID
  LEFT JOIN pokemon_illnesses ON pokemon.pokemon_ID = pokemon_illnesses.pokemon_ID
  LEFT JOIN pokemon_injuries ON pokemon.pokemon_ID = pokemon_injuries.pokemon_ID
  LEFT JOIN pokemon_medications ON pokemon.pokemon_ID = pokemon_medications.pokemon_ID
  WHERE pokemon.pokemon_ID=:pokemon_ID
  GROUP BY pokemon.pokemon_ID";

  $statement = $db->prepare($query);

  // Bind the parameter before executing the statement
  $statement->bindParam(':pokemon_ID', $pokemon_ID);

  $statement->execute();
  $results = $statement->fetchAll();
  $statement->closeCursor();
  return $results;

}

function getTrainerInfo($trainer_ID){
  global $db;

  $query = "SELECT trainer.*, trainer_phone.phone_number
  FROM trainer
  LEFT JOIN trainer_phone ON trainer.trainer_ID = trainer_phone.trainer_ID
  WHERE trainer.trainer_ID=:trainer_ID";

  $statement = $db->prepare($query);

  // Bind the parameter before executing the statement
  $statement->bindParam(':trainer_ID', $trainer_ID);

  $statement->execute();
  $results = $statement->fetchAll();
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

function getPokemonByID($pokemon_ID) 
{
  global $db;
  $query = "select * from pokemon where pokemon_ID=:pokemon_ID";
  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_ID', $pokemon_ID);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
  $statement->closeCursor();

  return $result;
}

function getIllnessesByID($pokemon_ID)
{
  global $db;
  $query = "select * from pokemon_illnesses where pokemon_ID=:pokemon_ID";
  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_ID', $pokemon_ID);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
  $statement->closeCursor();

  return $result;
}

function getInjuriesByID($pokemon_ID)
{
  global $db;
  $query = "select * from pokemon_injuries where pokemon_ID=:pokemon_ID";
  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_ID', $pokemon_ID);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
  $statement->closeCursor();

  return $result;
}

function getAllergiesByID($pokemon_ID)
{
  global $db;
  $query = "select * from pokemon_allergies where pokemon_ID=:pokemon_ID";
  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_ID', $pokemon_ID);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
  $statement->closeCursor();

  return $result;
}

function getMedicationsByID($pokemon_ID)
{
  global $db;
  $query = "select * from pokemon_medications where pokemon_ID=:pokemon_ID";
  $statement = $db->prepare($query);
  $statement->bindValue(':pokemon_ID', $pokemon_ID);
  $statement->execute();
  $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
  $statement->closeCursor();

  return $result;
}

function exportHealthRecords($pokemon_ID, $pokemon_name)
{
  global $db;

  header('Content-Type: text/csv');
  header('Content-Disposition: attachment; filename="' . $pokemon_name . '-health-records.csv"');

  $output = fopen('php://output', 'w');

  $pokemon_info = getPokemonByID($pokemon_ID);
  $pokemon_illnesses = getIllnessesByID($pokemon_ID);
  $pokemon_injuries = getInjuriesByID($pokemon_ID);
  $pokemon_allergies = getAllergiesByID($pokemon_ID);
  $pokemon_medications = getMedicationsByID($pokemon_ID);

  $infoHeaders = array('pokemon_ID', 'nurse_ID', 'trainer_ID', 'name', 'weight', 'type', 'date_of_birth','last_visit','insurance');
  $illnessHeaders = array('pokemon_ID', 'illness');
  $injuriesHeaders = array('pokemon_ID', 'injury');
  $allergiesHeaders = array('pokemon_ID', 'allergy');
  $medicationsHeaders = array('pokemon_ID', 'medication');

  fputcsv($output, $infoHeaders);
  foreach ($pokemon_info as $data) {
      fputcsv($output, $data);
  }
  fputcsv($output, array());

  fputcsv($output, $illnessHeaders);;
  foreach ($pokemon_illnesses as $illness) {
    fputcsv($output, $illness);
  }
  fputcsv($output, array());

  fputcsv($output, $injuriesHeaders);
  foreach ($pokemon_injuries as $injury) {
    fputcsv($output, $injury);
  }
  fputcsv($output, array());

  fputcsv($output, $allergiesHeaders);
  foreach ($pokemon_allergies as $allergy) {
    fputcsv($output, $allergy);
  }
  fputcsv($output, array());

  fputcsv($output, $medicationsHeaders);
  foreach ($pokemon_medications as $medication) {
    fputcsv($output, $medication);
  }

    fclose($output);
  exit();
}


?>
