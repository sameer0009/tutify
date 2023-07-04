<?php

include 'dbcon.php';
require '../fyp-main/PHPMailer/src/PHPMailer.php';
require '../fyp-main/PHPMailer/src/SMTP.php';
require '../fyp-main/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['forgot_password_submit'])) {
  $email = $_POST['email'];

  $email_search = "SELECT * FROM users WHERE email='$email' ";
  $query = mysqli_query($con, $email_search);

  $email_count = mysqli_num_rows($query);

  if ($email_count) {
    $row = mysqli_fetch_array($query); 
    $password = $row['password'];
    $to = $row['email'];
    $subject = "Password Recovery";
    $body = "Your password is: $password";

    // Instantiate PHPMailer
    $mail = new PHPMailer;

    // Set the SMTP settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'tutify6@gmail.com'; // Your SMTP username
    $mail->Password = 'cvdusmbzsatayahq'; // Your SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    // Set the email details
    $mail->setFrom('tutify6@gmail.com', 'Tutify');
    $mail->addAddress($to);                               // Add a recipient
    $mail->isHTML(true);                                   // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $body;

    // Send the email
    if($mail->send()) {
      echo "<script>alert('Your password has been sent to your email address.')</script>";
    } else {
      echo "<script>alert('Failed to send email.')</script>";
    }
  } else {
    echo "<script>alert('Invalid email.')</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="./css/signin.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');
  </style>
</head>
<body>
  <h1>Forgot Password</h1>
  <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="post">
    <div class="imgcontainer">
      <img src="./img/user.svg" alt="Avatar" class="avatar">
    </div>
    <div class="container">
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Enter email" name="email" required>
      <button type="submit" name="forgot_password_submit">Reset </button>
    </div>
  </form>
  <script>
    // Get the modal
    var modal = document.getElementById('id01');

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>
</html>
