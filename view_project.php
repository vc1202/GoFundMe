<?php
session_start();
if(!isset($_SESSION['username']))
{
    Echo "Unauthorised Page Usage Please Relogin to Access All the Page features;";
    header('location:login.html');
    
    
}

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
?>

<html lang="en">
    
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <title>GetFunded</title>
</head>
<?php
     $connection=connect();
     $httpStatusCode = 400;
     $httpStatusMsg  = 'Username Already taken';
     $protocol=isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0';

$projectid=mysql_real_escape_string($_GET['id']);

$sql="Select *,timestampdiff(DAY, pledge_start_date, pledge_end_date) as days from project  where project_id='$projectid'";
$result=$connection->query($sql);
if($result->num_rows == 0)
{
echo "Error While getting the project";

}
$row=$result->fetch_assoc();


$sql1="Select count(*) as counter from sponsor where project_id='$projectid'";
$result1=$connection->query($sql1);
if($result1->num_rows == 0)
{
echo "Error While getting the project";
die();
}
$row1=$result1->fetch_assoc();


?>

<script>
    
    function test()
    {   
          var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
    if (this.readyState === 4) {
        if(this.status===404){
        alert(this.responseText);
    }
        if(this.status===200)
        {
            
            alert("Project backed successfully");
            //location.reload(true);

            
        }
         
            }
  };    
        xhttp.open("POST", "sponsor.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var param= "sponsorid"+"="+ <?php echo json_encode($_SESSION['username']); ?>+"&"+"pledgevalue"+"="+document.getElementById("pledge").value+"&"+"projectid"+"="+<?php echo json_encode($projectid);?>;
        xhttp.send(param);
        
        } 
        
</script>


<script>
    function like1()
    {
    <?php
    $connection1=connect();
    $username=$_SESSION['username'];
    $sql2 = "INSERT INTO `like` (like_project_id,like_user_id,like_date) VALUES ('$projectid','$username',NOW())";
    if($connection1->query($sql2) === TRUE)
    {
        $result='1';
       }
 else {
 $result='0';         
 $error=mysqli_error($connection1);
 
 
 }
    
?>    
        
        
        
        if(<?php echo json_encode($result);?> ==='1')
        {
            alert("Project followed Sucessfully");
        }
        else
        {
            alert("There was Some error while following project,Please Try Again");
            
        }
        
        
        
        }
        
 function comment1()
 {    
      var xhttp = new XMLHttpRequest();
         xhttp.onreadystatechange = function() {
    if (this.readyState === 4) {
        if(this.status===400){
        alert("Error while Posting a comment");
    }
        if(this.status===200)
        {
            
            alert("Comment Posted Successfully");
            window.location.reload(true));

            
        }
        
            
            }
  };    
        xhttp.open("POST", "discuss.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        var param= "projectid"+"="+ <?php echo json_encode($projectid); ?>+"&"+"discussid"+"="+<?php echo json_encode($username);?>+"&"+"commenttext"+"="+document.getElementById("comment");
        //var param= "username"+"="+document.getElementById("username").value+"&"+"password"+"="+document.getElementById("password").value+"&"+"FirstName"+"="+document.getElementById("fname").value+"&"+"LastName"+"="+document.getElementById("lname").value;
        xhttp.send(param);
        
        } 
     
    
     
 }
    
    
    
  
 </script>

<body>

<div class="container">
            <a class="brand" style="display: flex; justify-content: center; margin-top:10px;" href="#">
                <img src="images/1_Primary_logo_on_transparent_377x63.png" style="height:30px;">
            </a>
