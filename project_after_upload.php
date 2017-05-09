<?php
session_start();
if(!(isset($_SESSION['username'])) && empty($_SESSION['username']))
{
    echo "UnAuthorised Page Usage, Please Login from Main Page to continue";
    die();
    
}
function checkmydate($date) {
  $tempDate = explode('-', $date);
  // checkdate(month, day, year)
  return checkdate($tempDate[1], $tempDate[0], $tempDate[2]);
}
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
//echo "line 3<br>";
$target_dir = "uploads/";
$name=mysql_real_escape_string($_FILES['projectimage']['name']);
$target_file = $target_dir . basename($name);
echo "line 3<br>";
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES['projectimage']['name']);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
//Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    echo "line 10<br>";
    $check = getimagesize($_FILES["projectimage"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    //Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
   // Check file size
    if ($_FILES["projectimage"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
         if (move_uploaded_file($_FILES['projectimage']['tmp_name'], $target_file)) {
        echo "The file ". basename( $_FILES["projectimage"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
    }
}
$projectname=mysql_real_escape_string($_POST['project_title']);
$projectdescription=mysql_real_escape_string($_POST['description']);
$pledgedate=mysql_real_escape_string($_POST['enddate']);
$pledgehour=mysql_real_escape_string($_POST['pledgehour']);
$pledgeminute=mysql_real_escape_string($_POST['pledgeminnute']);
$minamount=mysql_real_escape_string($_POST['minamt']);
$maxamount=mysql_real_escape_string($_POST['maxamt']);
$enddate=mysql_real_escape_string($_POST['enddate']);
$completionhour=mysql_real_escape_string($_POST['completionhour']);
$completionminute=mysql_real_escape_string($_POST['completionminnute']);


if(!checkmydate($pledgedate) && !checkmydate($enddate))
{
    
    "Sorry You have Entered Invalid date,Please check that dates are in correct format";
    }

$pledgedate=explode('-', $pledgedate);
$pledgedatetime=$pledgedate[0]."-".$pledgedate[1]."-".$pledgedate[2]."  ".$pledgehour.":".$pledgeminute.":"."00";
$projectdate=explode('-',$enddate);
$projectend=$projectdate[0]."-".$projectdate[1]."-".$projectdate[2]."  ".$completionhour.":".$completionminute.":"."00";


        
$ownerid=mysql_real_escape_string($_SESSION['username']);
$sql="INSERT INTO  project (owner_id,status,p_title,p_description,p_tags,p_category,min_amt,max_amt,imagename,amt_collected,pledge_start_date,pledge_end_date,proj_end_date) VALUES ('$ownerid','looking','$projectname', '$projectdescription','Inserttest','Science','$minamount','$maxamount','$target_file',0,NOW(),'$pledgedatetime','$projectend')";

if($connection->query($sql) === TRUE)
{
    echo "Successfully Added Project";
    
    
}
else
{
    
    echo "Project was not added succesfully";
    
}

?>
