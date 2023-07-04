<?php
session_start();

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve the assessment ID from the submitted form
  $assessmentId = $_POST['assesment_id'];
  $assesmentdescription=$_POST['assessment_description'];

  // Retrieve the user ID from the session
  $userId = $_SESSION['id'];
  $userName = $_SESSION['user_name'];

  // Check if a file is uploaded
  if (isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // Retrieve file information
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Retrieve the comment field from the form
    $comment = $_POST['comment'];
    $course_id=$_SESSION['course_id'];

    // Define allowed file extensions
    $allowedExtensions = array('pdf', 'doc', 'docx');

    // Get the file extension
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    if (in_array($fileExt, $allowedExtensions)) {
      if ($fileError === 0) {
        if ($fileSize < 5242880000) { // Adjust the maximum file size limit if needed (currently set to 50MB)
          $newFileName = uniqid('', true) . '.' . $fileExt;
          $fileDestination = '../uploads/submissions/' . $newFileName;
          move_uploaded_file($fileTmpName, $fileDestination);
          //$path=move_uploaded_file($fileTmpName, $fileDestination);

          // Insert the submission record into the database
          $submissionQuery = "INSERT INTO submissions (user_id, assesment_id, file, comment,course_id,path,username) VALUES ('$userId', '$assessmentId', '$newFileName', '$comment','$course_id' ,'$fileDestination','$userName')";
          $submissionResult = mysqli_query($con, $submissionQuery);

          if ($submissionResult) {
            // Submission successful
            // Display success alert and redirect to assessment.php page
            echo '<script>alert("Submission successful.");</script>';
            header('Location: assessment.php');
            exit();
          } else {
            // Submission failed
            // Redirect to an error page or display an error message
            echo '<script>alert("Submission error.");</script>';
            exit();
          }
        } else {
          // File size exceeds the limit
          echo "File size exceeds the maximum limit.";
        }
      } else {
        // Error occurred during file upload
        echo "An error occurred during file upload.";
      }
    } else {
      // Invalid file extension
      echo "Invalid file extension.";
    }
  } else {
    // No file uploaded
    echo "No file uploaded.";
  }
}

// Close database connection
mysqli_close($con);
?>
