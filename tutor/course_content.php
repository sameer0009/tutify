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


    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light ">
     <a href="#" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
            </a>
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="session.php?course_id=<?php echo $_SESSION['course_id']; ?>">Create Class</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="create_assessments.php?course_id=<?php echo $_SESSION['course_id']; ?>">Course Assessments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="create_quiz.php?course_id=<?php echo $_SESSION['course_id']; ?>">Course Quiz</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" target="_blank" href="grading.php?course_id=<?php echo $_SESSION['course_id']; ?>">Grading</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" target="_blank" href="s_notification.php?course_id=<?php echo $_SESSION['course_id']; ?>">Notification</a>
        </li>

      </ul>
       <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ucwords($_SESSION["user_name"]); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../change_password.php" title="Password">Password</a>
                    <a class="dropdown-item" href="./addcourse.php">Back</a>
                    <a class="dropdown-item" href="../logout.php" title="Logout">Log out</a>
                </div>
            </li>
        </ul>
    </div>
   
    
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
