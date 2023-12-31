<?php
session_start();

include('../dbcon.php');

$course_id = $_SESSION['course_id'];



$sql = "SELECT * FROM `submissions` WHERE course_id = $course_id AND is_graded = 0";

$query = mysqli_query($con, $sql);

if (!$query) {
    // Handle query execution error
    die('Error executing the query: ' . mysqli_error($con));
}



if (!$query) {
    // Handle query execution error
    die('Error executing the query: ' . mysqli_error($con));
}

$result = mysqli_num_rows($query);
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $u_id = $_POST['user_id'];
    $c_id = $_POST['course_id'];
    $a_id = $_POST['assesment_id'];
    $grade = $_POST['grade'];

    $sqlg = "INSERT INTO `grades`(`course_id`, `assesment_id`, `user_id`, `grade`) VALUES ('$c_id','$a_id','$u_id','$grade')";
    $queryg = mysqli_query($con, $sqlg);

    if (!$queryg) {
        // Handle query execution error
        die('Error executing the query: ' . mysqli_error($con));
    }

    // Update is_graded column in submissions table
    $sqlu = "UPDATE `submissions` SET `is_graded`=1 WHERE `course_id`='$c_id' AND `assesment_id`='$a_id' AND `user_id`='$u_id'";
    $queryu = mysqli_query($con, $sqlu);

    if (!$queryu) {
        // Handle query execution error
        die('Error executing the query: ' . mysqli_error($con));
    }

    // Show success message
    $success_message = "Grade entered successfully.";
    header("url=grading.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tutor Grading</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- Custom CSS -->
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
     <style>
       
        
        .grading-table {
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 20px;
        }
        .grading-table h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .grading-table table {
            width: 100%;
            border-collapse: collapse;
        }
        .grading-table th,
        .grading-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border-radius: 5px;
        }
        .grading-table th {
            background-color: #f0f0f0;
        }
        .grading-table input[type="text"] {
            width: 50%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s ease-in-out;
        }
        .grading-table input[type="text"]:focus {
            border-color: #007bff;
        }
        .grading-table button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 4px;
            transition: background-color 0.3s ease-in-out;
        }
        .grading-table button:hover {
            background-color: #0056b3;
            cursor: pointer;
        }
        .success-message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light ">
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
        <div class="grading-table">
            <h2>Tutor Grading</h2>
            <?php if (isset($success_message)): ?>
                <div class="success-message"><?php echo $success_message; ?></div>
            <?php endif; ?>
            <table>
                <thead>
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Assesment</th>
                        <th>Grade</th>
                    </tr>
                </thead>
                <tbody>
                   <?php
if ($result > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?php echo $row['user_id'] ?></td>
            <td><?php echo $row['username'] ?></td>
            <td><a href="<?php echo $row['path']; ?>" target="_blank">Click To Open</a></td>
            <td>
                <form action="" method="POST">
                    <input type="hidden" name="user_id" value="<?php echo $row['user_id'] ?>">
                    <input type="hidden" name="course_id" value="<?php echo $row['course_id'] ?>">
                    <input type="hidden" name="assesment_id" value="<?php echo $row['assesment_id'] ?>">
                    <input type="text" name="grade" placeholder="Enter grade">
                    <button type="submit"><i class="fas fa-check"></i> Submit</button>

                </form>
            </td>
        </tr>
        <?php
    }
}
?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <!-- Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js"></script>
</body>
</html>
