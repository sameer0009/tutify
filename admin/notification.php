<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: ../join.php'); // redirect to the login page if the student is not logged in
  exit();
  $user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <link href="../css/a_noti_style.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/mdb@5.5.1/dist/css/mdb.min.css" rel="stylesheet">
</head>
<?php
include ('./a_header.php');
?>
<br> 
<?php
include('../dbcon.php');

// Function to delete a notification
function deleteNotification($notificationId) {
  global $con;
  $sql = "DELETE FROM notifications WHERE id = $notificationId";
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

    if (!preg_match('/^[A-Za-z\s]+$/', $message)) {
      $error = "Please enter text only for the notification.";
    } else {
      $sql = "INSERT INTO notifications ( user_name, message, type) VALUES ('$tutor_name', '$message', '$type')";
      $result = mysqli_query($con, $sql);
      if($result){
          $success = "Notification saved successfully.";
      }else{
          $error = "Error while saving notification.";
      }
    }
}

if (isset($_GET['delete'])) {
  $notificationId = $_GET['delete'];
  if (deleteNotification($notificationId)) {
    $success = "Notification deleted successfully.";
    header('Location: notification.php'); // Redirect to the same page after successful deletion
    exit();
  } else {
    $error = "Error while deleting notification.";
  }
}
?>

<div class="container col-md-11">
  <h2>Notifications</h2>  
  <div class="card-body">
    <form method="post">
      <div class="form-group">
        <label for="message">Notification</label>
        <textarea class="form-control" id="message" name="message" rows="3" required pattern="[A-Za-z\s]+" oninvalid="this.setCustomValidity('Please enter text only.')" oninput="this.setCustomValidity('')"></textarea>
      </div>
      <div class="form-group">
        <label for="type">Notification Type</label>
        <select class="form-control" id="type" name="type" required>
          <option value="info">Info</option>
          <option value="warning">Warning</option>
          <option value="error">Error</option>
        </select>
      </div>
      <?php
      $sql = "SELECT user_type, fname, id FROM users";

      // Execute the query and fetch the data in an array
      $result = mysqli_query($con, $sql);
      $optionsname = '';
      $optionsid = '';
      
      while ($row = mysqli_fetch_array($result)) {
        if ($row['user_type'] == "Teacher") {
          $optionsname .= '<option value="'.$row['fname'].'">'.$row['fname'].'</option>';
          $optionsid .= '<option value="'.$row['id'].'">'.$row['id'].'</option>';
        }
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
        $sql = "SELECT * FROM notifications ORDER BY created_at DESC";
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
