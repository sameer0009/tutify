<?php
session_start();
if (isset($_GET['course_id'])) {
  $_SESSION['course_id'] = $_GET['course_id'];
} else {
  $_SESSION['course_id'] = ""; // Set a default value if 'course_id' is not provided
}

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/t_dash_style.css" rel="stylesheet">
  <link href="../css/nav_style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?php echo ucwords($_SESSION["user_name"]);?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="session.php">Create Class</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="create_assessments.php">Course Assessments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="create_quiz.php?course_id=<?php echo $_SESSION['course_id']; ?>">Course Quiz</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" target="_blank" href="grading.php">Grading</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" target="_blank" href="s_notification.php">Notification</a>
        </li>

      </ul>
    </div>
    <a class="btn btn-primary" href="./addcourse.php">Back</a>
  </nav>

  <div class="container-fluid">
    <!-- Content here -->
  </div>

  <?php
  include('../dbcon.php');
  include('t_upload_content.php');
  ?>
</body>
</html>
