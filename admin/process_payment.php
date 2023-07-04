<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: ../join.php'); // redirect to the login page if the student is not logged in
  exit();
}

// Establish database connection
include('../dbcon.php');

// Get the submitted form data
$tutorID = $_POST['tutor_id'];
$amount = $_POST['amount'];

// Retrieve the tutor's name from the payment table
$sql = "SELECT course_instructor FROM payment WHERE instructor_id = '$tutorID'";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
  $row = mysqli_fetch_assoc($result);
  $tutorName = $row['course_instructor'];

  // Insert the customized payment into the database
  $sql = "INSERT INTO salary (tutor_name, amount,tutor_id) VALUES ('$tutorName', '$amount','$tutorID')";
  if (mysqli_query($con, $sql)) {
    $message = "Payment initiated successfully.";
    $sql="UPDATE `payment` SET `salary_check`='1' WHERE instructor_id='$tutorID'";
    mysqli_query($con,$sql);
    $redirectURL = "manage_payments.php";
  } else {
    $message = "Error: " . $sql . "<br>" . mysqli_error($con);
    $redirectURL = "manage_payments.php";
  }
} else {
  $message = "Error: Tutor not found.";
  $redirectURL = "manage_payments.php";
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Payment Page</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h2>Payment Details</h2>

    <!-- JavaScript to display popup alert and redirect -->
    <script>
      alert("<?php echo $message; ?>");
      window.location.href = "<?php echo $redirectURL; ?>";
    </script>

    <!-- Rest of your HTML code -->
    <!-- ... -->
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
