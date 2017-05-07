<?php
$httpStatusCode = "error";
$Success  = 400;
$protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';
function connect()
{
    
     $servername = "localhost";
     $usernam = "root";
     $password = "";
     $dbname = "project";
     $connection = new mysqli($servername,$usernam,$password,$dbname);
     
     //Check if the connection is established
if ($connection->connect_error) {
    header($protocol.' '.$Success.' '.$httpStatusMsg);
    die("Connection failed: " . $connection->connect_error);
} 

return $connection;
    
    
}

$projectid=mysql_real_escape_string($_POST['projectid']);
$discussid=mysql_real_escape_string($_POST['discussid']);
$commenttext=mysql_real_escape_string($_POST['commenttext']);
$connection=connect();
$sql="INSERT INTO `discuss`(discuss_project_id,discuss_user_id,comment,commend_date) VALUES('$projectid','$discussid','$commenttext',NOW())";
if($connection->query($sql) === TRUE)
{   
    $httpStatusMsg="Done";
    $Success  = 200;
    header($protocol.' '.$Success.' '.$httpStatusMsg);    
    
}
 else {
    $httpStatusMsg=mysqli_error($connection);
    $Success  = 400;
    header($protocol.' '.$Success.' '.$httpStatusMsg);    
    
     
     
}




?>
