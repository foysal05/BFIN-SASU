 <?php 
session_start();
include('../db/db.php');
if (isset($_SESSION['ad_login'])==TRUE) { 
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>MyStory</title>

  <!-- Custom fonts for this template-->
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">

  <?php include('inc/nav.php');?>

  <div id="wrapper">

    <!-- Sidebar -->
    <?php include('inc/sidebar.php'); ?>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="index">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Story</li>
        </ol>



        <!-- Post Start -->
        <h4><small>RECENT POSTS</small></h4>
        <hr>
        <?php
        $query="";
        if (isset($_POST['search'])) {
         $valueToSearch=$_POST['searchInput'];
         $query="SELECT * FROM story,users,section WHERE `story`.post_owner=users.uid and `story`.section=section.sec_id  And  CONCAT(`title`, `body`, `section`, `tags`)  LIKE '%".$valueToSearch."%' ORDER BY sid DESC";
       }else{
        $query="SELECT * FROM story,users,section WHERE `story`.post_owner=users.uid and `story`.section=section.sec_id  ORDER BY sid DESC";
      }

      $result=mysqli_query($con,$query);
//echo mysqli_error();
      if(mysqli_num_rows($result)>0){

        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

          ?>
          <div <?php if ($row['s_status']=='0'): echo "style='color:red'";?>
          
          <?php endif ?>>
          <h2><?php echo $row['title'];?></h2>
          <img src="../db/<?php echo $row['image'];?>" height="500" width="700">
          <p><?php echo $row['caption'];?></p>
          <h5><span class="glyphicon glyphicon-time"></span> Post by <?php echo $row['firstName'];?>, <?php echo $row['datetime'];?>. [Section: <?php echo $row['name'];?>]</h5>
          <h5><span class="label label-success"><?php echo $row['tags'];?></span></h5><br>
          <p><?php echo $row['body'];?>.</p>
        </div>
        <hr>
        <form action="../db/db_story.php" method="post">
         <input type="hidden" name="id" value="<?php echo $row['sid']; ?>">
         <?php

         if ($row['s_status']=='1') {
           ?>
           <input type="submit" class="btn btn-danger" name="block" value="Block">
           <?php
         }else{
          ?>
          <input type="submit" class="btn btn-success" name="unblock" value="Unblock">
          <?php

        }
        ?>
        <input type="submit" class="btn btn-danger" name="delete" value="Delete">
      </form>
      <!-- Comment Section -->
              <!-- <h4>Leave a Comment:</h4>
              <form role="form" action="db/db_comment.php" method="post">
                <input type="hidden" name="post_id" value="<?php echo $row['sid'];?>">
                <div class="form-group">
                  <textarea class="form-control" name="comment_body" rows="3" required></textarea>
                </div>
                <button type="submit" name="comm" class="btn btn-success">Submit</button>
              </form>
              <br><br> -->

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
                      <img src="../db/<?php echo $rowComment['photo'];?>" class="img-circle" height="65" width="65" alt="Avatar">
                    </div>
                    <div class="col-sm-10">
                      <h4><?php echo $rowComment['firstName'];?><small><?php echo " ".$rowComment['datetime'];?></small></h4>
                      <p><?php echo $rowComment['comment'];?>.</p>
                      <form action="../db/db_comment.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $rowComment['cid']; ?>">
                        <input type="submit" name="commDelete" value="Delete" class="btn btn-danger">
                      </form>
                      <br>
                    </div>
                    <?php
                  }
                }

                ?>
                <!-- End Of Comment Section -->


              </div>


              <?php
            }
          }else{
            echo "<h2>Story Not Found</h2>";
          }

          ?>

        </div>
        <!-- /.container-fluid -->

        <!-- Sticky Footer -->
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © MyStory 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="login.html">Logout</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin.min.js"></script>

    <!-- Demo scripts for this page-->
    <script src="../js/demo/datatables-demo.js"></script>
    <script src="../js/demo/chart-area-demo.js"></script>

  </body>

  </html>
  <?php
}else{
  header('location:login/login');
}

?>
