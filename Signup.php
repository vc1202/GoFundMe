<?php
session_start();
error_reporting(0);
$servername = "localhost";
$usernam = "root";
$password = "";
$dbname = "project";
$httpStatusCode = 400;
$httpStatusMsg  = 'Username Already taken';
$protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

$connection = new mysqli($servername,$usernam,$password,$dbname);
//Check if the connection is established
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

$username1 = mysql_real_escape_string($_POST['username']);//Escape any Special Characters for Usage in Query(Security)
$result1 = $connection->query("SELECT * FROM $dbname.User WHERE user_id = '$username1'");
if($result1->num_rows > 0) {
  //Error Message to be sent to Ajax Query Response.
    //die();
     header($protocol.' '.$httpStatusCode.' '.$httpStatusMsg);
     return false;
    $connection->close();
}
else

{
    
    $pass=mysql_real_escape_string($_POST['password']);
    $password1 = password_hash($pass,PASSWORD_BCRYPT);
    $firstName=mysql_real_escape_string($_POST['FirstName']);
    $LastName=mysql_real_escape_string($_POST['LastName']);
    
    $sql = "INSERT INTO User (user_id, f_name, l_name,password,address,dob) VALUES ('$username1', '$firstName', '$LastName','$password1','123',CURDATE())";
    
    if ($connection->query($sql) === TRUE) {
        $Success=505;
        $httpStatusMsg='Added';
        $_SESSION['username']=$username1;
        header($protocol.' '.$Success.' '.$httpStatusMsg);
        
        
 } 

    else {
    

    $Success=404;
    $httpStatusMsg='Some error While Inserting the records'; 
    header($protocol.' '.$Success.' '.$httpStatusMsg);
    }

$connection->close();

 }
 
 
?>