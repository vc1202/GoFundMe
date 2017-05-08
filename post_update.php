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

$projecttextupdate = mysql_real_escape_string($_POST['textupdate']);
echo $projecttextupdate. "<br> ";

echo $_FILES["updatevideo"]["name"];

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
      }
    }
  }
else
  {
  echo "Invalid file";
  }
?>