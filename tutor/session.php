<?php
session_start();
$instruct_id = $_SESSION['id'];
$course_id = $_SESSION['course_id'];

if (!isset($_SESSION['user_name'])) {
    header('Location: ../signin.php');
    exit();
}

include('./t_head.php');
include('../dbcon.php');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$class_time = $class_date = $class_duration = "";
$class_time_err = $class_date_err = $class_duration_err = "";
$success_message = $error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validate class time
    if (empty(trim($_POST["class_time"]))) {
        $class_time_err = "Please enter the class time.";
    } else {
        $class_time = trim($_POST["class_time"]);
    }

    // Validate class date
    if (empty(trim($_POST["class_date"]))) {
        $class_date_err = "Please enter the class date.";
    } else {
        $class_date = trim($_POST["class_date"]);
    }

    // Validate class duration
    if (empty(trim($_POST["class_duration"]))) {
        $class_duration_err = "Please enter the class duration.";
    } else {
        $class_duration = trim($_POST["class_duration"]);
    }

    // Check input errors before inserting in database
    if (empty($class_time_err) && empty($class_date_err) && empty($class_duration_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO class_schedule (Course_id, class_time, class_date, class_duration) VALUES (?, ?, ?, ?)";

        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isss", $course_id, $class_time, $class_date, $class_duration);

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to timetable page
                header("location: timetable.php");
                exit();
            } else {
                $error_message = "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        } else {
            $error_message = "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close connection
    mysqli_close($con);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Tutor Panel - Schedule Class Time</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
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
                    <a class="dropdown-item" href="addcourse.php" title ="Back">Back</a>
                    <a class="dropdown-item" href="../change_password.php" title="Password">Password</a>

                    <a class="dropdown-item" href="../logout.php" title="Logout">Log out</a>

                </div>
            </li>
        </ul>
    </div>
</nav>


    <div class="container col-md-11">
        <div class="page-header">
            <h2>Create Class Session</h2>
            <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="createDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Create class
    </button>
    <div class="dropdown-menu" aria-labelledby="createDropdown">
        <button class="dropdown-item" onclick="location.href='../video/groupCall.html'">Create Group Session</button>
        <button class="dropdown-item" onclick="location.href='../video/1On1Call.html'">Create 1-1 Session</button>
    </div>
</div>

        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h2 class="panel-title">Schedule Class Time</h2>
            </div>
            <div class="panel-body">
                <p>Please fill in the details below to schedule a class time.</p>
                <?php
                if (!empty($success_message)) {
                    echo '<div class="alert alert-success">' . $success_message . '</div>';
                }
                if (!empty($error_message)) {
                    echo '<div class="alert alert-danger">' . $error_message . '</div>';
                }
                ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="form-group <?php echo (!empty($class_time_err)) ? 'has-error' : ''; ?>">
                        <label>Class Time</label>
                        <input type="time" name="class_time" class="form-control" value="<?php echo $class_time; ?>" min="09:00" max="18:00">
                        <span class="help-block"><?php echo $class_time_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($class_date_err)) ? 'has-error' : ''; ?>">
                        <label>Class Date</label>
                        <input type="date" name="class_date" class="form-control" value="<?php echo $class_date; ?>">
                        <span class="help-block"><?php echo $class_date_err; ?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($class_duration_err)) ? 'has-error' : ''; ?>">
                        <label>Class Duration (in minutes)</label>
                        <input type="number" name="class_duration" class="form-control" value="<?php echo $class_duration; ?>">
                        <span class="help-block"><?php echo $class_duration_err; ?></span>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="timetable.php" class="btn btn-primary">Time Table</a>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
