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
    <link rel="stylesheet" href="style.css">
    <link href="../css/save_quiz_style.css" rel="stylesheet">
</head>
<body>
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
</body>
</html>
