<?php

session_start();

$filepath = "/Users/home/bpsc222/www/CS485/Program/AwesomeTicTacToe";
#$file = $filepath . "/coverage.txt";
$file = "/Program/AwesomeTicTacToe/coverage.txt";

$file = $filepath . "/coverage.txt";

#echo $_SERVER['SERVER_NAME'];

echo getcwd();

$fp = fopen($file, "a+") or die("Cannot open file " . $file);
fwrite($fp, "Start code coverage");

echo '<html><body>';
if (isset($_SESSION["username"])) {
  echo '<div style="float:right">Hello, <a href="">';
  $name = $_SESSION["username"];
  echo $name . '.</a></div><br>';
  echo '<div style="float:right"><a href="logout.php">Log out</a></div>';
} else {
  echo '<div style="float:right">Hello, <a href="login.php">';
  echo 'Sign In</a></div><br>';
  echo '<div style="float:right"><a href="register.php">Register Now</a></div>';
}

echo '<div><a href="home.php"><img src="Pictures/Name.jpg" 
	alt="Awesome Tic Tac Toe"></a></div>';
echo '<p><table><tr>';
echo '<td><div><a href="rules.php"><img src="Pictures/Rules.jpg" alt="Rules">
	</a></td><td><img src="Pictures/Picture1.jpg" alt="Example 1"></div>
	</td></tr><tr>';
echo '<td><div><a href="description.php"><img src="Pictures/Description.jpg" 
	alt="Description"></a></div></td></tr><tr>';
echo '<td><div><a href="gameboard.html"><img src="Pictures/Play.jpg" 
	alt="Start Playing!"></a></div></td><td><img 
	src="Pictures/Picture2.jpg" alt="Example 2"></td></tr></table></p>';

echo '</body></html>';

fclose($fp);

?>
