<?php
session_start();

// Check if the 'user_name' session variable is set
if (!isset($_SESSION['user_name'])) {
  header('Location: ../signin.php'); // Redirect to the login page if the user is not logged in
  exit();
}

include('../dbcon.php');

$course_id = isset($_SESSION['course_id']) ? $_SESSION['course_id'] : '';

// Fetch all questions for the selected course
$sql = "SELECT * FROM quiz_questions WHERE course_id = '$course_id'";
$result = mysqli_query($con, $sql);
$questions = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Shuffle the questions to randomize their order
shuffle($questions);

// Check if the quiz has started
$quizStarted = isset($_POST['start_quiz']);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        main {
            flex: 1 0 auto;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
    </style>
</head>
<body>
    <header>
        <nav>
            <div class="nav-wrapper blue">
                <a href="#" class="brand-logo center">Quiz</a>
                <a class="navbar-brand" href="#"><?php echo ucwords($_SESSION["user_name"]);?></a>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <?php if (!$quizStarted): ?>
                <div class="row">
                    
                </div>
                <!-- Display the "Start Quiz" button if the quiz has not started -->
                <div class="row">
                    <div class="col s12 center">
                        <div class="center-container" style="margin-top: 20px;">
                            <form method="post">
                                <button type="submit" class="btn blue" name="start_quiz" value="1">Start Quiz</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="row">
                    <div class="col s12">
                        <h4 class="center">Quiz</h4>
                        <div class="timer center">
                            <span id="timer"></span>
                        </div>
                    </div>
                </div>
                <form method="post" action="quiz_result.php">
                    <?php foreach ($questions as $index => $question): ?>
                        <div class="row">
                            <div class="col s12">
                                <h6><?php echo ($index + 1) . '. ' . $question['question']; ?></h6>
                                <?php $options = array($question['option1'], $question['option2'], $question['option3'], $question['option4']); shuffle($options); ?>
                                <?php foreach ($options as $option) : ?>
                                    <p>
                                        <label>
                                            <input class="with-gap" type="radio" name="question_<?php echo $question['id']; ?>" id="option_<?php echo $option; ?>" value="<?php echo $option; ?>" required>
                                            <span><?php echo $option; ?></span>
                                        </label>
                                    </p>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <div class="row">
                        <div class="col s12 center">
                            <button type="submit" class="btn blue">Submit</button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        // Timer Countdown
        var timerElement = document.getElementById('timer');
        var timerSeconds = 120; // Change this to set the quiz duration in seconds

        function startTimer() {
            var timer = setInterval(function() {
                timerSeconds--;
                timerElement.textContent = formatTime(timerSeconds);

                if (timerSeconds <= 0) {
                    clearInterval(timer);
                    document.forms[0].submit(); // Submit the form when time runs out
                }
            }, 1000);
        }

        function formatTime(seconds) {
            var minutes = Math.floor(seconds / 60);
            var remainingSeconds = seconds % 60;

            return minutes.toString().padStart(2, '0') + ':' + remainingSeconds.toString().padStart(2, '0');
        }

        <?php if ($quizStarted): ?>
            startTimer();
        <?php endif; ?>
    </script>
</body>
</html>
