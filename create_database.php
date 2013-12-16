<?php

$username = "bpsc222";
$host = "mysql.cs.uky.edu";
$password = "u0712429";
$database = "bpsc222";

#establish connection to database
$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno($con)) {
  echo "error connecting to database";
}

$sql = "CREATE TABLE Users(username CHAR(30), password CHAR(30))";
if (mysqli_query($con, $sql))
  echo "Table Users created successfully <br>";
else
  echo "Error creating table: " . mysqli_error($con) . "<br>";

$sql = "CREATE TABLE State(game_state CHAR(25))";
if (mysqli_query($con, $sql))
  echo "Table State created successfully <br>";
else
  echo "Error creating table: " . mysqli_error($con) . "<br>";

mysql_close($con);
?>
