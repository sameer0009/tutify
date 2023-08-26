<?php
session_start();

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');
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
<link rel="stylesheet" href="../css/assessment_style.css">
<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- JavaScript -->
<script>
function showAlert() {
  alert("Assessment submitted successfully!");
}
</script>

</head>

<body class="bg-gray-100">
<nav class="navbar navbar-expand-lg text font-semibold ">
  <a href="#" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
            </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        
        <li class="nav-item mx-8">
        <a class="nav-link" target="_blank" href="./quiz.php?php echo $_POST['course_id']; ?>">Quiz</a>
      </li>
      </ul>
    </div>
    <a class="navbar-brand" href="#"><?php echo ucwords($_SESSION["user_name"]);?></a>
    <a class="btn btn-primary" href="./enrolled_courses.php">Back</a>
</nav>

<div class="container mx-auto">
  <div class="container-fluid assessment">
    <?php
    // Fetch assessments
    $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : ''; // Get the course_id from the URL parameters or set it as an empty string if not present
    $_SESSION['course_id']=$course_id;
    $assessmentQuery = "SELECT * FROM assesment WHERE course_id = '$course_id'";
    $assessmentResult = mysqli_query($con, $assessmentQuery);

    if (mysqli_num_rows($assessmentResult) > 0) {
      while ($assessmentRow = mysqli_fetch_assoc($assessmentResult)) {
        $assesment_id = $assessmentRow['assesment_id'];
        $assesment_title = $assessmentRow['assesment_title'];
        $assesment_description = $assessmentRow['assesment_description'];
        $assesment_type = $assessmentRow['assesment_type'];
        $due_date = $assessmentRow['due_date'];

        echo '<div class="assessment-card card p-4 mb-4">';
        echo '<div class="card-body">';
        echo "<h4 class='card-title'>" . $assesment_title . "</h4>";
        echo "<p class='card-subtitle'>Description: " . $assesment_description . "</p>";
        echo "<p class='card-subtitle'>Deadline: " . $due_date . "</p>";

        // Check if the student has submitted the assessment
        $submissionQuery = "SELECT * FROM submissions WHERE user_id = '" . $_SESSION['id'] . "' AND assesment_id = '" . $assesment_id . "'";
        $submissionResult = mysqli_query($con, $submissionQuery);

        if (mysqli_num_rows($submissionResult) > 0) {
          // Display submission status
          echo "<p>Submission Status: Submitted</p>";
        } else {
          // Display submission form
          echo '<div class="submission-form mt-4">';
          echo '<form action="submit_assessment.php" method="POST" enctype="multipart/form-data">';
          echo '<input type="hidden" name="assesment_id" value="' . $assesment_id . '">';
          echo '<div class="form-group mb-4">';
          echo '<label for="file">Upload File:</label>';
          echo '<input type="file" class="form-control" id="file" name="file">';
          echo '</div>';
          echo '<div class="form-group mb-4">';
          echo '<label for="comment">Comment:</label>';
          echo '<textarea class="form-control" id="comment" name="comment" rows="3"></textarea>';
          echo '</div>';
          echo '<button type="submit" class="btn btn-primary" onclick="showAlert()">Submit</button>';
          echo '</form>';
          echo '</div>';
        }

        echo '</div>';
        echo '</div>';
      }
    } else {
      echo '<p class="no-assessment">No assessments available for this course.</p>';
    }

    // Close database connection
    mysqli_close($con);
    ?>
  </div>
</div>
</body>
</html>
