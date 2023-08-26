<?php
session_start();

if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');

$fname = $_SESSION['user_name'];

$sql = "SELECT * FROM users WHERE user_type = 'Teacher' AND fname = '$fname'";
$sql_run = mysqli_query($con, $sql);

if ($sql_run) { // Check if the query execution was successful
  $num_rows = mysqli_num_rows($sql_run);

  if ($num_rows > 0) {
    $row = mysqli_fetch_assoc($sql_run);
    $fname = $row['fname'];
    $picture = base64_encode($row['picture']);
    ?>

    <!DOCTYPE html>
    <html lang="en">


    <head>
      <meta charset="UTF-8">
      <title>Profile Card</title>
      <link href="../css/Profile_card.css" rel="stylesheet">

      <!-- Font awesome CDN link -->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    </head>

    <body>
      <div class="image-area">
        <div class="img-wrapper">
          <img class="card-img-top" src="../uploads/<?php echo $row['picture']; ?>" alt="Profile Picture ">
          <h2><?php echo $fname; ?></h2>
          <ul>
            <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
          </ul>
        </div>
      </div>
    </body>

    </html>

    <?php
  } else {
    echo "No data found for the signed-in user.";
  }
} else {
  echo "Error executing the SQL query: " . mysqli_error($con);
}
?>
