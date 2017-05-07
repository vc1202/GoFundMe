<?php
$protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

     $servername = "localhost";
     $usernam = "root";
     $password = "";
     $dbname = "project";
     $connection1 = new mysqli($servername,$usernam,$password,$dbname);
     //Check if the connection is established
if ($connection1->connect_error) {
    die("Connection failed: " . $connection1->connect_error);
} 
$followerid=mysql_real_escape_string($_POST['followerid']);
if(!isset($_POST['deleteuser']))
{

$followedid=mysql_real_escape_string($_POST['followedid']);
$sql="SELECT * FROM follow where follower='$followerid' AND followee='$followedid'";

$results=$connection1->query($sql);

if($results->num_rows>0)
{   
    $success =404;
    $httpStatusMsg  = 'You already Follow this user';
    header($protocol.' '.$success.' '.$httpStatusMsg);
    die();
         
         
     }
         
      
    

$sql1="INSERT INTO `follow`(follower,followee) VALUES ('$followerid','$followedid')";
if($connection1->query($sql1) === TRUE)
{
 $success = 200;
 $httpStatusMsg  = 'Successfully Followed the user';
 header($protocol.' '.$success.' '.$httpStatusMsg);
 die();
         
}
else
{
 $success='400';
 $httpStatusMsg=mysqli_error($connection1);
 header($protocol.' '.$success.' '.$httpStatusMsg);
 die();
    
    
}
}
else
{  
    $deleteid=mysql_real_escape_string($_POST['deleteuser']);
    $sql="DELETE FROM follow where follower='$followerid' AND followee='$deleteid'";
    
    if($connection1->query($sql)==true)
    {
  $success='200';
 $httpStatusMsg="User unfollowed Successfully";
 header($protocol.' '.$success.' '.$httpStatusMsg);
 die();
        
        
        
    }
    else
    {
 $success='400';
 $httpStatusMsg="Some error occured while Unfollowing";
 header($protocol.' '.$success.' '.$httpStatusMsg);
 die();
        
        
    }
   
    
    
    
    
    
    
    
}



