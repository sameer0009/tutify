<?php
session_start();
//print_r($_SESSION['id']);

// Check if the withdrawal form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  include('../dbcon.php');
  $tutor_id = $_SESSION['id'];
  $withdraw_amount = $_POST['withdraw_amount'];

  // Update the withdraw_check value to 1 for the selected salaries
  $query = "UPDATE salary SET withdraw_check = 1 WHERE tutor_id = $tutor_id && withdraw_check = 0 LIMIT $withdraw_amount";
  $result = $con->query($query);

  if ($result) {
    echo '<script>alert("Withdrawal successful!");</script>';
  } else {
    echo '<script>alert("Withdrawal failed.");</script>';
  }

  // Close the database connection
  $con->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Professional Tutor Salary Management</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <style>
  

    .brand-logo {
      font-size: 24px;
      font-weight: 500;
    }

    .container {
      margin-top: 80px;
      padding: 20px;
    }

    .card-panel {
      padding: 20px;
    }

    h3 {
      margin-bottom: 20px;
      font-weight: 500;
    }

    table {
      margin-bottom: 20px;
    }

    .total-amount {
      margin-top: 40px;
      font-size: 18px;
      font-weight: 500;
    }

    .withdrawal-pane {
      margin-top: 40px;
    }

    .withdraw-amount {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>
  <?php include('./t_head.php'); ?>
  <?php include('./t_header.php'); ?>
  <div class="container">
    <div class="card">
      <h3 class="black-text">Tutor Salary Details</h3>
      <table class="striped responsive-table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Amount</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include('../dbcon.php');
          $tutor_id = $_SESSION['id'];

          // Fetch salary details from the 'salary' table
          $query = "SELECT id, amount FROM salary WHERE tutor_id = $tutor_id && withdraw_check = '0'";
          $result = $con->query($query);

          $totalAmount = 0;

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $id = $row['id'];
              $amount = $row['amount'];
              $totalAmount += $amount;
              ?>
              <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $amount; ?></td>
              </tr>
              <?php
            }
          } else {
            echo '<tr><td colspan="2">No salary details found.</td></tr>';
          }

          // Close the database connection
          $con->close();
          ?>
        </tbody>
      </table>

      <h4 class="black-text total-amount">Total Amount: <?php echo $totalAmount; ?></h4>

      <div class="row withdrawal-pane">
        <div class="col s12 m6">
          <form id="withdrawal-form" method="POST" action="">
            <h4 class="black-text">Withdrawal Pane</h4>
            <div class="row">
              <div class="input-field col s12">
                <input id="withdraw-amount" name="withdraw_amount" type="number" class="validate withdraw-amount" value="<?php echo $totalAmount?>" readonly>
                <label for="withdraw-amount">Withdraw Amount</label>
              </div>
            </div>
            <button class="btn waves-effect waves-light" type="submit" name="action">Withdraw</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>


</body>
</html>
