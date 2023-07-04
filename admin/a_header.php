<!DOCTYPE html>
<html>
<head>
  <title>Admin Panel</title>
  <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<!-- Add this to the head section of your HTML file -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+XRMa9XfLydia1EmW1Kk5V7ZdJlqo7" crossorigin="anonymous">


    <!-- Google Web Fonts -->
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 

<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<!-- Libraries Stylesheet -->
<link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

<!-- Customized Bootstrap Stylesheet -->
<link href="../css/style.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="../css/nav_style.css" rel="stylesheet">
<!-- plugins:css -->
<link rel="stylesheet" href="assets/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" href="assets/vendors/chartist/chartist.min.css">
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css" />
    <script src="http://js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
    
    
</head>
<body>
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#"><?php echo $_SESSION['user_name']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="admin.php">Home</a>
          </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_list.php">Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="transactions.php">Transactions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="manage_percentage.php" target="_blank">Percentage</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./tsa_subject.php">TSA</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="notification.php">Notification</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Manage_payments.php">Payments</a>
        </li>
      </ul>
    </div>
    <a href="../logout.php" title="Logout" class="btn btn-danger py-2 px-2 d-none d-lg-block">Log out</a>
  </nav>
  