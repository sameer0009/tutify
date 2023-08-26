<?php
session_start();

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');

// Check if the connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve scheduled classes
$sql = "SELECT id, class_time, class_date, class_duration FROM class_schedule ORDER BY class_date, class_time";
$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Class Schedule</title>
   
    <style >
        table {
    width: 100%;
    border-collapse: collapse;
    border: 1px solid #ccc;
}

/* Style for table headers */
th {
    padding: 10px;
    border-bottom: 1px solid #ccc;
    background-color: #f7f7f7;
    text-align: left;
}

/* Style for alternating table rows */
tr:nth-child(even) {
    background-color: #f2f2f2;
}

/* Style for table cells */
td {
    padding: 10px;
    border-bottom: 1px solid #ccc;
}

/* Style for rows with class duration over 60 minutes */
tr.bg-yellow-100 {
    background-color: #ffffcc; /* Light yellow */
}
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/t_dash_style.css" rel="stylesheet">
    <link href="../css/nav_style.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light ">
    <a href="#" class="navbar-brand ml-lg-3">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ucwords($_SESSION["user_name"]); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="session.php"  title ="Back">Back</a>
                    <a class="dropdown-item" href="../change_password.php" title="Password">Password</a>

                    <a class="dropdown-item" href="../logout.php" title="Logout">Log out</a>

                </div>
            </li>
        </ul>
    </div>
</nav>

    <div class="container mx-auto py-11">
        <h1 class="text-3xl font-bold text-center">Class Schedule</h1>
        <div class="mt-8 px-4">
           
<table class="w-full bg-white border border-gray-200">
    <thead>
        <tr class="bg-gray-100">
            <th class="p-3 border-b">Time</th>
            <th class="p-3 border-b">Date</th>
            <th class="p-3 border-b">Duration (min)</th>
        </tr>
    </thead>
    <tbody>
        <?php while($row = mysqli_fetch_array($result)): ?>
        <tr class="<?php echo $row['class_duration'] > 60 ? 'bg-yellow-100' : ''; ?>">
            <td class="p-3 border-b"><?php echo $row['class_time']; ?></td>
            <td class="p-3 border-b"><?php echo date('M j, Y', strtotime($row['class_date'])); ?></td>
            <td class="p-3 border-b"><?php echo $row['class_duration']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
            <div class="mt-8 flex justify-center">
                <a href="session.php" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-4">Schedule a Class</a>
                <a href="session.php" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Back</a>
            </div>
        </div>
    </div>
</body>
</html>
