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


            <a href="add_admin"><button class="btn btn-success"><i class="fas fa-user-plus"></i> Add New Administrative</button></a>
            <br>
            <br>


            <!-- DataTables Example -->
            <div class="card mb-3">
              <div class="card-header">
                <i class="fas fa-table"></i>
              Administrative List</div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>

                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>

                        <th>Status</th>
                        <th>Edit</th>
                        <th>Delete</th>
                      </tr>
                    </tfoot>
                    <tbody>
                      <?php
                      $query="SELECT * FROM admins";
                      $result=mysqli_query($con,$query);
  //echo mysqli_error();
                      if(mysqli_num_rows($result)>0){

                        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){

                          ?>
                          <tr>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>


                            <?php
                            if ($row['aid']<>$_SESSION['id']) {



                              if ($row['status']=='0') { 

                                ?>
                                <td><a class="btn btn-danger" href="../db/db_admin.php?status=2&id=<?php echo $row['aid'];?>">Deactivate</a></td>
                                <?php
                              }else{ 
                                ?>
                                <td><a class="btn btn-success" href="../db/db_admin.php?status=0&id=<?php echo $row['aid'];?>">Active</a></td>

                                <?php 
                              }
                            }else{
                              if ($row['status']=='0') { 
                                ?>
                                <td>Deactivate</a></td>
                              <?php }else{ ?>
                               <td>Active</td>

                               <?php
                             }
                           }



                           ?>


                           <td><a class="btn btn-info" href="add_admin.php?UAdmin&id=<?php echo $row['aid'];?>&name=<?php echo $row['name'];?>&email=<?php echo $row['email'];?>&password=<?php echo $row['password'];?>"><i class="fas fa-edit"></i> Edit</a></td>
                           <?php
                           if ($row['aid']<>$_SESSION['id']) { ?>
                             <td><a class="btn btn-danger" href="../db/db_admin.php?ADelete&id=<?php echo $row['aid'];?>"><i class="fas fa-trash-alt"></i> Delete</a></td>
                           <?php }else{ echo "<td><p style='color:red'>Restricted</p></td>"; }?>

                         </tr>
                         <?php
                       }
                     }
                     ?>      
                   </tbody>
                 </table>
               </div>
             </div>
             
           </div>

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