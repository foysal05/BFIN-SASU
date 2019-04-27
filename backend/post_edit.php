
<?php
$query="SELECT * FROM story WHERE sid='".$_GET['postId']."'";
$result=mysqli_query($con,$query);
//echo mysqli_error();
if(mysqli_num_rows($result)>0){
  while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $section=$row['section'];

    ?>


    <form action="db/db_story.php" method="post" name="postForm" id="postForm" enctype="multipart/form-data" onsubmit="return formvalidation()">

      <div class="panel panel-default" id="anonymous" style="background-color:#F1F1F1">
        <div class="panel-heading" style="height:50px">
         <div style="float:left">
          <strong >Edit Your Story</strong><h3>
          </div>
          <div style="float:right">

            <select id="category" autofocus="autofocus" required class="form-control" name="section" onchange="showHide(this)" >
              <option value="">Select Section</option>
              <?php
              $querySection="SELECT * FROM section";
              $resultSection=mysqli_query($con,$querySection);
//echo mysqli_error();
              if(mysqli_num_rows($resultSection)>0){
                while($rowSection=mysqli_fetch_array($resultSection, MYSQLI_ASSOC)){
                  ?>
                  <?php echo "<option value='" . $rowSection['sec_id'] . "'"?>
                  <?php if($section==$rowSection['sec_id']) echo "selected"; ?> 
                  <?php echo ">" . $rowSection['name'] . "</option>"; ?>
                  <?php
                }
              }
              ?>

            </select>

          </div>

        </div>
<input type="hidden" name="sid" value="<?php echo $_GET['postId']; ?>">
        <div id="post_area">
          <div class="panel-body">
            <div class="form-group">
             
<img src="db/<?php echo $row['image']; ?>" height:"500" width="350">
</br>
</br>
 <input type="text" id="title" value="<?php echo $row['title']; ?>" class="form-control" placeholder="Story Title" required  name="story_title" id="story_title" ><br>
              <textarea class="form-control"  name="story_body" maxlength="2000" id="textarea" required style="resize: none;" placeholder="What's on your mind?" onkeyup="countChar(this)"  cols="50" rows="4"><?php echo $row['body']; ?></textarea>
            </div>
            <div style="color:black;" id="textarea_feedback"></div><br>
            <input type="text" id="tags" value="<?php echo $row['tags']; ?>" class="form-control" placeholder="Story Tag" required  name="tags" >
            <script>
              $(document).ready(function() {
                var text_max = 2000;
                $('#textarea_feedback').html(text_max + ' characters remaining');

                $('#textarea').keyup(function() {
                  var text_length = $('#textarea').val().length;
                  var text_remaining = text_max - text_length;

                  $('#textarea_feedback').html(text_remaining + ' characters remaining');
                });
              });
            </script>

          </div>
          <div class="form-group">
            <div class="form-row">
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="file" id="" accept=".png,.jpg,.jpeg" class="form-control" name="image"  >
                  <input type="hidden" value="<?php echo $row['image']; ?>" name="oldImage">
                  <!-- <label for="firstName">Image</label> -->
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-label-group">
                  <input type="text" id="" value="<?php echo $row['caption']; ?>" class="form-control" name="caption" placeholder="Image Caption" required="required">
                  <!--  <label for="lastName">Image Caption</label> -->
                </div>
              </div>
            </div>
          </div>
          <div class="panel-footer">

            <hr class="style5">
            <table>



             <td style="margin-left:70%; float:right;"><button style="margin-left:10%" id="post" title="Check Terms & Conditions" id="submit"  type="submit"  name="update" class="btn btn-primary">Update</button></td>
           </table>
           <?php
         }
       }

       ?>
       <script type="text/javascript">

        function showHide(elem) {
          if(elem.selectedIndex != 0) {

            document.getElementById('post_area').style.display = 'block';
          }else if(elem.selectedIndex == 0) {

            document.getElementById('post_area').style.display = 'none';
          }
        }

        window.onload=function() {
    //get the divs to show/hide
    divsO = document.getElementById("frmMyform").getElementsByTagName('post_area');
  }
</script>
<script>
  $(document).ready(function(){

   $('#tags').tokenfield({
    autocomplete:{
     source: ['Comedy','Horror','Romantic','Religion','War','Ghost'],
     delay:100
   },
   showAutocompleteOnFocus: true
 });


 });
</script>
<script type="text/javascript">
  function formvalidation() {
    var tags = document.forms["postForm"]["tags"].value;
    if (tags == "") {
      alert("Please Enter Atleast one Story Tag");
      return false;
    }
  }
</script>
</div>
</div>
</div>
</form>

