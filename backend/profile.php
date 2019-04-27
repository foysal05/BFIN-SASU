 <?php 
session_start();
include('db/db.php');
if (isset($_SESSION['login'])==TRUE) { 
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
            <li ><a href="index">Home</a></li>
            <li class="active"><a href="profile">Profile</a></li>

            <li><a href="logout.php">Logout</a></li>
          <?php }else{ ?>
            <li class="active"><a href="index">Home</a></li>
            <li><a target="_blank" href="register">Registration</a></li>

            <li><a target="_blank" href="login">Login</a></li>
          <?php } ?>




        </ul><br>
        <!-- <div class="input-group">
          <input type="text" class="form-control" placeholder="Search Blog..">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div> -->
      </div>

      <div class="col-sm-9">
        <?php

        if (isset($_GET['deleted'])) {
          ?>
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Delete!</strong> Story Deleted Successfully.
          </div>
          <?php
        } else if (isset($_GET['commented'])) {
          ?>
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Done!</strong> Comment Successfully.
          </div>
          <?php
        }
        ?>
        <hr>
        <?php
        $query="SELECT * FROM users WHERE uid='".$_SESSION['id']."'";
        $result=mysqli_query($con,$query);
//echo mysqli_error();
        if(mysqli_num_rows($result)>0){

          while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

            ?>
            <!-- <div class="container bootstrap snippet"> -->
              <div class="row">
                <div class="col-sm-10">
                  <h1><?php echo $_SESSION['name'].' '.$_SESSION['lastName'];?></h1></div>
                  <div class="col-sm-2">
                    <a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="db/<?php echo $row['photo'];?>"></a>
                  </div>
                </div>

                <div class="col-sm-12">

                  <ul class="nav nav-tabs" id="myTab">
                    <li class="active"><a href="#home" data-toggle="tab">Story</a></li>
                    <!-- <li><a href="#messages" data-toggle="tab">Comment</a></li> -->
                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                  </ul>

                  <div class="tab-content">
                    <div class="tab-pane active" id="home">
                      <div class="table-responsive">
                        <table class="table table-hover">
                          <thead>
                            <tr>

                              <th>Title</th>

                              <th>Caption</th>
                              <th>Tag </th>
                              <th>Status </th>
                              <th>Edit </th>
                              <th>Delete </th>
                            </tr>
                          </thead>
                          <tbody id="items">
                            <?php
                            $queryStory="SELECT * FROM story WHERE post_owner='".$_SESSION['id']."'";
      //echo $queryStory;
                            $resultStory=mysqli_query($con,$queryStory);
//echo mysqli_error();
                            if(mysqli_num_rows($resultStory)>0){

                              while($rowStory=mysqli_fetch_array($resultStory, MYSQLI_ASSOC)){

                                ?>
                                <tr>

                                  <td><?php echo $rowStory['title']; ?></td>

                                  <td><?php echo $rowStory['caption']; ?></td>
                                  <td><?php echo $rowStory['tags']; ?></td>
                 <?php if ($rowStory['s_status']==0) { ?>
               <td><button class="btn btn-danger">Unlisted</button></td>
                  <?php }else{ ?>
                <td><button class="btn btn-success">Listed</button></td>
                   <?php } ?>

                                  <td><a href="story_edit?postId=<?php echo $rowStory['sid']; ?>" class="btn btn-info">Edit</a></td>
                                  <td><a href="db/db_story?DPostId=<?php echo $rowStory['sid']; ?>" class="btn btn-danger">Delete</a></td>
                                </tr>

                                
                                <?php

                              }
                            }
                            ?>
                          </tbody>
                        </table>

                        <hr>
                        <div class="row">
                          <div class="col-md-4 col-md-offset-4 text-center">
                            <ul class="pagination" id="myPager"></ul>
                          </div>
                        </div>
                      </div>
                      <!--/table-resp-->

                      <hr>

                    </div>
                    <!--/tab-pane-->
            <!--     <div class="tab-pane" id="messages">

                    <h2></h2>

                    <ul class="list-group">
                        <li class="list-group-item text-muted">Inbox</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">Here is your a link to the latest summary report from the..</a> 2.13.2014</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">Hi Joe, There has been a request on your account since that was..</a> 2.11.2014</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">Nullam sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">Thllam sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">Wesm sapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">For therepien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">Also we, havesapien massaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>
                        <li class="list-group-item text-right"><a href="#" class="pull-left">Swedish chef is assaortor. A lobortis vitae, condimentum justo...</a> 2.11.2014</li>

                    </ul>

                  </div> -->
                  <!--/tab-pane-->
                  <div class="tab-pane" id="settings">

                    <hr>
                    <form class="form" action="db/db_register.php" method="post" enctype="multipart/form-data" id="registrationForm">

                      <div class="form-group">

                        <div class="col-xs-6">
                          <label for="first_name">
                            <h4>First name</h4></label>
                            <input type="text" class="form-control" name="firstName" value="<?php echo $row['firstName'];?>" id="first_name" placeholder="First Name" title="enter your first name if any.">
                          </div>
                        </div>
                        <div class="form-group">

                          <div class="col-xs-6">
                            <label for="last_name">
                              <h4>Last name</h4></label>
                              <input type="text" class="form-control" name="lastName" value="<?php echo $row['lastName'];?>" id="last_name" placeholder="Last Name" title="enter your last name if any.">
                            </div>
                          </div>



                          <div class="form-group">
                            <div class="col-xs-6">
                              <label for="mobile">
                                <h4>Mobile</h4></label>
                                <input type="text" class="form-control" name="phone" id="mobile" value="<?php echo $row['phone'];?>" placeholder="enter mobile number" title="enter your mobile number if any.">
                              </div>
                            </div>
                            <div class="form-group">

                              <div class="col-xs-6">
                                <label for="email">
                                  <h4>Email</h4></label>
                                  <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email'];?>" placeholder="you@email.com" title="enter your email.">
                                </div>
                              </div>
                              <div class="form-group">

                                <div class="col-xs-6">
                                  <label for="email">
                                    <h4>Date of Birth</h4></label>
                                    <input type="date" class="form-control" name="dob" id="email" value="<?php echo $row['dob'];?>" placeholder="you@email.com" title="enter your email.">
                                  </div>
                                </div>
                                <div class="form-group">

                                  <div class="col-xs-6">
                                    <label for="password">
                                      <h4>Profile Picture</h4></label>
                                      <input type="file" class="form-control" name="newPhoto" id="file">
                                    </div>
                                  </div>



                                  <input type="hidden" name="oldPhoto" value="<?php echo $row['photo']; ?>">
                                  <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">




                                  <div class="form-group">
                                    <div class="col-xs-12">
                                      <br>
                                      <input class="btn btn-lg btn-success" name="update" value="Update" type="submit">
                                     
                                    </div>
                                  </div>
                                </form>
                                <br>
                                <hr>
<h2>===============================================</h2>
                                <fieldset>
                                  <legend>Change Password</legend>
                                </fieldset>
                                <form action="db/db_register.php" method="post">
                                  <div class="form-group">

                                    <div class="col-xs-6">
                                      <label for="password">
                                        <h4>New Password</h4></label>
                                        <input type="password" class="form-control" name="password" id="Password" onblur="checkLength(this)" placeholder="Password" title="enter your password.">
                                      </div>
                                      <script>
                                        function checkLength(el) {
                                          if (el.value.length <= 5) {
                                            alert("New Password Should be Minimum  6 Character");
                     //document.getElementById('registerButton').style.display = 'none';
                   }else{
                     //document.getElementById('registerButton').style.display = 'block';
                   }
                 }
               </script>
             </div>
             <div class="form-group">

              <div class="col-xs-6">
                <label for="password2">
                  <h4>Confirm Password</h4></label>
                  <input type="password" class="form-control" name="password2" id="ConfirmPassword" placeholder="Confirm Password" title="enter your password.">
                  <div id="msg"></div>
                </div>

              </div>
              <script>
                $(document).ready(function(){
                  $("#ConfirmPassword").keyup(function(){
                   if ($("#Password").val() != $("#ConfirmPassword").val()) {
                     $("#msg").html("Password do not match").css("color","red");
                     document.getElementById('registerButton').style.display = 'none';
                   }else{
                     $("#msg").html("Password matched").css("color","green");
                     document.getElementById('registerButton').style.display = 'block';
                   }
                 });
                });
              </script> 

               <div class="form-group">
                                    <div class="col-xs-12">
                                      <br>
                                      <input class="btn btn-lg btn-success" name="passUpdate" value="Update Password" type="submit">
                                     
                                    </div>
                                  </div>

            </form>
          </div>

        </div>
        <!--/tab-pane-->
      </div>
      <!--/tab-content-->

      <!-- </div> -->
      <!--/col-9-->
    </div>
    <!--/row-->


  </div>
  <?php
}
}
?>
</div>
</div>

<footer class="container-fluid">
  <p></p>
</footer>

</body>
</html>

<?php
}else{
  header('location:login');
}

?>
