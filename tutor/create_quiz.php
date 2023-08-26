<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: ../join.php'); // redirect to the login page if the student is not logged in
  exit();
}

// Check if the course ID is set in the session
if (!isset($_SESSION['course_id'])) {
  // Redirect or display an error message
  header('Location: ./course_content.php'); // Redirect to the home page or any other suitable page
  exit();
}

$courseId = $_SESSION['course_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz</title>
     <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="../css/style.css" rel="stylesheet">
  <link href="../css/t_dash_style.css" rel="stylesheet">
  <link href="../css/nav_style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <link href="../css/save_quiz_style.css" rel="stylesheet">
    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
 <nav class="navbar navbar-expand-lg navbar-light">
  <a href="#" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
            </a>
    
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="manage_quiz.php?course_id=<?php echo $_SESSION['course_id']; ?>">Manage Quiz</a>
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
    <br>
    <div class="quiz-container">
        <h2 style="text-align:center; font-size: 36px; color: #333333;">Quiz</h2>
        <form method="post" action="save_quiz.php">
            <label for="Course_id">Course ID:</label>
            <input type="text" id="subject" name="subject" value="<?php echo $courseId; ?>" readonly>
            <label for="marks">Marks:</label>
            <input type="number" id="marks" name="marks" required>
            <label for="question">Question:</label>
            <input type="text" id="question" name="question" required>
            <label for="option1">Option 1:</label>
            <input type="text" id="option1" name="option1" required>
            <label for="option2">Option 2:</label>
            <input type="text" id="option2" name="option2" required>
            <label for="option3">Option 3:</label>
            <input type="text" id="option3" name="option3" required>
            <label for="option4">Option 4:</label>
            <input type="text" id="option4" name="option4" required>
            <label for="correct_answer">Correct Answer:</label>
            <input type="text" id="correct_answer" name="correct_answer" required>
            <input type="hidden" name="subject_name" value="<?php echo $courseId; ?>">
            <br>
            <button type="submit" class="btn btn-primary">Save Question</button>
            <button type="button" class="btn btn-secondary" onclick="window.location.href = 'course_content.php'">Back</button>
        </form>
    </div>

    <!-- Manage Quiz Button -->
    
</body>
</html>
