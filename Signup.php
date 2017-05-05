//Php script to process user's Signup Request

<?php
session_start();
error_reporting(0);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";



$connection = new mysqli($servername,$username,$password,$dbname);
//Check if the connection is established
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

$username = mysql_real_escape_string($_POST['username']);  //Escape any Special Characters for Usage in Query(Security)

$result1 = $connection->query("SELECT cname FROM customer WHERE cname = '$username'");
if($result1->num_rows > 0) {
  //Error Message to be sent to Ajax Query Response.
    //die();
    array('type' => 'error', 'message' => 'Username Already Exists Please Try with Different Username');
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json; charset=UTF-8');
        echo json_encode($data);
    
    
    $conn->close();

    
    }
else

{   $pass=mysql_real_escape_string($_POST['password']);
    $password = password_hash($pass,PASSWORD_DEFAULT);
    $firstName=mysql_real_escape_string($_POST['FirstName']);
    $LastName=mysql_real_escape_string($_POST['LastName']);
    $sql = "INSERT INTO Users(Username, FirstName, LastName,Password)
    VALUES ($usermame,$firstName,$LastName ,$password)";
    if ($connection->query($sql) === TRUE) {
    
} 

else {
    

    
    
    
}

$conn->close();

 }
 
 
?>