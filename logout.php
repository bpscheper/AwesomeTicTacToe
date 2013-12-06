<?php

session_start();

echo '<html><body><form name="logout" method="get" action"home.php">';
echo '<a href="home.php">Go to Home Screen</a>';
echo '</form></body></html>';

session_unset();

?>

