<?php
session_start();

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $courseId = $_POST['course_id'];

  // Store the checked content IDs in the session
  $_SESSION['checked_content'][$courseId] = isset($_POST['content_checkbox']) ? $_POST['content_checkbox'] : [];
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
<!-- Libraries Stylesheet -->
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="../css/enrolled_course_material_styles.css">
<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  // Update progress bar on checkbox change
  $('input[name="content_checkbox[]"]').change(function() {
    var totalContentCount = <?php echo $totalContentCount; ?>;
    var completedContentCount = $('input[name="content_checkbox[]"]:checked').length;
    var progressPercentage = (completedContentCount / totalContentCount) * 100;

    $('.progress-bar').css('width', progressPercentage + '%');
    $('.progress-bar').attr('aria-valuenow', progressPercentage);
    $('.progress-bar').text(progressPercentage + '%');
  });
});
</script>
</head>

<body>
<nav class="navbar navbar-expand-lg font-semibold">
  <a class="navbar-brand" href="#"><?php echo ucwords($_SESSION["user_name"]); ?></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav  mx-8">
      <li class="nav-item mx-8">
        <a class="nav-link"  href="#">Join Class</a>
      </li>
      <li class="nav-item mx-8">
        <a class="nav-link" target="_blank" href="./assessment.php?course_id=<?php echo $_POST['course_id']; ?>">Course Assessments</a>
      </li>
      <li class="nav-item mx-8">
        <a class="nav-link" target="_blank" href="./grades.php?course_id=<?php echo $_POST['course_id']; ?>">Grades</a>
      </li>
    </ul>
  </div>
  <a class="btn btn-primary" href="./enrolled_courses.php">Back</a>
</nav>

<div class="container mx-auto">
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $courseId = $_POST['course_id'];

    // Fetch enrolled course details
    $enrolledCourseQuery = "SELECT * FROM enrolmentt WHERE user_id = '" . $_SESSION['id'] . "' AND course_id = '" . $courseId . "'";
    $enrolledCourseResult = mysqli_query($con, $enrolledCourseQuery);

    if (mysqli_num_rows($enrolledCourseResult) > 0) {
      $enrolledCourseRow = mysqli_fetch_assoc($enrolledCourseResult);
      $enrolledCourseName = $enrolledCourseRow['course_name'];

      echo "<h2 class='text-3xl font-bold mt-8'>Enrolled Course: " . $enrolledCourseName . "</h2>";
      echo "<hr class='my-4'>";

      // Fetch course content
      $courseContentQuery = "SELECT * FROM course_content WHERE course_id = '" . $courseId . "'";
      $courseContentResult = mysqli_query($con, $courseContentQuery);

      if (mysqli_num_rows($courseContentResult) > 0) {
        $totalContentCount = mysqli_num_rows($courseContentResult);
        $completedContentCount = 0;

        while ($courseContentRow = mysqli_fetch_assoc($courseContentResult)) {
          $contentId = $courseContentRow['content_id'];
          $contentTitle = $courseContentRow['content_title'];
          $content_type = $courseContentRow['content_type'];
          $content_file = $courseContentRow['content_file'];

          // Check if the content ID is checked in the session
          $isChecked = isset($_SESSION['checked_content'][$courseId]) && in_array($contentId, $_SESSION['checked_content'][$courseId]);
          if ($isChecked) {
            $completedContentCount++;
          }
          ?>
          <div class="row">
            <div class="col-md-6">
              <div class="card" style="background: linear-gradient(to right, #c8c5e0, #d5e3de); padding: 20px;">
                <div class="card-body">
                  <h4 class="card-title"><?php echo $contentTitle; ?></h4>
                  <p class="card-text">Type: <?php echo $content_type; ?></p>
                  <form action="" method="post">
                    <input type="hidden" name="course_id" value="<?php echo $courseId; ?>">
                    <input type="hidden" name="content_id" value="<?php echo $contentId; ?>">
                    <input type="checkbox" name="content_checkbox[]" value="<?php echo $contentId; ?>" <?php if ($isChecked) { echo 'checked'; } ?>> Completed
                  </form>
                </div>
                <div class="card-footer" style="text-align: right;">
                  <a href="<?php echo $content_file; ?>" class="btn btn-primary" target="_blank">View</a>
                </div>
              </div>
            </div>
          </div>
          <?php
        }

        $progressPercentage = ($completedContentCount / $totalContentCount) * 100;
        ?>
        <div class="progress mt-4">
          <div class="progress-bar" role="progressbar" style="width: <?php echo $progressPercentage; ?>%;" aria-valuenow="<?php echo $progressPercentage; ?>" aria-valuemin="0" aria-valuemax="100"><?php echo $progressPercentage; ?>%</div>
        </div>
        <?php
      } else {
        echo '<p class="no-content">No course content available.</p>';
      }

      // Close database connection
      mysqli_close($con);
    }
  } else {
    echo "<p class='no-content'>You are not enrolled in this course.</p>";
  }
  ?>
</div>

</body>
</html>
