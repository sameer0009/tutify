<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php');
  exit();
}

include ('../dbcon.php');

// Retrieve the search query
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Retrieve the filter value
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Build the SQL query based on the search and filter values
$query = "SELECT * FROM enrolmentt WHERE user_id='".$_SESSION['id']."'";

if (!empty($search)) {
  // Add search condition to the query
  $query .= " AND (course_name LIKE '%".$search."%' OR course_id LIKE '%".$search."%')";
}

if (!empty($filter)) {
  // Add filter condition to the query
  $query .= " AND course_id = '".$filter."'";
  
}

$query_run = mysqli_query($con, $query);
$course = mysqli_num_rows($query_run);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <title>Student Dashboard</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="../css/enroled_course_style.css">
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class=" bg-white">
  <!-- Navigation Bar -->
  <nav class="navbar navbar-expand-lg text font-semibold ">
    <a class="navbar-brand" href="#"><?php echo $_SESSION['user_name']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-2">
        <li class="nav-item active mx-2">
          <a class="nav-link" href="./student_dashboard.php">Home</a>
        </li>
        <li class="nav-item active mx-2">
          <a class="nav-link" href="student_profile.php">Profile Management</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="./course_en.php">Course</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="./enrolled_courses.php">Enrolled Courses</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="#tutor-list">Tutor List</a>
        </li>
        <li class="nav-item mx-2">
          <a class="nav-link" href="./feedback.php">FeedBack</a>
        </li>
      </ul>
    </div>
    <a href="../logout.php" title="Logout" class="btn btn-danger py-2 px-2 d-none d-lg-block">Log out</a>
  </nav>

  <div class="container mx-auto ">
    <div class="flex flex-wrap mt-8">
      <div class="w-full mb-4">
        <form class="flex items-center justify-end">
          <div class="relative mr-4">
            <input type="text" name="search" placeholder="Search" class="bg-gray-200 rounded-full py-3 px-6 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-600" value="<?php echo $search; ?>">
            <span class="absolute top-0 left-0 ml-3 mt-3">
              <i class="fas fa-search text-gray-500"></i>
            </span>
          </div>
          <div class="relative mr-4">
            <select name="filter" class="bg-gray-200 rounded-full py-3 px-5 pr-10 focus:outline-none focus:ring-2 focus:ring-blue-600">
              <option value="">All</option>
              <option value="1" <?php if ($filter == '1') echo 'selected'; ?>>course_name</option>
             

            </select>
            <span class="absolute top-0 right-0 mt-3 mr-3">
          
            </span>
          </div>
          <button type="submit" class="bg-blue-600 text-white rounded-full py-2 px-4 hover:bg-blue-400 focus:outline-none focus:ring-2 focus:ring-blue-600">Search</button>
        </form>
      </div>
      
      <?php
      if ($course > 0) {
        while ($row = mysqli_fetch_array($query_run)) {
      ?>
      <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 p-2">
        <div class=" bg-gradient-to-bl from-green-200 to-blue-100 rounded-lg shadow-lg">
          <div class="p-20">
            <h4 class="text-lg font-bold mb-2"><?php echo $row['course_name'] ?></h4>
            <p class="text-gray-600"><b>ID:</b> <?php echo $row['course_id'] ?></p>
            <form method="post" action="./enrolled_course_materil.php">
              <input type="hidden" name="course_id" value="<?php echo $row['course_id'] ?>">
              
              <button type="submit" name="submit" class="bg-blue-600 text-white rounded-full py-2 px-4 mt-4 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Details</button>
            </form>
          </div>
        </div>
      </div>
      <?php
        }
      } else {
      ?>
      <div class="w-full text-center">
        <p>No courses found.</p>
      </div>
      <?php
      }
      ?>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
