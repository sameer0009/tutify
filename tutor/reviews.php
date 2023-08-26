<?php
session_start();
$_SESSION['id'];
$_SESSION['user_name'];
?>

<?php
include('../dbcon.php');

// Connect to the database

// Get the tutor ID from the URL parameter
$tutor_id = $_SESSION['id'];

// Get the tutor's reviews
$sql = "SELECT rating, comment, student_name FROM tutor_reviews WHERE feedback_tutor_id=$tutor_id";
$result = mysqli_query($con, $sql);
$reviews = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Calculate overall rating
$overallRating = 0;
$totalReviews = count($reviews);
foreach ($reviews as $review) {
    $overallRating += $review['rating'];
}
if ($totalReviews > 0) {
    $overallRating /= $totalReviews;
    $overallRating = round($overallRating, 1);
}

// Close the database connection
mysqli_close($con);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tutor Reviews - <?php echo $_SESSION['user_name'] ?></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        .container {
            margin-top: 50px;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .review-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .review-table th, .review-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .stars {
            font-size: 24px;
            color: gold;
        }
        .overall-rating {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
        }
    </style>
    <?php
    include('./t_head.php');
    ?>
</head>
<body>

<!-- Navigation Bar -->
<?php include('./t_header.php');?>
<!-- End of Navigation Bar -->

<div class="container">
    <input type="hidden" name="tutor_id" value="<?php echo $_SESSION['id'];?>">
    <h1>Reviews for <?php echo $_SESSION['user_name']; ?></h1>
    <?php if ($totalReviews > 0): ?>
        <table class="review-table">
            <tr>
                <th>Rating</th>
                <th>Review</th>
            </tr>
            <?php foreach ($reviews as $review): ?>
                <tr>
                    <td class="stars"><?php echo str_repeat("★", $review['rating']) ?></td>
                    <td><?php echo $review['comment']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No reviews available.</p>
    <?php endif; ?>

    <?php if ($totalReviews > 0): ?>
        <div class="overall-rating">
            Overall Rating: <?php echo $overallRating; ?>/5
        </div>
    <?php endif; ?>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
