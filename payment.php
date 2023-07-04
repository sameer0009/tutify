<?php 
session_start();
include('dbcon.php');


$sql="SELECT * FROM users WHERE id='".$_SESSION['id']."'";
$result=$con->query($sql);
$users=$result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet"href ="./css/payment_style.css">

</head>
<?php
// Process form data when the form is submitted
if (isset($_POST['submit'])) {
  // Get form data and store in variables
  $fullname = $_POST['firstname'];
  $email = $_POST["email"];
  $address = $_POST["address"];
  $city = $_POST["city"];
  $state = $_POST["state"];
  $zip = $_POST["zip"];
  $cardname = $_POST["cardname"];
  $ivlen = openssl_cipher_iv_length("AES-256-CBC");
  $iv = openssl_random_pseudo_bytes($ivlen);
  $cardnumber = openssl_encrypt($_POST["cardnumber"], "AES-256-CBC", "my-secret-key", 0, $iv);
  $expmonth = $_POST["expmonth"];
  $expyear = $_POST["expyear"];
  $cvv = $_POST["cvv"];
  $course_name = $_POST['course_name'];
  $course_id = $_POST['course_id'];
  $course_instructor_id = $_POST['instructor_id'];
  $course_price = $_POST['course_price'];
  $course_instructor = $_POST['course_instructor'];
  $user_id = $_POST['user_id'];

  // Check if the user is already enrolled in the course
  $sql_check_enrollment = "SELECT * FROM enrolmentt WHERE user_id = '$user_id' AND course_id = '$course_id'";
  $result_check_enrollment = mysqli_query($con, $sql_check_enrollment);

  if (mysqli_num_rows($result_check_enrollment) > 0) {
    // User is already enrolled in the course
    echo "<script>alert('You are already enrolled in this course.');</script>"; 
  } else {
    // User is not enrolled in the course, proceed with payment and enrollment

    $sql_fee = "SELECT platform_percentage FROM platform_fee";
    $result = mysqli_query($con, $sql_fee);
    $row = mysqli_fetch_assoc($result);

    $percentage_deduct = $row['platform_percentage'];

    $platform_result = ($percentage_deduct * $course_price) / 100;

    $tutor_amount = $course_price - $platform_result;

    $sql = "INSERT INTO payment (fullname, email, address, city, state, zip, cardname, cardnumber, expmonth, expyear, cvv, course_name, course_id, course_price, course_instructor, user_id, tutor_fee, platform_fee, instructor_id) VALUES ('$fullname', '$email', '$address', '$city', '$state', '$zip', '$cardname', '$cardnumber', '$expmonth', '$expyear', '$cvv', '$course_name', '$course_id', '$course_price', '$course_instructor', '$user_id', '$tutor_amount', '$platform_result', '$course_instructor_id')";
    mysqli_query($con, $sql);

    $sql_en = "INSERT INTO `enrolmentt`(`user_id`, `course_id`, `enrolment_date`, `user_name`, `course_name` , `course_instructor`) VALUES ('$user_id','$course_id',current_timestamp(),'$fullname','$course_name','$course_instructor')";
    mysqli_query($con, $sql_en);

    header('Location: success.php');
    exit();
  }
}
?>


<body>
 

  <div class="col-10">
    <div class="container ">
      <form method="POST">
  <div class="row">
    <div class="col-50">
      <h3>Billing Address</h3>
      <label><i class="fa fa-user"></i> Full Name</label>
      <input type="text" name="firstname" value="<?php echo $users['fname']; ?>" readonly>

      <label><i class="fa fa-user"></i> User ID</label>
      <input type="text" name="user_id" value="<?php echo $users['id']; ?>" readonly>

      <label><i class="fa fa-envelope"></i> Email</label>
      <input type="text"  name="email" value="<?php echo $users['email']; ?>" readonly>
      <label><i class="fa fa-address-card-o"></i> Address</label>
      <input type="text"  name="address" value="<?php echo $users['address']; ?>" readonly>
      <label><i class="fa fa-institution"></i> City</label>
      <input type="text" name="city" value="<?php echo $users['area']; ?>" readonly>

      <div class="row">
        <div class="col-50">
          <label >State</label>
          <input type="text"  name="state" value="<?php echo $users['state']; ?>" readonly>
        </div>
        <div class="col-50">
          <label >Zip</label>
          <input type="text"  name="zip" value="<?php echo $users['postal_code']; ?>" readonly>
        </div>
      </div>
    </div>

    <div class="col-50">
      <h3>Payment</h3>
      <label>Accepted Cards</label>
      <div class="icon-container">
        <i class="fa fa-cc-visa" style="color:navy;"></i>
        <i class="fa fa-cc-amex" style="color:blue;"></i>
        <i class="fa fa-cc-mastercard" style="color:red;"></i>
        <i class="fa fa-cc-discover" style="color:orange;"></i>
      </div>
      <label >Name on Card</label>
      <input type="text"  name="cardname" required>
     <label for="cardnumber">Credit card number</label>
<input type="text" id="cardnumber" name="cardnumber" required pattern="[0-9]{16}" title="Please enter a valid 16-digit credit card number">
  
      <label >Exp Month</label>
      <input type="text" name="expmonth"required>
      <div class="row">
        <div class="col-50">
          <label >Exp Year</label>
          <input type="text"  name="expyear"required>
        </div>
        <div class="col-50">
          <label >CVV</label>
          <input type="text" name="cvv"required>
        </div>
      </div>
      <div class="row">
        <div class="col-50">
          <label for="course_name">Course Name</label>
          <input type="text" name="course_name" value="<?php echo $_SESSION['c_name']; ?>" readonly>
          <input type="hidden" name="instructor_id" value="<?php echo $_SESSION['c_instructor_id']; ?>" readonly>

        </div>
        <div class="col-50">
          <label for="course_id">Course ID</label>
          <input type="text" id="course_id" name="course_id" value="<?php echo $_SESSION['c_id']; ?>" readonly>
        </div>
      </div>
      <div class="row">
        <div class="col-50">
          <label for="course_price">Course Price</label>
          <input type="text" id="course_price" name="course_price" value="<?php echo $_SESSION['c_price']; ?>"readonly>
        </div>
        <div class="col-50">
          <label for="course_instructor">Course Instructor</label>
          <input type="text" id="course_instructor" name="course_instructor" value="<?php echo $_SESSION['c_instructor'] ;?>" readonly>
        </div>
      </div>
    </div>
  </div>
  <input type="submit" name="submit" value="Continue to checkout" class="btn">
</form>

    </div>
  </div>



</body>
</html>