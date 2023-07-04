<?php


// Connect to the database and add a new subject if the form has been submitted
include('./dbcon.php');



// Fetch all subjects from the database
$sql = "SELECT * FROM tblsubjects";
$result = mysqli_query($con, $sql);
$subjects = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
  
<link href="./css/tsa_style_t.css"rel="stylesheet">

</head>
<body>
<h1>Select a Subject to take Assessment</h1>
  <div class="container ">
    

    <!-- Display all subjects as cards -->
    <div class="row ">
      <?php foreach ($subjects as $subject): ?>
        <div class="col-md-4 mt-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title "><?php echo $subject['subject']; ?></h5>
              <a href="Tsa_as.php?subject_id=<?php echo $subject['id']; ?>" class="btn btn-primary">take Quiz</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</body>
</html>
