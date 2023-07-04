<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  
  <style type="text/css">
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
      background-color: #f7f7f7;
    }

    .card {
      width: 400px;
      height: 200px;
      background-color: transparent;
      border-radius: 20px;
      padding: 20px;
      box-sizing: border-box;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      border: 2px solid #000;
    }

    .tick {
      width: 80px;
      height: 80px;
      background-image: url('img/tick.jpeg'); /* Replace 'tick.png' with your tick image */
      background-size: cover;
      animation: rotate 1s infinite;
    }

    @keyframes rotate {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }

    .message {
      margin-top: 20px;
      font-size: 18px;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="card">
    <div class="tick"></div>
    <div class="message">
      Your Payment Has Been Confirmed
    </div>
  </div>
   <script>
    // Delayed redirect
    setTimeout(function() {
      window.location.href = "student/enrolled_courses.php"; // Replace with your desired URL
    }, 5000); // 5000 milliseconds = 5 seconds
  </script>
</body>
</html>