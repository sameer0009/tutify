<?php
// Start or resume the session
session_start();

// Include the database connection file
require 'dbcon.php';

// Check if the user is logged in
if (isset($_SESSION['user_name'])) {
    $loggedInUser = $_SESSION['user_name'];
    
    // Check if the form was submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form inputs and sanitize them
        $oldPassword = mysqli_real_escape_string($con, $_POST['old_password']);
        $newPassword = mysqli_real_escape_string($con, $_POST['new_password']);
        $confirmNewPassword = mysqli_real_escape_string($con, $_POST['confirm_new_password']);
        
        // Validate inputs (you can add more validation as needed)
        if (empty($oldPassword) || empty($newPassword) || empty($confirmNewPassword)) {
            $error = "All fields are required.";
        } elseif ($newPassword !== $confirmNewPassword) {
            $error = "New passwords do not match.";
        } else {
            // Validate old password against the database
            $query = "SELECT * FROM users WHERE fname = '$loggedInUser'";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
                if (password_verify($oldPassword, $user['password'])) {
                    // Hash the new password before updating
                    $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                    
                    // Update the password in the database
                    $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE fname= '$loggedInUser'";
                    $updateResult = mysqli_query($con, $updateQuery);
                    
                     if ($updateResult) {
            echo '<script>alert("Password updated successfully."); window.location.href = "./tutor/tutor_dashboard.php";</script>';
        } else {
            echo '<script>alert("Error updating password: ' . mysqli_error($con) . '");</script>';
        }
    } else {
        echo '<script>alert("Incorrect old password.");</script>';
    }
} else {
    echo '<script>alert("User not found.");</script>';
}
        }
    }
} else {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
  
   <style >
    /* Style for the form container */
        form {
            width: 700px;
            margin: 0 auto;
            padding: 40px;
            margin-top: 200px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        /* Style for labels */
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* Style for input fields */
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
            box-sizing: border-box;
        }

        /* Style for the submit button */
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        /* Style for success and error messages */
        p {
            font-size: 14px;
            margin-top: 10px;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
        }
     .header {
            background-color: #e3f1fa; /* Light blue */
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
        }

        /* Style for the header title */
        .header-title {
            font-size: 24px;
            color: #fff; /* White text */
            margin: 0;
            flex: 1; /* Take up available space, centering the title */
            text-align: center;
        }

        /* Style for the back button */
        .back-button {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            padding: 10px 20px;
            cursor: pointer;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
   </style>
</head>
<body>
   
    <!-- Header -->
    <div class="header">
        <h1>Change Password</h1>
        <a href="./tutor/tutor_dashboard.php" class="back-button">Back</a>
    </div>
    
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    
    <?php if (isset($success)): ?>
        <p style="color: green;"><?php echo $success; ?></p>
    <?php endif; ?>
    
    <form method="POST">
        <label for="old_password">Old Password:</label>
        <input type="password" name="old_password" required><br>
        
        <label for="new_password">New Password:</label>
        <input type="password" name="new_password" required><br>
        
        <label for="confirm_new_password">Confirm New Password:</label>
        <input type="password" name="confirm_new_password" required><br>
        
        <button type="submit">Change Password</button>
    </form>
</body>
</html>
