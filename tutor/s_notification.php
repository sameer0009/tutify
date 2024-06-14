<?php
session_start();
if (isset($_GET['course_id'])) {
  $_SESSION['course_id'] = $_GET['course_id'];
} else {
  $_SESSION['course_id'] = ""; // Set a default value if 'course_id' is not provided
}

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');

// Function to delete a notification
function deleteNotification($notificationId) {
  global $con;
  $sql = "DELETE FROM s_notifications WHERE id = $notificationId";
  $result = mysqli_query($con, $sql);
  if ($result) {
    return true;
  } else {
    return false;
  }
}

if(isset($_POST['submit'])){
    $message = $_POST['message'];
    $type = $_POST['type'];
    $tutor_id = mysqli_real_escape_string($con, $_POST['tutor_id']);
    $tutor_name = mysqli_real_escape_string($con, $_POST['tutor_name']);

    $sql = "INSERT INTO s_notifications (user_name, message, type) VALUES ('$tutor_name', '$message', '$type')";
    $result = mysqli_query($con, $sql);
    if($result){
        $success = "Notification saved successfully.";
    }else{
        $error = "Error while saving notification.";
    }
}

if (isset($_GET['delete'])) {
  $notificationId = $_GET['delete'];
  if (deleteNotification($notificationId)) {
    $success = "Notification deleted successfully.";
    header("Location: s_notification.php");
    exit();
  } else {
    $error = "Error while deleting notification.";
  }
}
?>

<!DOCTYPE html>
<html>
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
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="#" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
            </a>
    
    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="session.php">Create Class</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="create_assessments.php">Course Assessments</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" target="_blank" href="create_quiz.php?course_id=<?php echo $_SESSION['course_id']; ?>">Course Quiz</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" target="_blank" href="grading.php=<?php echo $_SESSION['course_id']; ?>">Grading</a>
        </li>
         <li class="nav-item">
          <a class="nav-link" target="_blank" href="s_notification.php">Notification</a>
        </li>
      </ul>
       <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ucwords($_SESSION["user_name"]); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../change_password.php" title="Password">Password</a>
                    <a class="dropdown-item" href="./addcourse.php">Back</a>
                    <a class="dropdown-item" href="../logout.php" title="Logout">Log out</a>
                </div>
            </li>
        </ul>
    </div>
      
  </nav>

  <div class="container-fluid">
 
  </div>

  </nav>


<div class="container">
  <h2>Notifications</h2>  
  <div class="card-body">
    <form method="post">
  <div class="form-group">
    <label for="message">Notification</label>
    <textarea class="form-control" id="message" name="message" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="type">Notification Type</label>
    <select class="form-control" id="type" name="type">
      <option value="info">Info</option>
      <option value="warning">Warning</option>
      <option value="error">Error</option>
    </select>
  </div>
  <?php
  $sql = "SELECT user_type, fname, id FROM users WHERE user_type = 'Student'";
  $result = mysqli_query($con, $sql);
  $optionsname = '';
  $optionsid = '';

  while ($row = mysqli_fetch_array($result)) {
    $optionsname .= '<option value="'.$row['fname'].'">'.$row['fname'].'</option>';
    $optionsid .= '<option value="'.$row['id'].'">'.$row['id'].'</option>';
  }
  ?>
  <select name="tutor_name">
    <?php echo $optionsname; ?>
  </select>
  <select name="tutor_id">
    <?php echo $optionsid; ?>
  </select>
  <button type="submit" name="submit" class="btn btn-primary">Send</button>
  <?php if(isset($success)): ?>
    <div class="alert alert-success mt-3" role="alert"><?php echo $success; ?></div>
  <?php endif; ?>
  <?php if(isset($error)): ?>
    <div class="alert alert-danger mt-3" role="alert"><?php echo $error; ?></div>
  <?php endif; ?>
</form>


    <!-- Display notifications -->
    <h3 class="mt-5">Recent Notifications:</h3>
    <table class="table">
      <thead>
        <tr>
          <th>Message</th>
          <th>Type</th>
          <th>Date</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $sql = "SELECT * FROM s_notifications ORDER BY created_at DESC";
        $result = mysqli_query($con, $sql);
        ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
          <tr>
            <td><?php echo $row['message']; ?></td>
            <td><span class="badge bg-<?php echo $row['type']; ?> text-white"><?php echo ucfirst($row['type']); ?></span></td>
            <td><?php echo $row['created_at']; ?></td>
            <td><a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm float-end">Delete</a></td>
          </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/mdb@5.5.1/dist/js/mdb.min.js"></script>
</body>
</html>
