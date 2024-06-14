<?php
session_start();
$_SESSION['user_name'];
$_SESSION['id'];
$instruct_id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Course</title>
  <link rel="stylesheet" href="../css/addcourse.css">
  

</head>
<?php
 include('../dbcon.php');
 $user=$_SESSION['user_name'];
 
if(isset($_POST['submit'])){
   $file=$_FILES['file'];
   //print_r($file);

    $course_image=$_FILES['file']['name'];
    $course_image_temp=$_FILES['file']['tmp_name'];
    $course_image_error=$_FILES['file']['error'];
    $target="../uploads/" .$course_image;
    $course_name=mysqli_real_escape_string($con,$_POST['coursename']);
    $course_price=mysqli_real_escape_string($con,$_POST['courseprice']);
    $course_instructor=mysqli_real_escape_string($con,$_POST['courseinstructor']);
    $instructor_id=mysqli_real_escape_string($con,$_POST['instructor_id']);

    $course_description=mysqli_real_escape_string($con,$_POST['coursedescription']);
    $course_duration=mysqli_real_escape_string($con,$_POST['courseduration']);
    

    $sql="INSERT INTO `tutify`.`course`(`course_name`,`course_intsructor`, `course_duration`, `course_price`, `course_description`,`course_image`,`instructor_id`) VALUES ('$course_name','$course_instructor','$course_duration','$course_price','$course_description','$course_image','$instructor_id')";
   // echo $sql;
    

    if (move_uploaded_file($course_image_temp,$target)) {
      mysqli_query($con,$sql);
      
      echo '<script>alert("Course added successfully!");</script>';
  } else {
  echo '<script>alert("Failed to upload file, handle error");</script>';
}

}

?>
<body>
  <?php
  if (!isset($_SESSION['user_name'])) {
    header('Location: ../signin.php'); // redirect to the login page if the student is not logged in
    exit();
  }
  ?>
  

  <?php include('./t_head.php'); ?>

  <!-- Navigation Bar -->
  <?php include('./t_header.php'); ?>
  <!-- End of Navigation Bar -->

  <!-- Form -->
  <div class="container col-md-11">
    <h2 >Add New Course</h2>
    <form action="addcourse.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
        <div class="d-flex justify-content-center">
          <div class="btn btn-primary btn-rounded">
            <label class="form-label text-white m-1" for="customFile1">Choose file</label>
            <input type="file" name="file" />
            <p> kindly upload .jpg , .jpeg , .png </p>
          </div>
        </div>
      </div>

      <div class="form-group">
        <label for="coursename">Enter Course Name</label>
        <input type="text" class="form-control" id="coursename" placeholder="Enter Course Name" name="coursename">
      </div>

      <div class="form-group">
       
        <input type="hidden" class="form-control" id="courseinstructor" name="courseinstructor" value="<?php echo $_SESSION['user_name']?>">
                <input type="hidden" class="form-control" id="instructor_id" name="instructor_id" value="<?php echo $_SESSION['id']?>">

      </div>

      <div class="form-group">
        <label for="courseprice">Enter Course Price</label>
        <input type="text" class="form-control" id="courseprice" placeholder="Enter Course Price" name="courseprice" required>
      </div>

      <div class="form-group">
        <label for="courseduration">Enter Course Duration</label>
        <input type="text" class="form-control" id="courseduration" placeholder="Enter Course Duration" name="courseduration" required>
      </div>

      <div class="form-group">
        <label for="coursedescription">Course Description</label>
        <textarea class="form-control" id="coursedescription" rows="5" name="coursedescription" required ></textarea>
      </div>

      <button class="btn btn-primary" type="submit" name="submit" value="submit">Submit</button>
    </form>
  </div>

  <!-- Course Cards -->
  <div class="container col-md-11">
  <h2>Courses List</h2>
  <div class="row">
    <?php 
    include('../dbcon.php');
    $query = "SELECT * FROM course WHERE course_intsructor='$user'";
    $query_run = mysqli_query($con, $query);
    $course = mysqli_num_rows($query_run);
    
    if ($course > 0) {
      while ($row = mysqli_fetch_array($query_run)) {
    ?>
        <div class="col-md-4">
          <div class="card" style="background-color: #a3c9f0; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); margin-bottom: 40px; position: relative;">
            <div class="card-body">
              <h4 class="card-title" style="color: #333; font-size: 20px; font-weight: bold; margin-bottom: 10px;"><?php echo $row['course_name']; ?></h4>
              <p class="card-title" style="font-size: 16px; margin-bottom: 5px;"><b>ID:</b> <?php echo $row['course_id']; ?></p>
              <p class="card-title" style="font-size: 16px; margin-bottom: 5px;"><b>Duration:</b> <?php echo $row['course_duration']; ?></p>
              <p class="card-text" style="font-size: 16px; margin-bottom: 5px;"><b>Price:</b> <?php echo $row['course_price']; ?> PKR</p>
              <p class="card-text" style="font-size: 16px;"><b>Description:</b> <?php echo $row['course_description']; ?></p>
              <div class="btn-group" role="group" aria-label="Actions" style="position: absolute; bottom: 0; left: 3; margin-bottom: 15px;">
                <a href="course_content.php?course_id=<?php echo $row['course_id']; ?>" class="btn btn-primary" style="font-size: 14px;">Details</a>
              </div>
              <br><br>
              <div class="btn-group" role="group" aria-label="Actions" style="position: absolute; bottom: 0; right: 5px; margin-bottom: 15px;">
               <form action="delete_course.php" method="post" onsubmit="return confirm('Are you sure you want to delete this course?');">
                <input type="hidden" name="course_id" value="<?php echo $row['course_id']; ?>">
                <button type="submit" class="btn btn-danger" style="font-size: 14px;">Delete</button>
            </form>

              </div>
            </div>
          </div>
        </div>
    <?php
      }
    }
    ?>
  </div>
</div>


  
</body>
</html>
