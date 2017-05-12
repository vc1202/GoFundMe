<?php
session_start();
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
   
    $projectid=mysql_real_escape_string($_POST['projectid']);
    $connection=connect();
    $userid=mysql_real_escape_string($_SESSION['username']);
    
    $sql="update project SET status='complete' where project_id='$projectid' and owner_id='$userid'";
    
    $result=$connection->query($sql);
    
    if($result)
    {
        echo "Project Marked as complete";
        
        
    }
    else
    {
        echo "Project couldnt be marked as complete due to internal problem or unauthorised usage";
        
    }
    
    
    
    ?>
