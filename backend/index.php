 <?php 
session_start();
include('db/db.php');
//if (isset($_SESSION['login'])==TRUE) { 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>MyStory</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!-- Tagging -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>

  <style>
  /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
  .row.content {height: 1500px}

  /* Set gray background color and 100% height */
  .sidenav {
    background-color: #f1f1f1;
    height: 100%;
  }

  /* Set black background color, white text and some padding */
  footer {
    background-color: #555;
    color: white;
    padding: 15px;
  }

  /* On small screens, set height to 'auto' for sidenav and grid */
  @media screen and (max-width: 767px) {
    .sidenav {
      height: auto;
      padding: 15px;
    }
    .row.content {height: auto;} 
  }
</style>
</head>
<body>

  <div class="container-fluid">
    <div class="row content">
      <div class="col-sm-3 sidenav">
        <h4>MyStory</h4>

        <ul class="nav nav-pills nav-stacked">

          <?php if (isset($_SESSION['login'])==TRUE) { ?>
            <li><a href="index">Login As <?php echo $_SESSION['name']; ?></a></li>
            <li class="active"><a href="index">Home</a></li>
            <li><a href="profile">Profile</a></li>

            <li><a href="logout.php">Logout</a></li>
          <?php }else{ ?>
            <li class="active"><a href="index">Home</a></li>
            <li><a target="_blank" href="register">Registration</a></li>

            <li><a target="_blank" href="login">Login</a></li>
          <?php } ?>




        </ul><br>
        <form action="" method="post">
          
        
        <div class="input-group">
          <input type="text" class="form-control" name="searchInput" placeholder="Search Blog..">
          <span class="input-group-btn">
            <button class="btn btn-default" name="search" type="submit">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
        </form>
      </div>

      <div class="col-sm-9">
        <?php

        if (isset($_GET['success'])) {
          ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> You Are Login Successfully.
          </div>
          <?php
        } else if (isset($_GET['commented'])) {
          ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Done!</strong> Comment Successfully.
          </div>
          <?php
        }if (isset($_GET['error'])) {
          ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Problem!</strong> Something problem.
          </div>
          <?php
        }
        ?>
        <?php if (isset($_SESSION['login'])==TRUE) { ?>
          <?php include('post.php'); ?>
        <?php } ?>

        <!-- Post Start -->
        <h4><small>RECENT POSTS</small></h4>
        <hr>
        <?php
        $query="";
        if (isset($_POST['search'])) {
         $valueToSearch=$_POST['searchInput'];
         $query="SELECT * FROM story,users,section WHERE `story`.post_owner=users.uid and `story`.section=section.sec_id AND story.s_status<>0 And  CONCAT(`title`, `body`, `section`, `tags`)  LIKE '%".$valueToSearch."%' ORDER BY sid DESC";
        }else{
          $query="SELECT * FROM story,users,section WHERE `story`.post_owner=users.uid and `story`.section=section.sec_id AND story.s_status<>0 ORDER BY sid DESC";
        }
        
        $result=mysqli_query($con,$query);
//echo mysqli_error();
        if(mysqli_num_rows($result)>0){

          while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

            ?>

            <h2><?php echo $row['title'];?></h2>
            <img src="db/<?php echo $row['image'];?>" height="500" width="700">
            <p><?php echo $row['caption'];?></p>
            <h5><span class="glyphicon glyphicon-time"></span> Post by <?php echo $row['firstName'];?>, <?php echo $row['datetime'];?>. [Section: <?php echo $row['name'];?>]</h5>
            <h5><span class="label label-success"><?php echo $row['tags'];?></span></h5><br>
            <p><?php echo $row['body'];?>.</p>
            <hr>
            <?php if (isset($_SESSION['login'])==TRUE) { ?>
              <!-- Comment Section -->
              <h4>Leave a Comment:</h4>
              <form role="form" action="db/db_comment.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $row['sid'];?>">
                <div class="form-group">
                  <textarea class="form-control" name="comment_body" rows="3" required></textarea>
                </div>
                <button type="submit" name="comm" class="btn btn-success">Submit</button>
              </form>
              <br><br>

              <p><span class="badge">

                <?php
                $sql="SELECT * FROM comment,users WHERE `comment`.commentOwner=users.uid AND post_id='".$row['sid']."'";
                $CountResult = mysqli_query($con,$sql);
                $rowcount=mysqli_num_rows($CountResult);
                if ($rowcount>0) {
                  echo $rowcount;
                }else{
                  echo "No ";
                }


                ?>

              </span> Comments:</p><br>

              <div class="row">
                <?php
                $queryComment="SELECT * FROM comment,users WHERE `comment`.commentOwner=users.uid AND post_id='".$row['sid']."'";
//echo $queryComment;
                $resultComment=mysqli_query($con,$queryComment);
//echo mysqli_error();
                if(mysqli_num_rows($resultComment)>0){

                  while($rowComment=mysqli_fetch_array($resultComment, MYSQLI_ASSOC)){
                    ?>
                    <div class="col-sm-2 text-center">
                      <img src="db/<?php echo $rowComment['photo'];?>" class="img-circle" height="65" width="65" alt="Avatar">
                    </div>
                    <div class="col-sm-10">
                      <h4><?php echo $rowComment['firstName'];?><small><?php echo " ".$rowComment['datetime'];?></small></h4>
                      <p><?php echo $rowComment['comment'];?>.</p>
                      <br>
                    </div>
                    <?php
                  }
                }

                ?>
                <!-- End Of Comment Section -->


            </div>
            <?php
              }else{
                echo "<p style='color:red'>Please Complete Registration/Login Process to Drop Your Comment</p>";
              }
              ?>
            <!-- Post End -->
            <?php
          }
        }else{
          echo "<h2>Story Not Found</h2>";
        }

        ?>
      </div>
    </div>
  </div>

  <footer class="container-fluid">
    <p></p>
  </footer>

</body>
</html>

