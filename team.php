<?php
require('./dbcon.php');

// Get search and filter values from the form
$search = isset($_GET['search']) ? $_GET['search'] : '';
$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

// Construct the SQL query
$sql = "SELECT * FROM users WHERE user_type='Teacher'";

// Add search condition if the search value is provided
if (!empty($search)) {
    $sql .= " AND fname LIKE '%$search%'";
}

// Add filter condition if the filter value is provided
if (!empty($filter)) {
    if ($filter === 'experience') {
        $sql .= " ORDER BY experience ASC";
    } elseif ($filter === 'hourly_rate') {
        $sql .= " ORDER BY hourly_rate ASC";
    }
}

$sql_run = mysqli_query($con, $sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Tutify - Online Education Website</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        .search-form {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .search-form input[type="text"],
        .search-form select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-right: 10px;
        }

        .search-form button {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>


    <!-- Navbar Start -->
    <?php include('index_header.php'); ?>
    <!-- Navbar End -->


    <!-- Header Start -->
    <div class="jumbotron jumbotron-fluid page-header position-relative overlay-bottom" style="margin-bottom: 90px;">
        <div class="container text-center py-5">
            <h1 class="text-white display-1">Instructors</h1>
            <div class="d-inline-flex text-white mb-5">
                <p class="m-0 text-uppercase"><a class="text-white" href="">Home</a></p>
                <i class="fa fa-angle-double-right pt-1 px-3"></i>
                <p class="m-0 text-uppercase">Instructors</p>
            </div>

        </div>
    </div>
    <!-- Header End -->


    <!-- Team Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="section-title text-center position-relative mb-5">
                <h6 class="d-inline-block position-relative text-secondary text-uppercase pb-2">Instructors</h6>
                <h1 class="display-4">Meet Our Instructors</h1>
            </div>

            <!-- Search Form -->
            <form class="search-form" method="get" action="">
                <input type="text" name="search" placeholder="Search by name" value="<?php echo $search; ?>">
                <select name="filter">
                    <option value="">Sort by</option>
                    <option value="experience" <?php echo $filter === 'experience' ? 'selected' : ''; ?>>Experience</option>
                    <option value="hourly_rate" <?php echo $filter === 'hourly_rate' ? 'selected' : ''; ?>>Hourly Rate</option>
                </select>
                <button type="submit">Search</button>
            </form>

            <div class="owl-carousel team-carousel position-relative" style="padding: 0 30px;">
                <?php
                if (mysqli_num_rows($sql_run) > 0) {
                    while ($row = mysqli_fetch_assoc($sql_run)) {
                ?>
                        <div class="team-item">
                            <img class="img-fluid w-100" src="uploads/<?php echo $row['picture']; ?>" alt="">
                            <div class="bg-light text-center p-4">
                                <h5 class="mb-3"><?php echo $row['fname']; ?></h5>
                                <h5 class="mb-3"><?php echo $row['experience']; ?></h5>
                                <h5 class="mb-3"><?php echo $row['email']; ?></h5>
                                <h5 class="mb-3">$<?php echo $row['hourly_rate']; ?></h5>
                                <p class="mb-2"> </p>
                                <div class="d-flex justify-content-center">
    <a class="btn btn-primary" href="./book_demo.php?tutor_id=<?php echo $row['id']; ?>&tutor_email=<?php echo $row['email']; ?>">Book Demo</a>
                                </div>

                            </div>
                        </div>
                    <?php
                    }
                } else {
                    echo "No results found.";
                }
                ?>
            </div>

        </div>
    </div>
    <!-- Team End -->

    <?php
    include('./footer.php');
    ?>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary rounded-0 btn-lg-square back-to-top"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/counterup/counterup.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
