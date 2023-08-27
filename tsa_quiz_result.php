<?php
session_start();
include('./dbcon.php');
?>

<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Additional custom styles can be added here */
  </style>
</head>
<body class="bg-gray-100">
  <div class="container mx-auto py-8">
    <?php
    if (isset($_POST['subject_id'])) {
      $subject_id = $_POST['subject_id'];

      // Fetch the subject name and passing criteria from the database
      $sql_subject = "SELECT subject,passing_criteria FROM tblsubjects WHERE ID = '$subject_id'";
      $result_subject = mysqli_query($con, $sql_subject);
      $row_subject = mysqli_fetch_assoc($result_subject);
      $subject_name = $row_subject['subject'];
      $subject_passing_criteria = $row_subject['passing_criteria'];

      // Fetch all questions for the selected subject
      $sql = "SELECT * FROM tsa_questions WHERE subject = '$subject_name'";
      $result = mysqli_query($con, $sql);
      $questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

      $total_questions = count($questions);
      $correct_answers = 0;

      // Check each answer submitted by the user
      foreach ($questions as $question) {
        $answer_key = 'question_' . $question['id'];
        $user_answer = $_POST[$answer_key];
        $correct_answer = $question['correct_answer'];

        if ($user_answer == $correct_answer) {
          $correct_answers++;
        }
      }

      $score = $correct_answers / $total_questions * 100;
      $passed = ($score >= $subject_passing_criteria) ? true : false;

      if ($passed==true) {
        $sql = "INSERT INTO tsa_quiz_results (subject_id, subject_name, score, passed) VALUES ('$subject_id', '$subject_name', '$score', '$passed')";
      mysqli_query($con, $sql);

   


      $sql = "INSERT INTO users (fname, lname, phone, email, password, user_type, verification_code, create_date,unique_id) VALUES ('".$_SESSION['fname']."', '".$_SESSION['lname']."', '".$_SESSION['phone']."', '".$_SESSION['email']."', '".$_SESSION['password']."', '".$_SESSION['user_type']."', '".$_SESSION['verification_code']."', current_timestamp(), '".$_SESSION['unique_id']."')";

      mysqli_query($con, $sql);
      }

      // Save the score to the database
      

      // Print the quiz result in tabular form
      echo '<div class="bg-white shadow-md rounded px-8 py-6">';
      echo '<h2 class="text-2xl font-bold mb-6">Quiz Result - '.$subject_name.'</h2>';
      echo '<table class="w-full border-collapse border border-gray-300 mb-6">';
      echo '<tr><th class="py-2 px-4 bg-gray-200 border-b border-gray-300">Total Questions</th><th class="py-2 px-4 bg-gray-200 border-b border-gray-300">Correct Answers</th><th class="py-2 px-4 bg-gray-200 border-b border-gray-300">Score</th></tr>';
      echo '<tr><td class="py-2 px-4 border-b border-gray-300 text-center">'.$total_questions.'</td><td class="py-2 px-4 border-b border-gray-300 text-center">'.$correct_answers.'</td><td class="py-2 px-4 border-b border-gray-300 text-center">'.$score.'%</td></tr>';
      echo '</table>';

      if ($passed) {
        echo '<h2 class="text-2xl font-bold mb-6 text-green-500">Congratulations, you passed!</h2>';
      } else {
        echo '<h2 class="text-2xl font-bold mb-6 text-red-500">Better luck next time!</h2>';
      }

      echo '<button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="reattemptTSA()">Reattempt TSA</button>';

      echo '<br><br><button class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded" onclick="redirectToPage()">Sign In</button>';
      echo '</div>';
    }
    ?>

  </div>

  <script>
    function redirectToPage() {
      window.location.href = './signin.php';
    }

    function reattemptTSA() {
      window.location.href = './tsa.php'; // Replace with the URL of the TSA quiz page
    }
  </script>
</body>
</html>
