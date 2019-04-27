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
            <li class="active"><a href="index">Home</a></li>
            <li><a href="profile">Profile</a></li>

            <li><a href="logout.php">Logout</a></li>
          <?php }else{ ?>
            <li class="active"><a href="index">Home</a></li>
            <li><a target="_blank" href="register">Registration</a></li>

            <li><a target="_blank" href="login">Login</a></li>
          <?php } ?>




        </ul><br>
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Search Blog..">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button">
              <span class="glyphicon glyphicon-search"></span>
            </button>
          </span>
        </div>
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
            <strong>Wrong!</strong> Email or Password.
          </div>
          <?php
        }
        ?>
        <?php if (isset($_SESSION['login'])==TRUE) { ?>
          <?php include('post_edit.php'); ?>
        <?php } ?>


    </div>
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