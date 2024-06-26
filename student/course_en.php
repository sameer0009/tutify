<?php
session_start();
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php');
  exit();
}

include('../dbcon.php');

if (isset($_POST['submit'])) {
    $_SESSION['c_name'] = $_POST['course_name'];
    $_SESSION['c_id'] = $_POST['course_id'];
    $_SESSION['c_price'] = $_POST['course_price'];
    $_SESSION['c_instructor'] = $_POST['course_instructor'];
    $_SESSION['c_instructor_id'] = $_POST['instructor_id'];

    header('Location:../payment.php');
}

// Handle search filter
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $query = "SELECT course_id, course_name, course_description, course_duration, course_price, course_intsructor, instructor_id FROM course WHERE course_name LIKE '%$search%'";
} else {
    $query = "SELECT course_id, course_name, course_description, course_duration, course_price, course_intsructor, instructor_id FROM course";
}

$query_run = mysqli_query($con, $query);
$course_count = mysqli_num_rows($query_run);
?>

<!DOCTYPE html>
<html>

<?php
include('./header.php');
?>

<head>
  <!-- Tailwind CSS -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">
<div class="container mx-auto py-8">
    <div class="flex justify-end mb-4">
      <form method="get" class="flex items-center">
        <input type="text" name="search" placeholder="Search by course name" class="px-4 py-2 rounded-l-md border border-gray-300 focus:ring focus:ring-blue-300">
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md">Search</button>
      </form>
    </div>
  
    <div class="flex flex-wrap">
      <?php
      if ($course_count > 0) {
        while ($row = mysqli_fetch_array($query_run)) {
          ?>
          <div class="w-full md:w-1/2 lg:w-1/3 px-3 mb-4">
            <div class=" bg-gradient-to-l from-green-100 to-blue-200 shadow-md rounded-lg p-6">
              <h4 class="text-lg font-bold mb-4">Instructor: <?php echo $row['course_intsructor'] ?></h4>
              <p class="mb-2"><b>Name:</b> <?php echo $row['course_name'] ?></p>
              <p class="mb-2"><b>ID:</b> <?php echo $row['course_id'] ?></p>
              <p class="mb-2"><b>Duration:</b> <?php echo $row['course_duration'] ?></p>
              <p class="mb-2"><b>Price:</b> <?php echo $row['course_price'] ?> PKR</p>
              <p class="mb-4"><b>Description:</b> <?php echo $row['course_description'] ?></p>

              <form method="post">
                <input type="hidden" name="course_id" value="<?php echo $row['course_id'] ?>">
                <input type="hidden" name="course_price" value="<?php echo $row['course_price'] ?>">
                <input type="hidden" name="course_name" value="<?php echo $row['course_name'] ?>">
                <input type="hidden" name="course_instructor" value="<?php echo $row['course_intsructor'] ?>">
                <input type="hidden" name="instructor_id" value="<?php echo $row['instructor_id'] ?>">

                <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enroll</button>
              </form>
            </div>
          </div>
      <?php
        }
      } else {
        echo "<p>No courses found.</p>";
      }
      ?>
    </div>
  </div>
</body>

</html>
