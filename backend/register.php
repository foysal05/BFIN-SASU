<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Share Your Story</title>
  <script src="vendor/jquery/jquery.min.js"></script>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-register mx-auto mt-5">
      <div class="card-header">Register an Account</div>
      <?php
      if (isset($_GET['exist'])) {
       ?>

       <div class="alert alert-warning alert-dismissible">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <strong>Email Exist!</strong> This email is already exist, Please give another.
      </div>
      <?php
    }else if (isset($_GET['imgtypeE'])) {
     ?>
     <div class="alert alert-warning alert-dismissible">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <strong>Not Image!</strong> Please Select Valid Image.
    </div>
    <?php
  }else if (isset($_GET['error'])) {
   ?>
   <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Error!</strong> Something Wrong.
  </div>
  <?php
}else if (isset($_GET['pass6'])) {
   ?>
   <div class="alert alert-danger alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Warning!</strong> Password Should be Minimum  6 Character .
  </div>
  <?php
}else if (isset($_GET['success'])) {
   ?>
   <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> You have registered successfully .
  </div>
  <?php
}

?>


<div class="card-body">
  <form action="db/db_register.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <div class="form-row">
        <div class="col-md-6">
          <div class="form-label-group">
            <input type="text" id="firstName" class="form-control" name="firstName" placeholder="First name" required="required" autofocus="autofocus">
            <label for="firstName">First name</label>
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-label-group">
            <input type="text" id="lastName" class="form-control" name="lastName" placeholder="Last name" required="required">
            <label for="lastName">Last name</label>
          </div>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="form-label-group">
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required="required">
        <label for="inputEmail">Email address</label>
      </div>
    </div>
    <div class="form-group">
      <div class="form-label-group">
        <input type="text" id="inputPhone" onkeypress="return isNumberKeyDiscount(event)"  class="form-control" name="phone" placeholder="Phone" required="required">
        <label for="inputPhone">Phone</label>
      </div>
    </div>
    <div class="form-group">
      <div class="form-label-group">
        <input type="date" id="inputDOB"  class="form-control" name="dob" required="required">
        <label for="inputDOB">Date of Birth</label>
      </div>
    </div>
          <!-- <fieldset>
            <legend>Gender</legend>

          </fieldset> -->
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="radio" id="inputMale" name="gender" value="Male" class="form-control" placeholder="Password" required="required">
                  <label for="inputMale">Male</label>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="radio" id="inputFemale" value="Female" name="gender" class="form-control" placeholder="Confirm password" required="required">
                  <label for="inputFemale">Female</label>
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="form-label-group">
              <input type="file" id="inputImage" accept=".png,.jpg,.jpeg" name="photo" class="form-control"  required="required">
              <label for="inputImage">Photo</label>
            </div>
          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="Password" onblur="checkLength(this)" class="form-control" name="password" placeholder="Password" required="required">
                  <label for="Password">Password</label>
                </div>
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
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="password" id="ConfirmPassword"  name="ConfirmPassword"  class="form-control" placeholder="Confirm Password" required="required">

                  <label for="ConfirmPassword">Confirm password</label>
                </div>
              </div>
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



          <script type="text/javascript">
            function isNumberKeyDiscount(evt){
              var charCode = (evt.which) ? evt.which : event.keyCode
              if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
                return false;
              return true;
            }

          </script>
          <input type="submit" id="registerButton" style="display: none" name="register" value="Register" class="btn btn-primary btn-block">
        </form>
        <div class="text-center">
          <a class="d-block small mt-3" href="login">Login Page</a>
         <!--  <a class="d-block small" href="forgot-password.html">Forgot Password?</a> -->
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->

  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
