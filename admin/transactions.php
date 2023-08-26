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
  <title>Transaction History </title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
 
  <style>
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

    .mcontainer {
      max-width: 1200px;
      margin:  auto;
      margin-top: auto;
      padding: auto;
      
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
      text-align: center;
      background-color: #fff;
    }
  </style>
</head>
<body>
  <?php  include ('./a_header.php')?>

  <br>
  <div class="mcontainer col-md-11">
    <h1>Transaction History - Admin</h1>
    <table class="highlight">
      <thead>
        <tr>
          <th>Payment ID</th>
          <th>Tutor ID</th>
          <th>Tutor Name</th>
          <th>Student Name</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
         include('../dbcon.php');

          // Fetch transaction history from the payment database table
          $sql = "SELECT id, user_id, course_instructor, fullname,course_price FROM payment";
          $result = $con->query($sql);

          if ($result->num_rows > 0) {
            // Display each transaction as a row in the table
            while ($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td>".$row["id"]."</td>";
              echo "<td>".$row["user_id"]."</td>";
              echo "<td>".$row["course_instructor"]."</td>";
              echo "<td>".$row["fullname"]."</td>";
              echo "<td>".$row["course_price"]."</td>";
              echo "</tr>";
            }
          } else {
            echo "<tr><td colspan='6'>No transactions found.</td></tr>";
          }

          // Close the database connection
          $con->close();
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>
</html>
