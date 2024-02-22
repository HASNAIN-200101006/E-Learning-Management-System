<?php
if(!isset($_SESSION)){ 
  session_start(); 
}
define('TITLE', 'Add Course');
define('PAGE', 'courses');
include('./adminInclude/header.php'); 
include('../dbConnection.php');

 if(isset($_SESSION['is_admin_login'])){
  $adminEmail = $_SESSION['adminLogEmail'];
 } else {
  echo "<script> location.href='../index.php'; </script>";
 }
 if(isset($_REQUEST['courseSubmitBtn'])){
  // Checking for Empty Fields
  if(($_REQUEST['course_name'] == "") || ($_REQUEST['course_desc'] == "") || ($_REQUEST['course_author'] == "") || ($_REQUEST['course_duration'] == "") || ($_REQUEST['course_price'] == "") || ($_REQUEST['course_original_price'] == "")){
   // msg displayed if required field missing
   $msg = '<div class="alert alert-warning col-sm-6 ml-5 mt-2" role="alert"> Fill All Fileds </div>';
  } else {
   // Assigning User Values to Variable
   $course_name = $_REQUEST['course_name'];
   $course_desc = $_REQUEST['course_desc'];
   $course_author = $_REQUEST['course_author'];
   $course_category = $_REQUEST['category'];
   $course_duration = $_REQUEST['course_duration'];
   $course_price = $_REQUEST['course_price'];
   $course_original_price = $_REQUEST['course_original_price'];
   $course_image = $_FILES['course_img']['name']; 
   $course_image_temp = $_FILES['course_img']['tmp_name'];
   $img_folder = '../image/courseimg/'. $course_image; 
   move_uploaded_file($course_image_temp, $img_folder);
    $sql = "INSERT INTO course (course_name, course_desc, course_author, course_img, course_duration, course_price, course_original_price, category) VALUES ('$course_name', '$course_desc','$course_author', '$img_folder', '$course_duration', '$course_price', '$course_original_price', '$course_category')";
    if($conn->query($sql) == TRUE){
     // below msg display on form submit success
     $msg = '<div class="alert alert-success col-sm-6 ml-5 mt-2" role="alert"> Course Added Successfully </div>';
    } else {
     // below msg display on form submit failed
     $msg = '<div class="alert alert-danger col-sm-6 ml-5 mt-2" role="alert"> Unable to Add Course </div>';
    }
  }
  }
 ?>
<div class="col-sm-6 mt-5  mx-3 jumbotron">
  <h3 class="text-center">Add New Course</h3>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="course_name">Course Name</label>
      <input type="text" class="form-control" id="course_name" name="course_name">
    </div>
    <div class="form-group">
      <label for="course_desc">Course Description</label>
      <textarea class="form-control" id="course_desc" name="course_desc" row=2></textarea>
    </div>
    <div class="form-group">
      <label for="course_author">Author</label>
      <input type="text" class="form-control" id="course_author" name="course_author">
    </div>
    <div class="form-group">
      <label for="course_category">Category</label><br>
      <select style="width:100%; padding:0.5rem; background-color:white; border:1px solid #b8d1de; border-radius:3px;" id="course_category" name="category">
        <?php 
          $s = "select categoryName from category";
          $result = mysqli_query($conn, $s);
        ?>
        <?php while($row = mysqli_fetch_array($result)):?>
          <option value="<?php $row['categoryName'] ?>"><?php echo $row['categoryName'];?></option>
        <?php endwhile; ?>
      </select>
    </div>
    <div class="form-group">
      <label for="course_duration">Course Duration</label>
      <input type="text" class="form-control" id="course_duration" name="course_duration">
    </div>
    <div class="form-group">
      <label for="course_original_price">Course Original Price</label>
      <input type="text" class="form-control" id="course_original_price" name="course_original_price" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="course_price">Course Selling Price</label>
      <input type="text" class="form-control" id="course_price" name="course_price" onkeypress="isInputNumber(event)">
    </div>
    <div class="form-group">
      <label for="course_img">Course Image</label>
      <input type="file" class="form-control-file" id="course_img" name="course_img">
    </div>
    <div class="text-center">
      <button type="submit" class="btn btn-danger" id="courseSubmitBtn" name="courseSubmitBtn">Submit</button>
      <a href="courses.php" class="btn btn-secondary">Close</a>
    </div>
    <?php if(isset($msg)) {echo $msg; } ?>
  </form>
</div>
<!-- Only Number for input fields -->
<script>
  function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) {
      evt.preventDefault();
    }
  }
</script>
</div>  <!-- div Row close from header -->
</div>  <!-- div Conatiner-fluid close from header -->

<?php
include('./adminInclude/footer.php'); 
?>