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
          <li class="breadcrumb-item active">Administrative</li>
        </ol>


        <a href="administrative"> <button class="btn btn-success"><i class="fas fa-eye"></i> View Administrative List</button></a>
        <br>
        <br>


        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
          Admin Information</div>
          <div class="card-body">
            <div style="padding-left: 15%; padding-right: 15%;">

              <form action="../db/db_admin.php" method="post">


                <div class="form-group">
                  <label>Name</label>
                  <input type="text" value="<?php if(isset($_GET['UAdmin'])){ echo $_GET['name']; } ?>"   required="" placeholder="Full Name" class="form-control" name="name">
                </div> 
                <div class="form-group">
                  <label>Email</label>
                  <input type="email" value="<?php if(isset($_GET['UAdmin'])){ echo $_GET['email']; } ?>"   required="" placeholder="Email Address" class="form-control" name="email">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input type="password" value="<?php if(isset($_GET['UAdmin'])){ echo $_GET['password']; } ?>"  onblur="checkLength(this)"   required="" placeholder="Password" id="Password" class="form-control" name="password">
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
               <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" value="<?php if(isset($_GET['UAdmin'])){ echo $_GET['password']; } ?>"  required="" id="ConfirmPassword" placeholder="Confirm Password" class="form-control" name="cpassword">
                
              </div> 
              <div id="msg"></div>
              <div class="form-group">
<?php
if (isset($_GET['UAdmin'])) {
 ?>
 <input type="hidden" name="id" value="<?php if(isset($_GET['UAdmin'])){ echo $_GET['id']; } ?>" >
<input type="submit" class="btn btn-success btn-block"  id="add_admin" name="update_admin" value="Update">
 <?php
}else{
  ?>
<input type="submit" class="btn btn-success btn-block"  id="add_admin" name="add_admin" value="Add">
  <?php
}

?>
                
              </div> 
              
            </form>
          </div>
        </div>
        <!-- <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div> -->
      </div>
      <script>
        $(document).ready(function(){
          $("#ConfirmPassword").keyup(function(){
           if ($("#Password").val() != $("#ConfirmPassword").val()) {
             $("#msg").html("Password do not match").css("color","red");
             document.getElementById('add_admin').style.display = 'none';
           }else{
             $("#msg").html("Password matched").css("color","green");
             document.getElementById('add_admin').style.display = 'block';
           }
         });
        });
      </script> 
    </div>
    <!-- /.container-fluid -->

    <!-- Sticky Footer -->
    <footer class="sticky-footer">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright © Your Website 2019</span>
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
     
      
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="../logout">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="../vendor/jquery-easing/jquery.easing.min.js"></script>


</body>

</html>
<?php
}else{
  header('location:login/login');
}

?>