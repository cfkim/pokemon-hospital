<?php
function addFriend($friendname, $major, $year) 
{
  global $db; 
  //   $query = "insert into friends values ('" . $friendname . "', '" . $major . "'," . $year .") ";
  // $db->query($query);  // compile + exe

  $query = "insert into friends values (:friendname, :major, :year) ";
  // prepare: 
  // 1. prepare (compile) 
  // 2. bindValue + exe

  $statement = $db->prepare($query); 
  $statement->bindValue(':friendname', $friendname);
  $statement->bindValue(':major', $major);
  $statement->bindValue(':year', $year);
  $statement->execute();
  $statement->closeCursor();
}

function getAllFriends()
{
  global $db;
  $query = "select * from friends";
  $statement = $db->prepare($query); 
  $statement->execute();
  $results = $statement->fetchAll();   // fetch()
  $statement->closeCursor();
  return $results;
}
  
function updateFriendByName($name, $major, $year)
{
  global $db;
  $query = "update friends set major=:major, year=:year where name=:name";

  $statement = $db->prepare($query); 
  $statement->bindValue(':name', $name);
  $statement->bindValue(':major', $major);
  $statement->bindValue(':year', $year);
  $statement->execute();
  $statement->closeCursor();
}

function deleteFriendByName($name)
{
  global $db;
  $query = "delete from friends where name=:name";
  $statement = $db->prepare($query); 
  $statement->bindValue(':name', $name);
  $statement->execute();
  $statement->closeCursor();

}
?>