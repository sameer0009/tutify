<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="./css/signup.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <style> @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap'); </style>
    <title>Sign Up</title>

    <script>
      //password visibility function 
      function togglePasswordVisibility() {
    const passwordInput = document.getElementById("password");
    const showPasswordCheckbox = document.getElementById("showPassword");

    if (showPasswordCheckbox.checked) {
      passwordInput.type = "text";
    } else {
      passwordInput.type = "password";
    }
  }

  //password validation function 
  function validatePassword() {
    const passwordInput = document.getElementById("password");
    const password = passwordInput.value;

    const lengthRegex = /.{8,}/;
    const lowercaseRegex = /[a-z]/;
    const uppercaseRegex = /[A-Z]/;
    const digitRegex = /\d/;
    const specialCharRegex = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;

    if (!lengthRegex.test(password)) {
      alert("Password must be at least 8 characters long.");
      return false;
    }

    if (!lowercaseRegex.test(password)) {
      alert("Password must include at least one lowercase letter.");
      return false;
    }

    if (!uppercaseRegex.test(password)) {
      alert("Password must include at least one uppercase letter.");
      return false;
    }

    if (!digitRegex.test(password)) {
      alert("Password must include at least one digit.");
      return false;
    }

    if (!specialCharRegex.test(password)) {
      alert("Password must include at least one special character.");
      return false;
    }

    return true;
  }
</script>

</head>
<body>
<div>
     <div class="wave"></div>
     <div class="wave"></div>
     <div class="wave"></div>

<form method="POST" action="index.php" onsubmit="return validatePassword()">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="fname"><b>First Name</b></label>
    <input type="text" id="fname" placeholder="Enter First Name" name="fname" required pattern="[A-Za-z ]+">
    <label for="lname"><b>Last Name</b></label>
    <input type="text" id="lname" placeholder="Enter Last Name" name="lname" required pattern="[A-Za-z ]+">
    <label for="phone"><b>Phone Number</b></label>
    <input type="text" id="phone" placeholder="Enter Phone Number" name="phone" required >
    <label for="email"><b>Email</b></label>
    <input type="email" id="email" placeholder="Enter Email" name="email" required>

    <label for="password"><b>Password</b></label>
<input type="password" id="password" placeholder="Enter Password" name="password" required>
<label for="showPassword"><input type="checkbox" id="showPassword" onchange="togglePasswordVisibility()"> Show Password</label>

    <label><b>Select Type</b></label>
    <br>
    <input type="radio" id="student" name="type" value="Student">
    <label for="student">Student</label><br>
    <input type="radio" id="teacher" name="type" value="Teacher">
    <label for="teacher">Tutor</label><br>

    <p>By creating an account you agree to our <a href="./tems_policy.php" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button type="submit" name="submit" class="signupbtn">Sign Up</button>
    </div>
    <button onclick="window.location.href = 'join.php';" class="back-button">Back</button>

  </div>
</form>
</div>
</body>
</html>
