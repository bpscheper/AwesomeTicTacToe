<?php

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

  $password1 = $_POST['password'];
  $password2 = $_POST['password2'];
  $username = $_POST['username'];

  if ($password1 == $password2) {
    $sql = "INSERT INTO Users VALUES ('$username', '$password1')";
    echo $sql;
    if (mysqli_query($con, $sql)) {
      echo 'Successfully created user. <br>';
      echo '<form name="go_home" method="get" action="home.php">';
      echo '<input type="submit" name="go_home" value="Home"></form>';
      $_SESSION['username'] = $username;
    } else {
      echo mysqli_errno($con);
    }
  } else {
    echo 'Passwords do not match. Please try again. <br>';
    echo '<form name="go_home" method="get" action="home.php">';
    echo '<input type="submit" name="go_home" value="Home"></form>';
    echo '<form name="go_register" method="get" action="register.php">';
    echo '<input type="submit" name="go_register" value="Register"></form>';

  }
}

mysql_close($con);

?>
