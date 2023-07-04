<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('Location: ../signin.php'); // redirect to the login page if the student is not logged in
    exit();
}

include('header.php');

?>

<html>

<head>
    <link href="../css/feedback_style.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.17/dist/tailwind.min.css" rel="stylesheet">
    <script>
        function validateForm() {
            var comment = document.forms["feedbackForm"]["comment"].value;
            var regex = /^[A-Za-z\s]+$/;
            if (!regex.test(comment)) {
                alert("Please enter only text in the comment field.");
                return false;
            }
        }
    </script>
</head>

<?php
include('../dbcon.php');

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $tutor_id = mysqli_real_escape_string($con, $_POST['tutor_id']);
    $tutor_name = mysqli_real_escape_string($con, $_POST['tutor_name']);
    $student_name = mysqli_real_escape_string($con, $_POST['student_name']);
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $rating = mysqli_real_escape_string($con, $_POST['rating']);
    $comment = mysqli_real_escape_string($con, $_POST['comment']);

    // Insert the review into the database
    $sql = "INSERT INTO tutor_reviews (feedback_tutor_id, tutor_name, student_name, student_id, rating, comment) VALUES ('$tutor_id', '$tutor_name', '$student_name', '$student_id', '$rating', '$comment')";
    if (mysqli_query($con, $sql)) {
        $success_message = "Review submitted successfully.";
    } else {
        $error_message = "Oops! Something went wrong. Please try again later.";
    }
}

?>

<?php
// Connect to the MySQL database

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Write a MySQL query to fetch data from the table
$sql = "SELECT user_type, fname, id FROM users";

// Execute the query and fetch the data in an array
$result = mysqli_query($con, $sql);
$optionsname = '';
$optionsid = '';

while ($row = mysqli_fetch_array($result)) {
    if ($row['user_type'] == "Teacher") {
        $optionsname .= '<option value="' . $row['fname'] . '">' . $row['fname'] . '</option>';
        $optionsid .= '<option value="' . $row['id'] . '">' . $row['id'] . '</option>';
    }
}
?>

<!-- Display the review form -->
<form name="feedbackForm" method="post" action="" class="w-full max-w-lg mx-auto my-8" onsubmit="return validateForm()">
    <h2 class="text-2xl font-bold mb-4">Tutor Feedback</h2>
    <?php
    if (!empty($success_message)) {
        echo '<div class="alert alert-success">' . $success_message . '</div>';
    }
    if (!empty($error_message)) {
        echo '<div class="alert alert-danger">' . $error_message . '</div>';
    }
    ?>
    <div class="flex flex-wrap mb-4">
        <div class="w-full md:w-1/2 md:pr-2">
            <label for="tutor_name" class="block text-gray-700 text-sm font-bold mb-2">Tutor Name</label>
            <select name="tutor_name" class="w-full border border-gray-300 rounded py-2 px-3">
                <?php echo $optionsname; ?>
            </select>
        </div>
        <div class="w-full md:w-1/2 md:pl-2">
            <label for="tutor_id" class="block text-gray-700 text-sm font-bold mb-2">Tutor ID</label>
            <select name="tutor_id" class="w-full border border-gray-300 rounded py-2 px-3">
                <?php echo $optionsid; ?>
            </select>
        </div>
    </div>
    <input type="hidden" name="student_id" value="<?php echo $_SESSION['id']; ?>">
    <input type="hidden" name="student_name" value="<?php echo $_SESSION['user_name']; ?>">

    <div class="mb-4">
        <h4 class="text-lg font-bold">Rate the Tutor</h4>
        <div class="rating">
            <input type="radio" id="star1" name="rating" value="5">
            <label class="rating-star" for="star1" title="1 star"></label>
            <input type="radio" id="star2" name="rating" value="4">
            <label class="rating-star" for="star2" title="2 stars"></label>
            <input type="radio" id="star3" name="rating" value="3">
            <label class="rating-star" for="star3" title="3 stars"></label>
            <input type="radio" id="star4" name="rating" value="2">
            <label class="rating-star" for="star4" title="4 stars"></label>
            <input type="radio" id="star5" name="rating" value="1">
            <label class="rating-star" for="star5" title="5 stars"></label>
        </div>
    </div>

    <div class="mb-4">
        <label for="comment" class="block text-gray-700 text-sm font-bold mb-2">Comment</label>
        <textarea name="comment" class="w-full border border-gray-300 rounded py-2 px-3" rows="4" required></textarea>
    </div>

    <input type="submit" value="Submit Review" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
</form>

</body>

</html>
