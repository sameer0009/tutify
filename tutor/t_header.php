<head>
    <!-- Other head content -->

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Include your own stylesheets or additional CSS here -->

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a href="#" class="navbar-brand ml-lg-3">
        <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
    </a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="./tutor_dashboard.php">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="tutor_profile.php">Profile Management</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./reviews.php">Reviews</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="./salary.php">Payments</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="addcourse.php">Manage Course</a>
            </li>
            
        </ul>
        
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ucwords($_SESSION["user_name"]); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../change_password.php" title="Password">Password</a>
                    <a class="dropdown-item" href="../logout.php" title="Logout">Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>
