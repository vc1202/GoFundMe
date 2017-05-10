<?php session_start(); 
error_reporting(0);
$servername = "localhost";
$usernam = "root";
$password = "";
$dbname = "project";
$connection = new mysqli($servername,$usernam,$password,$dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} 
$id=mysql_real_escape_string($_SESSION['username']);
$sql="Select like_user_id,like_project_id FROM `like` join (Select followee from follow where follower='$id')V on like.like_user_id=V.followee and TIMESTAMPDIFF(DAY,like_date,NOW())<20";

if($resultquery=$connection->query($sql)!=true)
{
    
 echo "Error in Sql";   
    
}



$user_id = mysql_real_escape_string($_SESSION['username']);

$tag="SELECT project_id, p_title, p_description, imagename FROM project where p_tags in (SELECT tagname from taghistory where user_id='$user_id')";

$tag2="SELECT project_id, p_title, p_description, imagename FROM project order by pledge_start_date desc limit 5";

$tagresult=$connection->query($tag);

$tagresult2=$connection->query($tag2);
$search="Select * from user_recommendation where user_id='$user_id'";
$result=$connection->query($search);




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

<div class="container">
            <a class="brand" style="display: flex; justify-content: center; margin-top:10px;" href="user-wall.php">
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
                <a class="nav-item nav-link active" href="user-wall.php">Home</a>
                <a class="nav-item nav-link" href="#">Explore</a>
            </div> <!-- navbar -->  
            
            <div class="nav navbar-nav mr-2"> 
                <form method="post" action="searchprojects.php" class="nav-item form-inline">
                    <input type="text" name="usersearch" id="usersearch" class="form-control" placeholder="Search" required/>
                        <button type="submit" class="btn btn-info ">
                            <img src="images/698956-icon-111-search-128.png" style="width:16px">
                        </button>
                </form>

                <div class="dropdown">
                    <a class= "nav-item nav-link dropdown-toggle" data-toggle="dropdown" href="#">Account</a> 
                    
                    <div class="dropdown-menu-right dropdown-menu" >
                        

                            <a class="dropdown-item" href="project_stats.php">Project stats</a>
                            <a class="dropdown-item" href="searchbytag.php">Search by tag</a>
                            <a class="dropdown-item" href="list_projects.php">Project list</a>
                            <a class="dropdown-item" href="projects_pledged.php">Project pledged</a>
                            <a class="dropdown-item" href="project_complete.php">complete a project?</a>
                            <a class="dropdown-item" href="logout.php">Log out</a>

                    </div>
                </div> <!--dropdown-->

            </div>
        </div> <!-- collapse -->

        
    </nav>

<div class="container">
    <h2> <?php echo "Welcome"." ".$_SESSION['username']; ?></h2>
