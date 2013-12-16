<?php

session_start();

$refer = $_SERVER['HTTP_REFERER'];
# means the previous page determined the size of board. 
# therefore, start of game
if (strpos($refer, "board_size.html") != false) {
	$_SESSION['width'] = $_POST['width'];
	$_SESSION['height'] = $_POST['height'];
	$game_state = "";
	for ($i = 0; $i < $_SESSION['width']*$_SESSION['height']; $i++) {
		$game_state .= ".";
	}
	$_SESSION['game_state'] = $game_state;
	$_SESSION['user'] = 0;
	$_SESSION['computer'] = 0;	
} else {
	if ($_POST['cell'] != "") {
		$move = $_POST['cell'];
		$height = $move % $_SESSION['height'];
		$_SESSION['game_state'][$move] = "U";
		computer_move($_SESSION['game_state']);
	}
}
$board = $_SESSION['game_state'];

$user_score = calculate_score($board, "U");
$computer_score = calculate_score($board, "C");

$longest = $_SESSION['user'];
for ($i = 0; $i < $_SESSION['height']; $i++) {
	$long_row_user = 1;
	for ($j = 0; $j < $_SESSION['width']; $j++) {
		$cell = $i*$_SESSION['width']+$j;
		$next = $cell + 1;
		$border = ($i+1)*$_SESSION['width']-1;
		if (($board[$cell] == $board[$next]) and ($cell != $border)) {
			if ($board[$cell] == "U") {
				$long_row_user++;
			}
		} else if (($board[$cell] != $board[$next]) and ($cell != $border)) {
			$long_row_user = 0;
			$current = 0;
		}
	}
	if ($long_row_user > $longest) 
		$longest = $long_row_user;
}

if (strpos($board, "C") == false) {
        $computer_score = 0;
}
if (strpos($board, "U") == false) {
        $user_score = 0;
}


$gameID = $_SESSION['gameID']; 

echo '<div style="float:right"> Score <br><br><br><b>';
echo 'User: ' . $user_score . '<br>';
echo 'Computer: ' . calculate_score($board, "C")  . '<br>';
echo '</b></div>';

#sleep(10);

echo '<form name="board" method="post" action="play.php">';
echo '<div style="float:center;"><table align="center" border="1" width="500" height="500">';
for ($height = 0; $height < $_SESSION['height']; $height++) {
	echo '<tr>';
	for ($width = 0; $width < $_SESSION['width']; $width++) {
		echo '<td align="center"';
		$cell = $height*$_SESSION['width']+$width;
		if ($_SESSION['game_state'][$cell] == ".") {
			echo '><input type="radio" name="cell" value="' . $cell . '">';
		} else if ($_SESSION['game_state'][$cell] == "U") {
			echo ' bgcolor="red">' . $_SESSION['game_state'][$cell];
		} else if ($_SESSION['game_state'][$cell] == "C") {
                        echo ' bgcolor="blue">' . $_SESSION['game_state'][$cell];
                }
		echo '</td>';
	}
	echo '</tr>';
}
echo '</table></div>';

echo '<input type="submit" value="Submit Move">';
echo '</form>';
echo '<form name="goHome" method="post" action="home.php">';
echo '<input type="submit" name="home" value="Home">';
echo '</form>';
echo '<form name="newGame" method="post" action="board_size.html">';
echo '<input type="submit"  name="newgame" value="new">';
echo '</form>';
echo '<div style="float:right;">';
echo '</div>';

$_SESSION['game_state'] = $board;

win($board);

function win($board) {
	$user = calculate_score($board, "U");
	$computer = calculate_score($board, "C");
	if ((strpos($board, ".") == false) and (strpos($board, "U") == true)) {
		echo "<br>Game Over!" . "<br>";
		if ($user > $computer) 
			echo "You win!";
		else if ($computer > $user) 
			echo "Computer Wins";
		else 
			echo "Tie Game!";
	}
}

function calculate_score($board, $turn) {
	$score = 0;
	for ($i = 0; $i < $_SESSION['height']; $i++) {
        	$long_row = 1;
        	for ($j = 0; $j < $_SESSION['width']; $j++) {
                	$cell = $i*$_SESSION['width']+$j;
                	$next = $cell + 1;
                	$border = ($i+1)*$_SESSION['width']-1;
			$previous = $cell - 1;
			$borderp = $i * $_SESSION['width'];
                	if (($board[$cell] == $board[$next]) || ($board[$cell] == $board[$previous]) and ($cell != $border)) {
                        	if ($board[$cell] == $turn) {
                                	
					 if (($board[$cell] == $board[$next]) && ($board[$cell] == $board[$previous]) and ($cell != $border)) {
                               
                                        	$long_row++;
                                		}		

				$long_row++;
                        	}

                	} 
			

			else if (($board[$cell] != $board[$next]) and ($cell != $border)) {
				if ($long_row > $score) {
					$score = $long_row;
					$long_row = 1;

				}
			}
			
        	}
		if ($long_row > $score)
                	$score = $long_row;
	}


        for ($i = 0; $i < $_SESSION['height']; $i++) {
                $long_row = 1;
                for ($j = 0; $j < $_SESSION['width']; $j++) {
                        $cellc = $i*$_SESSION['width']+$j;
                        $nextc = $cellc + $_SESSION['width'];
                        $borderc = $_SESSION['height']*$_SESSION['width'];
                        if (($board[$cellc] == $board[$nextc]) and ($cellc < $borderc)) {
                                if ($board[$cellc] == $turn) {
                                        $long_row++;
                                }
                        } else if (($board[$cellc] != $board[$nextc]) and ($cellc <  $borderc)) {
                               if ($long_row > $score) {
                                        $score = $long_row;
                                        $long_row = 1;
                                }
                        }
                }
                if ($long_row > $score)
                        $score = $long_row;
        }

// diagonals left right
	for ($i = 0; $i < $_SESSION['height']; $i++)
{       $long_row = 1;
	for ($j = 0; $j < $_SESSION['width']; $j++) {
         $celld = $i * $_SESSION['width']+ $j;
	 $dia = $i + $_SESSION['width'] + 1;
	$borderd = ($i + 1)* $_SESSION['width'] - 1;
	if (($board[$celld] == $board[$dia] ) and ( $celld != $borderd)){
		if ($board[$celld] == $turn) {
			$long_row++;
}

}  else if (($board[$celld] != $board[$dia]) and ($celld !=  $borderd)) {
                               if ($long_row > $score) {
                                        $score = $long_row;
                                        $long_row = 1;
                                }
                        }
 
   
}
if ($long_row > $score)
	$score = $long_row;

}

	return $score;
}

function computer_move(&$board) {
	for ($i = 0; $i < strlen($board); $i++) {
		if ($board[$i] == ".") {
			$board[$i] = "C";
			return;
		}
	}
}

?>
