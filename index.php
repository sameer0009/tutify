<?php
use PHPMailer\PHPMailer\PHPMailer;

session_start();

require '../tutify/dbcon.php';
  require '../tutify/PHPMailer/src/PHPMailer.php';
  require '../tutify/PHPMailer/src/SMTP.php';
  require '../tutify/PHPMailer/src/Exception.php';

if (isset($_POST['submit'])) {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $user_type = $_POST['type'];
  $unique_id=uniqid();

  // Check if the email is already registered
  $sql = "SELECT * FROM users WHERE email = '$email'";
  $result = mysqli_query($con, $sql);

  if (mysqli_num_rows($result) > 0) {
    echo "Email already exists. Please choose a different email.";
    exit();
  }
 $_SESSION['fname']=$fname;
    $_SESSION['lname']=$lname;
    $_SESSION['phone']=$phone;
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['verification_code']=$verification_code;
    $_SESSION['user_type']=$user_type;
  // Generate a verification code
  $verification_code = bin2hex(random_bytes(16));

  if($user_type=="Student")
  {
    // Insert the user data into the database
  $sql = "INSERT INTO users (fname, lname, phone, email, password, user_type, verification_code,create_date,unique_id) VALUES ('$fname', '$lname', '$phone', '$email', '$password', '$user_type', '$verification_code', current_timestamp(),'$unique_id')";
  mysqli_query($con, $sql);
  }
  else{
    $_SESSION['fname']=$fname;
    $_SESSION['lname']=$lname;
    $_SESSION['phone']=$phone;
    $_SESSION['email']=$email;
    $_SESSION['password']=$password;
    $_SESSION['verification_code']=$verification_code;
    $_SESSION['unique_id']=$unique_id;
  }
  

  // Send verification email
  $mail = new PHPMailer();
  $mail->isSMTP();
  $mail->SMTPAuth = true;
  $mail->SMTPSecure = 'tls';
  $mail->Host = 'smtp.gmail.com'; // Specify your SMTP server
  $mail->Port =  587 ;  // Specify the SMTP port
  $mail->Username = 'tutify6@gmail.com'; // Your SMTP username
  $mail->Password = 'cvdusmbzsatayahq'; // Your SMTP password

  $mail->setFrom('tutify6@gmail.com', 'TUTIFY'); // Sender's email and name
  $mail->addAddress($email, $fname . ' ' . $lname); // Recipient's email and name

  $mail->Subject = 'Email Verification';
  $mail->Body = "Verify your email:\n";
  $mail->Body .= "Your Email Has Been Veerified:$verification_code";

  if ($mail->send()) {
    // Redirect based on user type
    if ($user_type === 'Teacher') {
      header('Location: tsa.php');
    } else {
      header('Location: signin.php');
    }
    exit();
  } else {
    echo 'Error sending email: ' . $mail->ErrorInfo;
  }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tutify - Online Education</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

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
    <?php include('index_header.php')?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center my-5 py-5">
            <h1 class="text-white mt-4 mb-4">Learn From Anywhere</h1>
            <h1 class="text-white mt-4 mb-4">"Education is not the filling of a pail, but the lighting of a fire." - William Butler Yeats.</h1>
        </div>
    </div>
    <!-- Header End -->


    <!-- About Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-5 mb-5 mb-lg-0" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/img3.jpg" style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">About Us</h6>
                        <h1 class="display-4">First Choice For Online Education Anywhere</h1>
                    </div>
                    <p>Welcome to our online learning platform, where you can expand your knowledge and skills in a variety of subjects. Our website offers a range of courses taught by experienced instructors, covering topics from basics to advance and everything in between. With flexible scheduling, interactive lessons, and a supportive community, you can learn at your own pace and on your own terms.You'll find what you're looking for here. Start exploring today!</p>
                    <div class="row pt-3 mx-0">
                        <div class="col-3 px-0">
                            <div class="bg-success text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">13</h1>
                                <h6 class="text-uppercase text-white">Available<span class="d-block">Subjects</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-primary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">14</h1>
                                <h6 class="text-uppercase text-white">Online<span class="d-block">Courses</span></h6>
                            </div>
                        </div>
                        <div class="col-3 px-0">
                            <div class="bg-secondary text-center p-4">
                                <h1 class="text-white" data-toggle="counter-up">15</h1>
                                <h6 class="text-uppercase text-white">Skilled<span class="d-block">Instructors</span></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->


    <!-- Feature Start -->
    <div class="container-fluid bg-image" style="margin: 90px 0;">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 my-5 pt-5 pb-lg-5">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Why Choose Us?</h6>
                        <h1 class="display-4">Why You Should Start Learning with Us?</h1>
                    </div>
                    <p class="mb-4 pb-2">Our online learning platform provides a comprehensive, convenient, and affordable solution for anyone looking to learn and grow. Join us today!</p>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-primary mr-4">
                            <i class="fa fa-2x fa-graduation-cap text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Skilled Instructors</h4>
                            <p>Our courses are designed and taught by industry experts and renowned instructors, ensuring that you receive high-quality education.</p>
                        </div>
                    </div>
                    <div class="d-flex mb-3">
                        <div class="btn-icon bg-secondary mr-4">
                            <i class="fa fa-2x fa-certificate text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Interactive Experience</h4>
                            <p>Our courses include interactive elements such as quizzes, group discussions, and projects to keep you engaged and motivated.</p>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="btn-icon bg-warning mr-4">
                            <i class="fa fa-2x fa-book-reader text-white"></i>
                        </div>
                        <div class="mt-n1">
                            <h4>Online Classes</h4>
                            <p class="m-0">Our online learning platform offers flexible scheduling, so you can learn at your own pace and on your own time.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5" style="min-height: 500px;">
                    <div class="position-relative h-100">
                        <img class="position-absolute w-100 h-100" src="img/feature.jpg" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Start -->


    <!-- Courses Start -->
    <div class="container-fluid px-0 py-5">
        <div class="row mx-0 justify-content-center pt-5">
            <div class="col-lg-6">
                <div class="section-title text-center position-relative mb-4">
                    <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Our Courses</h6>
                    <h1 class="display-4">Checkout New Releases Of Our Courses</h1>
                </div>
            </div>
        </div>
        <div class="owl-carousel courses-carousel">
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/courses-1.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Maths</h4>
                </div>
            </div>
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/courses-2.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Biology</h4>
                </div>
            </div>
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/courses-33.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">Chemistry</h4>
                </div>
            </div>
            <div class="courses-item position-relative">
                <img class="img-fluid" src="img/courses-44.jpg" alt="">
                <div class="courses-text">
                    <h4 class="text-center text-white px-3">English</h4>
                </div>
            </div>
           
           
        </div>
        
        
    </div>
    <!-- Courses End -->


    <!-- Team Start -->
    <?php
require('./dbcon.php');

$sql = "SELECT * FROM users  WHERE user_type='Teacher'";
$sql_run = mysqli_query($con, $sql);


?>  
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Instructors</h6>
                <h1 class="display-4">Meet Our Instructors</h1>
            </div>
            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
            <?php
            if (mysqli_num_rows($sql_run)>0) {
                while ($row=mysqli_fetch_assoc($sql_run)) {
                    ?>
                  
                <div class="team-item">
                    <img class="img-fluid w-100" src="uploads/<?php echo $row['picture'];?>" alt="">
                    <div class="bg-light text-center p-4">
                        <h5 class="mb-3"><?php echo $row['fname'];?></h5>
                        <h5 class="mb-3"><?php echo $row['experience'];?></h5>
                        <h5 class="mb-3"><?php echo $row['email'];?></h5>
                        <h5 class="mb-3">$<?php echo $row['hourly_rate'];?></h5>


                        <p class="mb-2">    </p>
                        <div class="d-flex justify-content-center">
                        </div>
                    </div>
                </div>
    
            
            <?php
                }  
            }
            ?>
             </div>  
           
        </div>
    </div>
    <!-- Team End -->


    <!-- Testimonial Start -->
    <div class="container-fluid bg-image py-5" style="margin: 90px 0;">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-5 mb-lg-0">
                    <div class="section-title position-relative mb-4">
                        <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Testimonial</h6>
                        <h1 class="display-4">What Say Our Students</h1>
                    </div>
                    <p class="m-0">Our students have had positive experiences with our online learning platform and have seen great results from their studies. Here's what some of them said.</p>
                </div>
                <div class="col-lg-7">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="bg-white p-5">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <p>"The interactive elements of the courses have made learning so much more engaging and enjoyable. I never thought I'd look forward to studying, but here I am!"</p>
                        </div>
                        <div class="bg-white p-5">
                            <i class="fa fa-3x fa-quote-left text-primary mb-4"></i>
                            <p>"I was looking for a way to improve my skills and I stumbled upon this platform. I've taken several courses and I have to say I'm impressed by the quality of the content and the instructors. I've learned so much and I feel more confident in my abilities."</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Testimonial Start -->


   

    <?php
    include('./footer.php');
    ?>

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