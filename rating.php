<?php
session_start();
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
    die("Connection failed: " . $connection->connect_error);
} 

return $connection;
    }
   
    $connection1=connect();
    $userid=mysql_real_escape_string($_SESSION['username']);
    $projectid=mysql_real_escape_string($_POST['projectid']);
    $rating=mysql_real_escape_string($_POST['rating']);
    
    $sql="INSERT INTO `rating`(r_user_id,r_project_id,rating,r_date) VALUES ('$userid','$projectid','$rating',NOW())";
    $result=$connection1->query($sql);
    $result2=$connection1->query($sql2);
   
    if($connection1->query($sql)!=true)
        {
        
        $Success=200;
        $error=mysqli_error($connection1);
        header($protocol.' '.$Success.' '.$error);
           }
   else
    {
        $Success=200;
        $httpStatusMsg='Done';
         header($protocol.' '.$Success.' '.$httpStatusMsg);
        
    }
    
    
    
    
?>
