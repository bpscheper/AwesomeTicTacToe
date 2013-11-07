<?php

session_start();

echo '<html><body>';
if (isset($_SESSION["user"])) {
  echo '<div style="float:right">Hello, <a href="">';
  $name = $_SESSION["user"];
  echo $name . '.</a></div><br>';
  echo '<div style="float:right"><a href="">Log out</a></div>';
} else {
  echo '<div style="float:right">Hello, <a href="login.php">';
  echo 'Sign In</a></div><br>';
  echo '<div style="float:right">Register Now</a></div>';
}

echo '<div><a href="home.php"><img src="Pictures/Name.jpg" 
	alt="Awesome Tic Tac Toe"></a></div>';
echo '<p><table><tr>';
echo '<td><div><a href="rules.php"><img src="Pictures/Rules.jpg" alt="Rules">
	</a></td><td><img src="Pictures/Picture1.jpg" alt="Example 1"></div>
	</td></tr><tr>';
echo '<td><div><a href="description.php"><img src="Pictures/Description.jpg" 
	alt="Description"></a></div></td></tr><tr>';
echo '<td><div><a href="game_play.php"><img src="Pictures/Play.jpg" 
	alt="Start Playing!"></a></div></td><td><img 
	src="Pictures/Picture2.jpg" alt="Example 2"></td></tr></table></p>';




echo '</body></html>';

?>
