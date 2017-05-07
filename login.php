<?php
session_start();
error_reporting(0);
$servername = "localhost";
$usernam = "root";
$password = "";
$dbname = "project";
$httpStatusCode = 400;
$httpStatusMsg  = 'Incorrect Username or Password';
$protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

$connection = new mysqli($servername,$usernam,$password,$dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

$username=mysql_real_escape_string($_POST['username']);
$pass=mysql_real_escape_string($_POST['password']);
$password1=password_hash($pass,PASSWORD_BCRYPT);

$sql="Select password from user where user_id='$username'";
$result1 = $connection->query($sql);
$row = $result1->fetch_assoc();

if(password_verify($pass, $row['password'])) 
{   
    $_SESSION['username']=$username;
    $httpStatusCode1 = 200;
    $httpStatusMsg1  = 'Login Successful';
    header($protocol.' '.$httpStatusCode1.' '.$httpStatusMsg1);
    
 }


else    
{
  //Error Message to be sent to Ajax Query Response.
    //die();
     header($protocol.' '.$httpStatusCode.' '.$httpStatusMsg);
    $connection->close();
}


?>

