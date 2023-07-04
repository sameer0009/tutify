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
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold text-center">Class Schedule</h1>
        <div class="mt-8 px-4">
            <table class="w-full bg-white border border-gray-200">
                <thead>
                    <tr>
                        <th class="p-3 border-b">Time</th>
                        <th class="p-3 border-b">Date</th>
                        <th class="p-3 border-b">Duration (min)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td class="p-3 border-b"><?php echo $row['class_time']; ?></td>
                        <td class="p-3 border-b"><?php echo $row['class_date']; ?></td>
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
