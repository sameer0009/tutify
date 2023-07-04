<?php
session_start();

// Get the course ID from the session
if (!isset($_SESSION['course_id'])) {
  // Redirect or display an error message
  header('Location: ../index.php'); // Redirect to the home page or any other suitable page
  exit();
}

$courseId = $_SESSION['course_id'];

// Get the question and options from the form
$marks = $_POST['marks'];
$question = $_POST['question'];
$option1 = $_POST['option1'];
$option2 = $_POST['option2'];
$option3 = $_POST['option3'];
$option4 = $_POST['option4'];
$correct_answer = $_POST['correct_answer'];

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'tutify');

// Insert the question and options into the database
$sql = "INSERT INTO quiz_questions (course_id, marks, question, option1, option2, option3, option4, correct_answer) 
        VALUES ('$courseId', '$marks', '$question', '$option1', '$option2', '$option3', '$option4', '$correct_answer')";

if (mysqli_query($conn, $sql)) {
    $message = "Question added successfully.";
    echo "<script type='text/javascript'>alert('$message'); window.location.href = 'create_quiz.php';</script>";
} else {
    $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<script type='text/javascript'>alert('$error');</script>";
}

// Close the database connection
mysqli_close($conn);
?>
