  <?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: ../join.php'); // redirect to the login page if the student is not logged in
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Payment Page</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    /* Custom CSS for Admin Payment Page */
    .header {
      background-color: #f8f9fa;
      padding: 20px;
    }
    .header h1 {
      margin: 0;
      color: #333;
    }
    table {
      margin-top: 20px;
      border-collapse: collapse;
      width: 100%;
    }
    table th {
      background-color: #f8f9fa;
      color: #333;
      font-weight: bold;
      padding: 10px;
    }
    table td {
      color: #333;
      padding: 10px;
    }
    form {
      margin-top: 20px;
      max-width: 400px;
    }

    .form-group label {
      font-weight: bold;
    }

    .btn-primary {
      background-color: #007bff;
      border-color: #007bff;
      padding: 10px 20px;
      color: #fff;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0069d9;
      border-color: #0062cc;
    }

    .form-control {
      border-radius: 4px;
      border: 1px solid #ccc;
      padding: 10px;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #007bff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .container {
      max-width: 800px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      text-align: left;
      background-color: #fff;
    }
  </style>
</head>

<body>
  <?php include ('./a_header.php'); ?>
  <br>
  <div class="container col-md-11">
    <h2>Payment Details</h2>

    <table class="table table-striped">
      <thead>
        <tr>
          <th>Payment ID</th>
          <th>Tutor ID</th>
          <th>Tutor Name</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
          include ('../dbcon.php');
          $sql = "SELECT `id`, `course_instructor`, `instructor_id`, `tutor_fee` ,`salary_check` FROM `payment` WHERE salary_check='0'";
          $result = mysqli_query($con, $sql);

          if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>".$row['id']."</td>";
              echo "<td>".$row['instructor_id']."</td>";
              echo "<td>".$row['course_instructor']."</td>";
              echo "<td>".$row['tutor_fee']."</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='4'>No payments found.</td></tr>";
          }

          mysqli_close($con);
        ?>
      </tbody>
    </table>

    <!-- Customized Payment -->
    <h2>Customized Payment</h2>

    <form method="post" action="process_payment.php">
      <div class="form-group">
        <label for="tutor_id">Tutor ID:</label>
        <select class="form-control" id="tutor_id" name="tutor_id" required>
          <option value="">Select a tutor ID</option>
          <?php
            include('../dbcon.php');
            $sql = "SELECT instructor_id, SUM(tutor_fee) AS total_fee FROM payment WHERE salary_check='0' GROUP BY instructor_id";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['instructor_id']."'>".$row['instructor_id']."</option>";
            }
            mysqli_close($con);
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="tutor_name">Tutor Name:</label>
        <select class="form-control" id="tutor_name" name="tutor_name" required>
          <option value="">Select a tutor name</option>
          <?php
            include('../dbcon.php');
            $sql = "SELECT instructor_id, course_instructor, SUM(tutor_fee) AS total_fee FROM payment WHERE salary_check='0' GROUP BY instructor_id";
            $result = mysqli_query($con, $sql);
            while ($row = mysqli_fetch_assoc($result)) {
              echo "<option value='".$row['course_instructor']."' data-amount='".$row['total_fee']."'>".$row['course_instructor']."</option>";
            }
            mysqli_close($con);
          ?>
        </select>
      </div>
      <div class="form-group">
        <label for="amount">Amount:</label>
        <input type="number" class="form-control" id="amount" name="amount" required readonly>
      </div>
      <button type="submit" class="btn btn-primary">Initiate Payment</button>
    </form>
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  <script>
    // Populate the amount field based on the selected tutor ID and name
    document.getElementById("tutor_name").addEventListener("change", function() {
      var selectedOption = this.options[this.selectedIndex];
      document.getElementById("amount").value = selectedOption.getAttribute("data-amount");
    });
  </script>
</body>
</html>
