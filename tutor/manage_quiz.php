<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: ../join.php'); // Redirect to the login page if the user is not logged in
  exit();
}

// Include database connection
include('../dbcon.php');
$course_id = $_SESSION['course_id'];

// Fetch quiz questions from the database for the specific course ID
$sql = "SELECT * FROM quiz_questions WHERE course_id = $course_id";
$result = mysqli_query($con, $sql);

// Handle question deletion
if (isset($_GET['delete_id'])) {
  $deleteId = $_GET['delete_id'];
  $deleteQuery = "DELETE FROM quiz_questions WHERE id = $deleteId";
  $deleteResult = mysqli_query($con, $deleteQuery);

  if ($deleteResult) {
    // Redirect to the same page after successful deletion
    header('Location: manage_quiz.php');
    exit();
  } else {
    echo "Error deleting question: " . mysqli_error($con);
  }
}

mysqli_close($con);
?>


<!DOCTYPE html>
<html lang="en">
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
  <title>Manage Quiz</title>
   <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
    }

    .quiz-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      border-radius: 5px;
    }

    .quiz-container h2 {
      text-align: center;
      font-size: 28px;
      color: #333;
      margin-bottom: 20px;
    }

    .quiz-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    .quiz-table th,
    .quiz-table td {
      padding: 12px 16px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .quiz-table th {
      background-color: #f8f8f8;
      color: #333;
      font-weight: bold;
    }

    .quiz-table tbody tr:hover {
      background-color: #f2f2f2;
    }

    .quiz-table a {
      text-decoration: none;
      color: #007bff;
    }

    .quiz-table a:hover {
      text-decoration: underline;
    }

    .btn {
      display: inline-block;
      padding: 10px 16px;
      font-size: 14px;
      font-weight: bold;
      text-align: center;
      text-decoration: none;
      background-color: #007bff;
      color: #fff;
      border-radius: 4px;
      transition: background-color 0.3s;
    }

    .btn:hover {
      background-color: #0069d9;
    }

    .btn-secondary {
      background-color: #6c757d;
    }

    .btn-secondary:hover {
      background-color: #5a6268;
    }

    .text-center {
      text-align: center;
    }

    .mt-20 {
      margin-top: 20px;
    }
  </style>

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


      </ul>
      <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ucwords($_SESSION["user_name"]); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../change_password.php" title="Password">Password</a>
                    <a class="dropdown-item" href="./course_content.php?course_id=<?php echo $_SESSION['course_id']; ?>">Back</a>
                </div>
            </li>
        </ul>
    </div>
  
  </nav>
  <br>
  <div class="quiz-container">
    <h2 style="text-align: center; font-size: 36px; color: #333333;">Manage Quiz</h2>
    <table class="quiz-table">
      <thead>
        <tr>
          <th>Question</th>
          <th>Option 1</th>
          <th>Option 2</th>
          <th>Option 3</th>
          <th>Option 4</th>
          <th>Correct Answer</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['question']."</td>";
            echo "<td>".$row['option1']."</td>";
            echo "<td>".$row['option2']."</td>";
            echo "<td>".$row['option3']."</td>";
            echo "<td>".$row['option4']."</td>";
            echo "<td>".$row['correct_answer']."</td>";
            echo "<td>";
           
            echo "<a href='manage_quiz.php?delete_id=".$row['id']."' onclick='return confirm(\"Are you sure you want to delete this question?\")'>Delete</a>";
            echo "</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='7'>No questions found.</td></tr>";
        }
        ?>
      </tbody>
    </table>
   
  </div>
</body>
</html>
