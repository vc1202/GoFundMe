<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/styles.css">
  <script src="js/jquery.validate.min.js"></script>
  <title>GetFunded</title>

</head>

<body>
    
<?php
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
   

    $connection=connect();
    $userid=mysql_real_escape_string($_SESSION['username']);
    
    $sql="Select project_id,status,p_title from project WHERE owner_id='$userid'";
    
    $result=$connection->query($sql);
    
    
    ?>




<div class="container">
            <a class="brand" style="display: flex; justify-content: center; margin-top:10px;" href="index.html">
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

<div class="container">

    <br>
    <h2 style="display:flex; justify-content:center;" class="text-muted">List of projects pledged</h2>

    <table class="table table-hover">
        <tr class="text-danger">
            <th>Project id</th>
            <th>Project name</th>
            <th>status</th>
            <th>Rating</th>
        </tr>
<?php while($row=$result->fetch_assoc())
{ ?>
        
        <?php 
        $pid=$row['project_id'];
        $sql2="Select rating from rating where r_user_id='$userid' AND r_project_id='$pid'";
        $result2=$connection->query($sql2);
        
        
        ?>
        
        <tr>
            <td><?php echo $row['project_id']?></td> <!--project id-->
            <td><?php echo $row['p_title']?></td> <!--project name-->
            <td><?php echo $row['status']?></td><!--project status-->
            <td>
            <?php if($row['status']==='complete' && $result2->num_rows==0 )
            { ?>
            
                <select class="form-control" name="projectrating">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
              
            <?php } ?> 
                
                <?php if($row['status']==='complete' && $result2->num_rows > 0 )
            { 
                echo "You have already rated this Project!";
              } ?>
           
            <?php
            if($row['status']!=='complete') { ?>
               <?php echo "Ratings only for complete projects" ?>
                
                
                
                
                
           <?php } ?>
                  </td>
            <?php } ?>
            
        

 

    </table>
    
    <button class="btn btn-success"> Rate! </button>

</div>

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>