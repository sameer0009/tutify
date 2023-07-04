<?php
session_start();
include('../dbcon.php');

if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php');
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <style>
    /* Additional custom styles can be added here */
  </style>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto py-8">
    <?php
    $course_id = isset($_SESSION['course_id']) ? $_SESSION['course_id'] : '';
    $user_id=$_SESSION['id'];

    // Fetch all questions for the selected course
    $sql = "SELECT * FROM quiz_questions WHERE course_id = '$course_id'";
    $result = mysqli_query($con, $sql);
    $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    $total_questions = count($questions);
    $correct_answers = 0;

    // Check each answer submitted by the user
    foreach ($questions as $question) {
      $question_id = $question['id'];
      $answer_key = 'question_' . $question_id;

      if (isset($_POST[$answer_key])) {
        $selected_option = $_POST[$answer_key];

        if ($selected_option == $question['correct_answer']) {
          $correct_answers++;
        }
      }
    }

    $score = ($correct_answers / $total_questions) * 100;

    // Save the score to the database
    $sql = "INSERT INTO quiz_results (course_id, score,user_id) VALUES ('$course_id', '$score','$user_id')";
    mysqli_query($con, $sql);

    // Print the quiz result in tabular form
    echo '<div class="bg-white shadow-md rounded px-8 py-6">';
    echo '<h2 class="text-2xl font-bold mb-6">Quiz Result</h2>';
    echo '<table class="w-full border-collapse border border-gray-300 mb-6">';
    echo '<tr><th class="py-2 px-4 bg-gray-200 border-b border-gray-300">Total Questions</th><th class="py-2 px-4 bg-gray-200 border-b border-gray-300">Correct Answers</th><th class="py-2 px-4 bg-gray-200 border-b border-gray-300">Score</th></tr>';
    echo '<tr><td class="py-2 px-4 border-b border-gray-300 text-center">'.$total_questions.'</td><td class="py-2 px-4 border-b border-gray-300 text-center">'.$correct_answers.'</td><td class="py-2 px-4 border-b border-gray-300 text-center">'.$score.'%</td></tr>';
    echo '</table>';

    echo '<button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="redirectToPage()">back</button>';
    echo '</div>';
    ?>

  </div>

  <script>
    function redirectToPage() {
      window.location.href = './enrolled_courses.php';
    }
  </script>
</body>
</html>
