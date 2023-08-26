<?php
session_start();

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
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
<link rel="stylesheet" href="../css/assessment_style.css">
<!-- Tailwind CSS -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


 <title>Grades Page</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }
    
    .container {
      max-width: 1000px;
      margin: 20px auto;
      padding: 20px;
      border: 1px solid lightgrey;
      border-radius: 3px;
    }
    
    h1 {
  text-align: center;
  margin-top: 0;
  font-weight: bold; /* Make the heading bold */
  font-size: 24px; /* Increase the text size */
  border-bottom: 5px solid black; /* Add a 5px border at the bottom */
  padding-bottom: 10px; /* Add some padding at the bottom */
}

    
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    
    table th,
    table td {
      padding: 10px;
      text-align: center;
      border-bottom: 1px solid #ddd;
    }
    
    table th {
      background-color: #f5f5f5;
    }
    
    .grade-label {
      font-weight: bold;
    }
    
    .grade-pass {
      color: green;
    }
    
    .grade-fail {
      color: red;
    }
  </style>


</head>


<nav class="navbar navbar-expand-lg text font-semibold ">
    <a class="navbar-brand" href="#"><?php echo ucwords($_SESSION["user_name"]);?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
       
      </ul>
    </div>
    <a class="btn btn-primary" href="./enrolled_courses.php">Back</a>
</nav>


<body>
  <div class="container">
    <h1>Assesment Results</h1>

    <table>
      <thead>
       <th>Course ID</th>
          <th>Assessment ID</th>
          <th>Quiz Marks</th>
          <th>Assignment Marks</th>

      </thead>
      <tbody>
        <?php
        // Fetch grades from the database
        include('../dbcon.php');
        $user_id = $_SESSION['id'];
        $course_id = isset($_GET['course_id']) ? $_GET['course_id'] : '';
         $assesment_id = isset($_GET['assesment_id']) ? $_GET['assesment_id'] : '';

        
        $sql = "SELECT course_id,assesment_id, grade FROM grades WHERE user_id = $user_id AND course_id = '$course_id'";
        $result = $con->query($sql);

        if ($result !== false && $result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            $course_id = $row["course_id"];
            $assessment_id = $row["assesment_id"];
            $grade = $row["grade"];

        // Fetch quiz result based on course and assessment
            $sql_quiz_result = "SELECT score FROM quiz_results WHERE user_id = $user_id AND course_id = '$course_id' ";
            $result_quiz_result = $con->query($sql_quiz_result);
            $quiz_result = "";
            if ($result_quiz_result !== false && $result_quiz_result->num_rows > 0) {
              $quiz_result = $result_quiz_result->fetch_assoc()["score"];
            }


          echo "<tr>";
            echo "<td>$course_id</td>";
            echo "<td>$assessment_id</td>";
            echo "<td>$quiz_result</td>";
            echo "<td class='grade-label'>$grade</td>";
            echo "</tr>";
          }
        } else {
          echo "<tr><td colspan='3'>No grades found</td></tr>";
        }

        $con->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
