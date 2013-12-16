<?php

echo '<html>';
echo '<table width="300" border="0" align="center" bgcolor="#CCCCCC"><tr>';
echo '<form name="form1" method="post" action="register_user.php"><td>';
echo '<table width="100%" border="0" cellpadding="3" cellspacing="1"
        bgcolor="#FFFFFF"><tr>';
echo '<td colspan="3"><strong>Customer Login </strong></td></tr><tr><td
        width="78">Username</td><td width="6">:</td><td width="294"><input
        name="username" type="text" id="username" placeholder="username"></td>
        </tr><tr><td>Password</td><td>:</td><td><input name="password"
        type="password" id="password" placeholder="password"></td></tr>';
echo '</tr><tr><td>Retype Password</td><td>:</td><td><input name="password2"
        type="password" id="password2" placeholder="password"></td></tr>';
echo '<tr><td>&nbsp;</td><td>&nbsp;</td><td><input type="submit" name="Submit"
        value="Login"></td></tr></table></td></form></tr></table>';
echo '</html>'

?>
