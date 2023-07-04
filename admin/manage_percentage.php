<?php
include('../dbcon.php');

if (isset($_POST['submit'])) {
  $platform_percentage=$_POST['platform_percentage'];

  $sql="UPDATE `platform_fee` SET `platform_percentage`=$platform_percentage";
  mysqli_query($con,$sql);
}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Payment Management</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.7.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f7fafc;
      font-family: Arial, sans-serif;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border-radius: 5px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
    }

    .alert {
      margin-bottom: 20px;
    }

    .form-label {
      font-weight: bold;
    }

    .form-control {
      width: 80%;
      padding: 10px;
      border-radius: 5px;
      border: 1px solid #ccc;
      transition: border-color 0.3s ease;
    }

    .form-control:focus {
      border-color: #80bdff;
      outline: none;
    }

    .btn-primary {
      display: block;
      width: 100%;
      padding: 10px;
      border-radius: 5px;
      background-color: #007bff;
      color: #fff;
      font-size: 16px;
      text-align: center;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>
  <div class="container mt-4">
    <h1>Payment Management</h1>

    <?php if (isset($message)) { ?>
      <div class="alert alert-<?php echo isset($error) ? 'danger' : 'success'; ?>">
        <?php echo $message; ?>
      </div>
    <?php } ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label" for="platform_percentage">Percentage:</label>
        <input type="text" maxlength="2" step="0.01" class="form-control" id="platform_percentage" name="platform_percentage" required>
      </div>
      <br>
      <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</body>
</html>
