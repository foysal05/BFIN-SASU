



<form action="db/db_story.php" method="post" name="postForm" id="postForm" enctype="multipart/form-data" onsubmit="return formvalidation()">

  <div class="panel panel-default" id="anonymous" style="background-color:#F1F1F1">
    <div class="panel-heading" style="height:50px">
     <div style="float:left">
      <strong >Post Your Story</strong><h3>
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
                  <option value="<?php echo $rowSection['sec_id']; ?>"><?php echo $rowSection['name']; ?></option>
<?php
}
}
?>
        </select>

      </div>

    </div>

    <div id="post_area" style="display:none;">
      <div class="panel-body">
        <div class="form-group">
          <input type="text" id="title" class="form-control" placeholder="Story Title" required  name="story_title" id="story_title" ><br>

          <textarea class="form-control" name="story_body" maxlength="2000" id="textarea" required style="resize: none;" placeholder="What's on your mind?" onkeyup="countChar(this)"  cols="50" rows="4"></textarea>
        </div>
        <div style="color:black;" id="textarea_feedback"></div><br>
        <input type="text" id="tags" class="form-control" placeholder="Story Tag" required  name="tags" >
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
              <input type="file" id="firstName" accept=".png,.jpg,.jpeg" class="form-control" name="image"  required="required" >
              <!-- <label for="firstName">Image</label> -->
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-label-group">
              <input type="text" id="lastName" class="form-control" name="caption" placeholder="Image Caption" required="required">
              <!--  <label for="lastName">Image Caption</label> -->
            </div>
          </div>
        </div>
      </div>
      <div class="panel-footer">

        <hr class="style5">
        <table>



         <td style="margin-left:70%; float:right;"><button style="margin-left:10%" id="post" title="Check Terms & Conditions" id="submit"  type="submit"  name="post" class="btn btn-primary">Post</button></td>
       </table>

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

 //   $('#postForm').on('submit', function(event){
 //    event.preventDefault();
 //    if($.trim($('#story_title').val()).length == 0)
 //    {
 //     alert("Please Enter Your Name");
 //     return false;
 //   }
 //   else if($.trim($('#tags').val()).length == 0)
 //   {
 //     alert("Please Enter Atleast one Skill");
 //     return false;
 //   }
 // });

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

