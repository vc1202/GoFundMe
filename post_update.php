<?php

session_start();
if(!(isset($_SESSION['username'])) && empty($_SESSION['username']))
{
    echo "UnAuthorised Page Usage, Please Login from Main Page to continue";
    die();
    
}

$servername = "localhost";
$usernam = "root";
$password = "";
$dbname = "project";

$connection = new mysqli($servername,$usernam,$password,$dbname);
//Check if the connection is established
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 

$project_ID=mysql_escape_string($_GET['projectid']);
$ownerid=mysql_real_escape_string($_SESSION['username'])
$sqlcheck="SELECT * FROM project where project_id='$project_ID' and owner_id='$ownerid'";
$result1=$connection->query($sqlcheck);
if($result1->num_rows <=0)
{

echo "Unauthorised Project Update";


}




$projecttextupdate = mysql_real_escape_string($_POST['textupdate']);


    
if($projecttextupdate)
    $sql="INSERT INTO blob_data(`project_id`,`data_type`,`data_path`,`date`) VALUES(1,'text','$projecttextupdate',NOW())";
{
    $connection->query($sql);
    if($connection)
        echo "Inserted Text update";
    {
        
    
    }
}


if(filesize($_FILES["updatevideo"]["tmp_name"])){

  $allowedExts = array("ogg", "mp4", "webm", "MP4");
 $extension = pathinfo($_FILES["updatevideo"]["name"], PATHINFO_EXTENSION);

if ((($_FILES["updatevideo"]["type"] == "video/mp4")
|| ($_FILES["updatevideo"]["type"] == "video/ogg")
|| ($_FILES["updatevideo"]["type"] == "video/webm"))

&& in_array($extension, $allowedExts))

  {
  if ($_FILES["updatevideo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["updatevideo"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["updatevideo"]["name"] . "<br />";
    echo "Type: " . $_FILES["updatevideo"]["type"] . "<br />";
    echo "Size: " . ($_FILES["updatevideo"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["updatevideo"]["tmp_name"] . "<br />";

    if (file_exists("uploads/videos/" . $_FILES["updatevideo"]["name"]))
      {
      echo $_FILES["updatevideo"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["updatevideo"]["tmp_name"],
      "uploads/videos/" . $_FILES["updatevideo"]["name"]);
      $target_file = "uploads/videos/" . $_FILES["updatevideo"]["name"];
      echo "Stored in: " . "uploads/videos/" . $_FILES["updatevideo"]["name"];
      $target_file=mysql_real_escape_string($target_file);
      $sql2="INSERT INTO blob_data(`project_id`,`data_type`,`data_path`,`date`) VALUES(1,'video','$target_file',NOW())";
      $connection->query($sql2);
      }
    }
  }
else
  {
  
   $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wma");
$extension = pathinfo($_FILES['updatevideo']['name'], PATHINFO_EXTENSION);

if ((($_FILES["updatevideo"]["type"] == "video/mp4")
|| ($_FILES["updatevideo"]["type"] == "audio/mp3")
|| ($_FILES["updatevideo"]["type"] == "audio/wma")
|| ($_FILES["updatevideo"]["type"] == "image/pjpeg")
|| ($_FILES["updatevideo"]["type"] == "image/gif")
|| ($_FILES["updatevideo"]["type"] == "image/jpeg"))

&& in_array($extension, $allowedExts))

  {
  if ($_FILES["updatevideo"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["updatevideo"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["updatevideo"]["name"] . "<br />";
    echo "Type: " . $_FILES["updatevideo"]["type"] . "<br />";
    echo "Size: " . ($_FILES["updatevideo"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["updatevideo"]["tmp_name"] . "<br />";

    if (file_exists("uploads/videos/" . $_FILES["updatevideo"]["name"]))
      {
      echo $_FILES["updatevideo"]["name"] . " already exists. ";
      }
    else
      {
      move_uploaded_file($_FILES["updatevideo"]["tmp_name"],
      "uploads/images/" . $_FILES["updatevideo"]["name"]);
      $target_file = "uploads/images/" . $_FILES["updatevideo"]["name"];
      echo "Stored in: " . "uploads/images/" . $_FILES["updatevideo"]["name"];
      $target_file=mysql_real_escape_string($target_file);
      $sql2="INSERT INTO blob_data(`project_id`,`data_type`,`data_path`,`date`) VALUES(1,'image','$target_file',NOW())";
      $connection->query($sql2);
      header('location:list_project.php')
      }
    }
    
    
}
else
{
    echo("Error while uploading");
       
}
}
  }
  
  
  
  

  
  ?>