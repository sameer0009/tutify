<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .card {
            max-width: 900px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            position: relative;
        }

        .success-message {
            font-size: 20px;
            color: #007bff;
            margin-bottom: 20px;
        }

        .confirmation-msg {
            font-size: 18px;
            margin-bottom: 30px;
        }

        .animation-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            animation: fade-in 1.5s 0.5s forwards;
        }

        @keyframes fade-in {
            to {
                opacity: 1;
            }
        }
    </style>
    <meta http-equiv="refresh" content="3; URL=team.php">
</head>
<body>
    <div class="animation-container">
        <div class="card">
            <div class="success-message">Thank You!</div>
            <div class="confirmation-msg">Kindly check your email for confirmation.</div>
            <div class="email-msg">We will email you the credentials for the demo class.</div>
        </div>
    </div>
</body>
</html>
