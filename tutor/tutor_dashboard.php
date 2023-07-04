<?php
session_start();
$_SESSION['id'];


if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');

$user_id = $_SESSION['id'];
$user = $_SESSION['user_name'];


$sql = "SELECT COUNT(*) as courses FROM course WHERE course_intsructor='$user'";
$result = $con->query($sql);


$courses = 0;

if ($result->num_rows > 0) {
  // Output data of each row
  while ($row = $result->fetch_assoc()) {
    $courses = $row["courses"];
  }
}

// Generate graph data
$graphData = array(
  array('Category', 'Count'),
  array('Courses', $courses)
);

// Convert graph data to JSON format
$graphJson = json_encode($graphData);

$sql = "SELECT * FROM users WHERE id = '$user_id'";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Include the Google Charts library -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {
      'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      var data = google.visualization.arrayToDataTable(<?php echo $graphJson; ?>);

      var options = {
        title: 'Total Courses',
        pieSliceText: 'value',
        is3D: true,
        legend: 'none',
        slices: {
          1: {
            offset: 0.2
          }, // Explode the second slice (index 1)
        }
      };

      var chart = new google.visualization.PieChart(document.getElementById('piechart'));

      chart.draw(data, options);
    }
  </script>

</head>

<body>
  <?php include('./t_head.php'); ?>
  <?php include('./t_header.php'); ?>


  <div class="container my-3">
    <div class="row">
      <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="col-md-7">
          <div class="card">
            <img class="card-img-top" style="width:100px" src="../uploads/<?php echo $row['picture']; ?>" alt="Profile Picture ">
            <div class="card-body">
              <h5 class="card-title"><?php echo $row['fname'] . ' ' . $row['lname']; ?></h5>
              <p class="card-text">Email: <?php echo $row['email']; ?></p>
              <p class="card-text">Phone: <?php echo $row['phone']; ?></p>
              <p class="card-text">Address: <?php echo $row['address']; ?></p>
              <p class="card-text">Hourly Rate: $<?php echo $row['hourly_rate']; ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  
    <h3>Analytics</h3>
    <div id="analytics">
      <div id="piechart" style="width: 500px; height: 300px;"></div>
    </div>
   <h3>Notifications</h3>
    <?php
    $user_name = $_SESSION['user_name'];
    $sql = "SELECT * FROM notifications WHERE user_name = '$user_name' AND is_read = 0 ORDER BY created_at DESC";
    $result = mysqli_query($con, $sql);
    ?>
    <div class="row">
      <div class="col-sm">
        <div class="card my-3">
          <div class="card-body">
            <?php if (mysqli_num_rows($result) == 0): ?>
              <p class="card-text">No notifications to display.</p>
            <?php endif; ?>
            <?php if (mysqli_num_rows($result) > 0): ?>
              <table class="table">
                <thead>
                  <tr>
                    <th style='color:black; font-weight:bold;'>Message</th>
                    <th style='color:black; font-weight:bold;'>Created At</th>
                    <th style='color:black; font-weight:bold;'>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                      <td><?php echo $row['message']; ?></td>
                      <td><?php echo date('M d, Y h:i A', strtotime($row['created_at'])); ?></td>
                      <td><button class="btn btn-danger mark-as-read" data-id="<?php echo $row['id']; ?>">Mark as read</button></td>
                    </tr>
                  <?php endwhile; ?>
                </tbody>
              </table>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  
    <h3>Schedule</h3>
    <div class="row">
      <div class="col-sm">
        <?php include('calender.php'); ?>
      </div>
    </div>
  </div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).on('click', '.mark-as-read', function() {
      var notificationId = $(this).data('id');
      $.ajax({
        url: 'mark_notification_as_read.php',
        type: 'POST',
        data: {
          id: notificationId
        },
        success: function(response) {
          if (response == 'success') {
            $(this).closest('tr').fadeOut();
          }
        }.bind(this)
      });
    });
  </script>

</body>

</html>