</div> <!--container-->


    <nav class="navbar navbar-inverse bg-primary navbar-toggleable-sm">
    
            
            
        <button class="navbar-toggler navbar-toggler-right" type="button" 
            data-toggle="collapse" data-target="#getFundedNavMenu" aria-controls="getFundedNavMenu"
            aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="getFundedNavMenu">

            <div class="nav navbar-nav mr-auto">
                <a class="nav-item nav-link active" href="index.html">Home</a>
                <a class="nav-item nav-link" href="#">Explore</a>
            </div> <!-- navbar -->  
            
            <div class="nav navbar-nav mr-2"> 
                <form class="nav-item form-inline">
                    <input class="form-control" placeholder="Search">
                        <button class="btn btn-info ">
                            <img src="images/698956-icon-111-search-128.png" style="width:16px">
                        </button>
                </form>

                <div class="dropdown">
                    <a class= "nav-item nav-link dropdown-toggle" data-toggle="dropdown" href="#">Account</a> 
                    
                    <div class="dropdown-menu-right dropdown-menu" >
                        
                            <a class="dropdown-item" href="#">Update profile</a>
                            <a class="dropdown-item" href="#">Project stats</a>
                            <a class="dropdown-item" href="#">Project pledged</a>
                            <a class="dropdown-item" href="#">Log out</a>

                    </div>
                </div> <!--dropdown-->

            </div>
        </div> <!-- collapse -->

        
    </nav>


<br>

<div class="container">
    
    <h2 id="top">Project title </h2>
    <h3>Project description</h3><br>
    <h2><?php echo $row['p_description'];?>
    <div class="row">
        <div class="col-sm-8 mr-auto">
            <div class="row">
                
                <img class="col-12" style="height:90%;" src = "images/red.jpg" >

            </div> <!-- inner row -->
            <br>
            <br>
            
        </div> <!-- col-8 -->

        <div class="col-3 form-group">
            <h3>By User: <?php echo $row['owner_id'] ;?> </h3><hr>
            <p><?php echo $row['amt_collected'] ."  "."pledged out of"."  ";?><?php echo $row['max_amt'];?></p>
            
            <p> <?php echo $row1['counter']." "."Backers for this project";?></p>
            <p> <?php echo $row['days'] ." "."days to go";?></p>
            <button class="btn-info" onclick="like1()">Like</button><br><br>
            
                
                <div class="input-group">
                    <span class="input-group-addon">$</span>
                    <input id="pledge" name="minamt" class="form-control" value=10 min=10 type="number" placeholder="min 10$"/>
                <button class="btn btn-success" onclick="test()">Pledge?</button>
                </div>
            
            
        </div><!-- col-4 -->
    </div> <!-- row -->
</div><!--container-->


    <nav class="navbar sticky-top navbar-light bg-faded navbar-toggleable-sm" style="display: flex;
    justify-content:center;">
    
            <div class="nav navbar-nav ">
                <a class="nav-item nav-link active" href="#about">About</a>
                <a class="nav-item nav-link" href="#updates">Updates</a>
            
                <a class= "nav-item nav-link" href="#cmt">Comments</a>
                <a class="nav-item nav-link" href="#faqs">FAQs</a> 
                <a class="nav-item nav-link" href="#top">Top of the page</a> 
            </div>
        
    </nav>


<div class="container" style="margin-top:10px;">
        <hr>
        <div id="about">
            <h2 >About</h2>
            <p> Full description:</p>
            <p>
               <?php echo $row['p_description']; ?>
            </p>
        </div>

        <hr>
        <div id="updates">
            <h2 >Updates</h2>
            <p>Update #1</p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>

            <p>Update #2</p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
        </div>

        <hr>
        <div id="cmt" class="form-group">
            <h2 >Comments</h2>
            <form class="form-group" method="POST" >
                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                    <input type="button" class="btn btn-success" name="comment" value="comment" onclick="commentadd()">
                </div>
                
            </form>
        </div>

        <hr>
        <div id="faqs">
            <h2 >FAQs</h2>
            <ol>
                <li>
                    <p> Project is gonna complete in time?</p>
            <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
            </p>
                </li>

                <li></li>

                <li></li>
            </ol>
            
        </div>
</div>

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>
?>