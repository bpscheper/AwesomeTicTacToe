<?php

$file = "coverage.txt";
$fp = fopen($file, 'a');

fwrite($fp, "checking a user");

session_start();

$username = "bpsc222";
$host = "mysql.cs.uky.edu";
$password = "u0712429";
$database = "bpsc222";

#establish connection to database
$con = mysqli_connect($host, $username, $password, $database);
if (mysqli_connect_errno($con)) {
  echo "error connecting to database";
} else {

  $username = $_POST['username'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM Users U WHERE U.username = '$username' AND U.password
        = '$password'";
  $result = mysqli_query($con, $sql);
  if (!empty($result)) {
    file_put_contents($file, "registered user can log in", FILE_APPEND);
    $_SESSION['username'] = $username;
  } else {
    file_put_contents($file, "un-registered user cannot log in", FILE_APPEND);
    echo 'Not a registered user. Register now <br>';
  }
}

echo '<form name="go_home" method="get" action="home.php">';
echo '<input type="submit" name="go_home" value="Home"></form>';

echo '<form name="go_register" method="get" action="register.php">';
echo '<input type="submit" name="go_register" value="Register"></form>';

mysql_close($con);

?>