</div>

    <!-- #region Jssor Slider Begin -->
    <script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
    <script src="js/jssor.slider-23.1.5.mini.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery(document).ready(function ($) {

            var jssor_1_SlideoTransitions = [
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideDuration: 800,
              $SlideEasing: $Jease$.$OutQuint,
              $CaptionSliderOptions: {
                $Class: $JssorCaptionSlideo$,
                $Transitions: jssor_1_SlideoTransitions
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $BulletNavigatorOptions: {
                $Class: $JssorBulletNavigator$
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*responsive code begin*/
            /*remove responsive code if you don't want the slider scales while window resizing*/
            function ScaleSlider() {
                var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
                if (refSize) {
                    refSize = Math.min(refSize, 1920);
                    jssor_1_slider.$ScaleWidth(refSize);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }
            ScaleSlider();
            $(window).bind("load", ScaleSlider);
            $(window).bind("resize", ScaleSlider);
            $(window).bind("orientationchange", ScaleSlider);
            /*responsive code end*/
        });
    </script>
    <style>
        /* jssor slider bullet navigator skin 05 css */
        /*
        .jssorb05 div           (normal)
        .jssorb05 div:hover     (normal mouseover)
        .jssorb05 .av           (active)
        .jssorb05 .av:hover     (active mouseover)
        .jssorb05 .dn           (mousedown)
        */
        .jssorb05 {
            position: absolute;
        }
        .jssorb05 div, .jssorb05 div:hover, .jssorb05 .av {
            position: absolute;
            /* size of bullet elment */
            width: 16px;
            height: 16px;
            background: url('images/b05.png') no-repeat;
            overflow: hidden;
            cursor: pointer;
        }
        .jssorb05 div { background-position: -7px -7px; }
        .jssorb05 div:hover, .jssorb05 .av:hover { background-position: -37px -7px; }
        .jssorb05 .av { background-position: -67px -7px; }
        .jssorb05 .dn, .jssorb05 .dn:hover { background-position: -97px -7px; }

        /* jssor slider arrow navigator skin 22 css */
        /*
        .jssora22l                  (normal)
        .jssora22r                  (normal)
        .jssora22l:hover            (normal mouseover)
        .jssora22r:hover            (normal mouseover)
        .jssora22l.jssora22ldn      (mousedown)
        .jssora22r.jssora22rdn      (mousedown)
        .jssora22l.jssora22lds      (disabled)
        .jssora22r.jssora22rds      (disabled)
        */
        .jssora22l, .jssora22r {
            display: block;
            position: absolute;
            /* size of arrow element */
            width: 40px;
            height: 58px;
            cursor: pointer;
            background: url('images/a22.png') center center no-repeat;
            overflow: hidden;
        }
        .jssora22l { background-position: -10px -31px; }
        .jssora22r { background-position: -70px -31px; }
        .jssora22l:hover { background-position: -130px -31px; }
        .jssora22r:hover { background-position: -190px -31px; }
        .jssora22l.jssora22ldn { background-position: -250px -31px; }
        .jssora22r.jssora22rdn { background-position: -310px -31px; }
        .jssora22l.jssora22lds { background-position: -10px -31px; opacity: .3; pointer-events: none; }
        .jssora22r.jssora22rds { background-position: -70px -31px; opacity: .3; pointer-events: none; }
    </style>
    <div id="jssor_1" style="position:relative;margin:0 auto; top:10px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;">
        <!-- Loading Screen -->
        <div data-u="loading" style="position:absolute;top:0px;left:0px;background-color:rgba(0,0,0,0.7);">
            <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
            <div style="position:absolute;display:block;background:url('images/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
        </div>
        <div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;">


        <?php
            while($rowtag2=$tagresult2->fetch_assoc()){
                    echo '<div><a class="tabindex" href=view_project.php?id=' . $rowtag2['project_id'] . ">";
                    echo '<img height=500 width=1300 src = ' .$rowtag2['imagename'] . ' ></a></div>';
                   

            }
            
             ?>
            
        </div>
        <!-- Bullet Navigator -->
        <div data-u="navigator" class="jssorb05" style="bottom:16px;right:16px;" data-autocenter="1">
            <!-- bullet navigator item prototype -->
            <div data-u="prototype" style="width:16px;height:16px;"></div>
        </div>
        <!-- Arrow Navigator -->
        <span data-u="arrowleft" class="jssora22l" style="top:0px;left:8px;width:40px;height:58px;" data-autocenter="2"></span>
        <span data-u="arrowright" class="jssora22r" style="top:0px;right:8px;width:40px;height:58px;" data-autocenter="2"></span>
    </div>
    <!-- #endregion Jssor Slider End -->
<br>
<br>
<hr>
<div class="container">
    



    <h2>Recommended </h2>
    <div class="row">
        <div class="col-sm-8 mr-auto">
            <div class="row">

            <?php
            while($rowtag=$tagresult->fetch_assoc()){
                    echo "<section class=col-sm-6>";
                    echo '<a class="tabindex" href=view_project.php?id=' . $rowtag['project_id'] . ">";
                    echo '<img width="100" height="100" src = ' .$rowtag['imagename'] . ' >';
                    echo "<h4> ". $rowtag['p_title'] . "</h4>";
                    echo "<p>" . $rowtag['p_description'] ."</p>";
                    echo "</section></a>";

            }
            
             ?>
                <?php while($row=$result->fetch_assoc())
                {
                    $key=row['searchkey'];
                    $newsql="Select * from project where p_description like %$key%";
                    $resultnew=$connection->query($newsql);
                    while($row=$resultnew->fetch_assoc()){
                      echo "<section class=col-sm-6>";
                    echo '<a class="tabindex" href=view_project.php?id=' . $rowtag['project_id'] . ">";
                    echo '<img width="100" height="100" src = ' .$rowtag['imagename'] . ' >';
                    echo "<h4> ". $rowtag['p_title'] . "</h4>";
                    echo "<p>" . $rowtag['p_description'] ."</p>";
                    echo "</section></a>";   
                        
                        
                        
                    }
                    
                } ?>

                


            </div> <!-- inner row -->
            <br>
            <br>
            
        </div> <!-- col-8 -->

<hr style="width:1; size:500;">
        <div class="col-3 mr-3">
            <h2>Activities: </h2>
            <hr>
            <?php while($row=$resultquery->fetch_assoc()){?>
            <p> User <?php echo $row['like_user_id']?> Followed Project <?php echo $row['like_project_id']?></p>
            <?php }?>
        </div><!-- col-4 -->
    </div> <!-- row -->
            
</div><!--container-->


<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>