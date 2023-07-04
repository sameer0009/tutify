<?php
session_start();

require('./dbcon.php');
require '../tutify/PHPMailer/src/PHPMailer.php';
require '../tutify/PHPMailer/src/SMTP.php';
require '../tutify/PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail($to, $subject, $message) {
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = 'tutify6@gmail.com';
    $mail->Password = 'cvdusmbzsatayahq';
    $mail->setFrom('tutify6@gmail.com');
    $mail->addAddress($to);
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body = $message;

    if ($mail->send()) {
        return true;
    } else {
        return false;
    }
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tutorId = $_POST['tutor_id'];
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Save booking details to the database
    $sql = "INSERT INTO bookings (tutor_id, full_name, email, date, time) VALUES ('$tutorId', '$fullName', '$email', '$date', '$time')";
    mysqli_query($con, $sql);

    // Send confirmation email to the user
    $userSubject = 'Booking Confirmation';
    $userMessage = "Dear $fullName,\n\nThank you for booking a demo session with our tutor. Your booking details are as follows:
    \n\n
    Date: $date
    \n
    Time: $time
    \n\n
    We look forward to meeting you! we will share demo class instruction shortly!
    \n\n
    Best regards, \nTUTIFY";
    sendEmail($email, $userSubject, $userMessage);

    // Send notification email to the tutor
    $tutorEmail = $_GET['email']; // Provide the tutor's email address
    $tutorSubject = 'New Booking Notification';
    $tutorMessage = "Hello,
    \n\n
    A new booking has been made for the demo session. The details are as follows:
    \n\n
    Name: $fullName
    \n
    Email: $email
    \n
    Date: $date
    \n
    Time: $time
    \n\n
    Please follow up with the user.
    \n\n
    Best regards,\nTUTIFY";

    sendEmail($tutorEmail, $tutorSubject, $tutorMessage);

    // Redirect to a thank you page or show a success message
    header('Location: thank_you.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Book Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        input[type="submit"] {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .success-message {
            color: #008000;
            text-align: center;
            margin-top: 10px;
        }
    </style>
     <meta charset="utf-8">
    <title>Tutify - Online Education Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

 <!-- Navbar Start -->
    <?php include('index_header.php'); ?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-1">Instructors</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Instructors</p>
            </div>

        </div>
    </div>
    <!-- Header End -->

    <div class="container">
        <h1>Book a Demo Session</h1>
        <form method="post" action="">
            <input type="hidden" name="tutor_id" value="<?php echo $_GET['tutor_id']; ?>">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Time:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Book Now">
            </div>
        </form>
    </div>

    <?php
    include('./footer.php');
    ?>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

</body>

</html>
