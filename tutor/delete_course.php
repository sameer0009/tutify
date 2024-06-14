<?php
 include ('../dbcon.php');

  if(isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];
    $sql = "DELETE FROM course WHERE course_id='$course_id'";
    if(mysqli_query($con, $sql)) {
      header("Location: addcourse.php");
      exit();
    } 
}
?>



<?php
include('../dbcon.php');

if (isset($_POST['course_id'])) {
    $course_id = $_POST['course_id'];

    // Perform the actual deletion query
    $delete_query = "DELETE FROM course WHERE course_id = '$course_id'";
    $result = mysqli_query($con, $delete_query);

    if ($result) {
        echo '<script>alert("Course deleted successfully!");</script>';
        header('Location: addcourse.php'); // Redirect back to your courses page
        exit();
    } else {
        echo '<script>alert("Failed to delete course. Please try again later.");</script>';
    }
}
?>
