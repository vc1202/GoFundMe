<!DOCTYPE html>
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
                <form method="post" action="searchprojects.php" class="nav-item form-inline">
                    <input type="text" name="user-search" id="user-search" class="form-control" placeholder="Search">
                        <button type = "submit" class="btn btn-info ">
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


<div class="container"  style="display:flex; position:relative; justify-content:center; margin-top:20px; height:100%; width:400px; background-color:aqua;">

    <form enctype="multipart/form-data" method="post" action="post_update.php" class="form-group" name="updateproject" id="updateproject"> 

        <fieldset class="form-group">
            <legend><h2>Update project</h2></legend><br>
        </fieldlist>

        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="textupdate">Update text:</label>
                <textarea name="textupdate" form="updateproject" class="form-control"></textarea>
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                <label class="form-group" for="updatevideo">Update video:</label>
                <input type="file" name="updatevideo" id="updatevideo" class="form-control">
                 
            </div>
        </fieldset>

        <fieldset class="form-group">
            <div class="form-group">
                
                <input class="btn btn-success btn-block" name="submit" class="form-control" type="submit" value="Post update!">
                 
            </div>
        </fieldset>
        
    </form>
</div>

<script src="js/jquery.slim.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/scripts.js"></script>
</body>
</html>