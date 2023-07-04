<?php
session_start();
include('../dbcon.php');

$course_id = $_SESSION['course_id'];



// Initialize the $_SESSION['assesment_id'] variable with a default value
//$_SESSION['assesment_id'] = '';

// Check if the assessment ID is provided
if (isset($_POST['submit'])) {
  $id=$_POST['assesment_id'];

  // Construct the delete statement
  $delete_query = "DELETE FROM assesment WHERE assesment_id = $id";

  // Execute the delete statement
  if ($con->query($delete_query) === TRUE) {
    // Delete successful, redirect back to the Manage Assessments page
    $_SESSION['success_message'] = "Assessment deleted successfully";
    header("Location: manage_assessments.php");
    exit();
  } else {
    // Delete failed, display error message
    $_SESSION['error_message'] = "Failed to delete assessment";
    header("Location: manage_assessments.php");
    exit();
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Assessments</title>
  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

  <!-- Custom CSS -->
  <style>
    /* Add custom styles here */
    .container {
      position: relative;
    }

    .table-container {
      overflow-x: auto;
    }

    .table-container::-webkit-scrollbar {
      height: 0.4rem;
    }

    .table-container::-webkit-scrollbar-thumb {
      background-color: rgba(156, 163, 175, 0.8);
      border-radius: 0.25rem;
    }

    .table-container::-webkit-scrollbar-track {
      background-color: transparent;
    }

    table {
      border-collapse: collapse;
      width: 100%;
    }

    th,
    td {
      border: 1px solid #dee2e6;
      padding: 8px;
      text-align: left;
    }

    th {
      background-color: #f8fafc;
    }

    /* Custom styles */
    .back-button {
      background-color: blue;
      color: white;
      padding: 5px 20px;
      border-radius: 4px;
      margin-bottom: 10px;
      cursor: pointer;
      float: bottom; /* Correction: changed "buttom" to "bottom" */
      position: absolute;
      top: 0;
      left: 0;
    }

    .back-button:hover {
      background-color: #718096;
    }
  </style>

</head>

<body class="bg-gray-100">
  <div class="container mx-auto mt-5">
    <h1 class="text-center text-3xl font-bold mb-5">Manage Assessments</h1>
    <div class="bg-white rounded shadow-lg p-6">
      <div class="table-container">
        <table class="min-w-full">
          <thead>
            <tr>
              <th class="py-2 px-4">Assessment Title</th>
              <th class="py-2 px-4">Assessment Type</th>
              <th class="py-2 px-4">Due Date</th>
              <th class="py-2 px-4">Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Loop through assessments and display each row -->
            <?php
            // Replace with your own logic to fetch and iterate through assessments from the database
            $sql = "SELECT * FROM assesment WHERE course_id = '$course_id'";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
              // Output data of each row
              while ($row = $result->fetch_assoc()) {
                $title = $row['assesment_title'];
                $type = $row['assesment_type'];
                $due_date = $row['due_date'];
                $assesment_id= $row['assesment_id'];
            ?>
                <tr>
                  <td class="py-2 px-4"><?php echo $title; ?></td>
                  <td class="py-2 px-4"><?php echo $type; ?></td>
                  <td class="py-2 px-4"><?php echo $due_date; ?></td>
                  <td class="py-2 px-4">
                    <form action="" method="POST">
                      <input type="hidden" name="assesment_id" value="<?php echo $assesment_id?>">
                      <button type="submit" name="submit" class="text-red-500 hover:text-red-700">Delete</button>
                    </form>
                    <br>
                  </td>
                </tr>
            <?php
              }
            } else {
              echo "<tr><td colspan='4'>No assessments found</td></tr>";
            }
            $con->close();
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <button onclick="window.location.href = './create_assessments.php';" class="back-button">Back</button>
  </div>
</body>

</html>
