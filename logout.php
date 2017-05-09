<?php
session_start();
echo "You Have Successfully Logged out from GoFundMe,Please Relogin to access our awesome features<br>";
echo '<a href="login.html"> Login </a>';
unset($_SESSION['username']);

?>
