<?php
session_start();
include('../dbcon.php');

if(isset($_POST['edit_submit'])) {
  $assesment_id = $_POST['assessment_id'];
  
  // Fetch assessment data based on the assessment ID
  $fetch_query = "SELECT * FROM assesment WHERE assesment_id = $assesment_id"; 
  $result = $con->query($fetch_query);
  
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['assesment_title'];
    $type = $row['assesment_type'];
    $due_date = $row['due_date'];
  } 
  // Remove 'exit();' here
}

if(isset($_POST['update_submit'])) {
  $assesment_id = $_POST['assesment_id'];
  $new_due_date = $_POST['new_due_date'];
  
  // Update assessment due date in the database
  $update_query = "UPDATE assesment SET due_date = '$new_due_date' WHERE assesment_id = $assesment_id"; // Removed other columns from the query
  
  if ($con->query($update_query) === TRUE) {
    $_SESSION['success_message'] = "Due date updated successfully";
    header("Location: manage_assessments.php");
    exit();
  } else {
    $_SESSION['error_message'] = "Failed to update due date";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <a name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <!-- Quill CSS -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <!-- Customized Bootstrap Stylesheet -->
  <link href="../css/style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: white;
    }

    h1 {
      text-align: center;
      margin-top: 20px;
    }

    .container {
      max-width: auto;
      margin:  auto;
      margin-top: 10px;
      align-items: center;
      text-align: center;
      padding: 20px;
      background-color: #fff;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
    }

    input[type="date"] {
      width: 50%;
      padding: 8px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      box-sizing: border-box;
    }

    button[type="submit"] {
  display: block;
  width: 40%;
  margin: 0 auto; /* Center-align horizontally */
  padding: 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  text-align: center; /* Center-align text within the button */
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}
    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .error-message {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <a href="#" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
            </a>
    
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
    

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
<div class="container">
  <h1>Edit Assessment</h1>
  <?php
  if(isset($_SESSION['error_message'])) {
    echo "<p style='color: red;'>".$_SESSION['error_message']."</p>";
    unset($_SESSION['error_message']);
  }
  ?>
  <form action="" method="POST">
    <input type="hidden" name="assesment_id" value="<?php echo $assesment_id ?>">
    <!-- Only display the due date field -->
    <label for="new_due_date">New Due Date:</label>
    <input type="date" name="new_due_date" value="<?php echo $due_date ?>"><br>
    <button type="submit" name="update_submit">Update Due Date</button>
  </form>
</div>
</body>
</html>
