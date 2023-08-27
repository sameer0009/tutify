<?php 
session_start();

include('../dbcon.php');

if (isset($_POST['submit'])) {
  $title = $_POST['assessment_title'];
  $course_id = $_SESSION['course_id'];
  
  $type = $_POST['assessment_type'];
  $description = $_POST['assessment_description'];
  $date = $_POST['due_date'];
  //files to be uploaded

  $fileCount = count($_FILES['attachments']['name']);
  $fileDestination = array();

  for ($i = 0; $i < $fileCount; $i++) {
    $fileName = $_FILES['attachments']['name'][$i];
    $fileTmpName = $_FILES['attachments']['tmp_name'][$i];
    $fileSize = $_FILES['attachments']['size'][$i];
    $fileError = $_FILES['attachments']['error'][$i];
    $fileType = $_FILES['attachments']['type'][$i];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExtensions = array('pdf', 'ppt', 'pptx', 'doc', 'docx'); // Define the allowed file extensions

    if (in_array($fileExt, $allowedExtensions)) {
      if ($fileError === 0) {
        if ($fileSize < 5242880000) { // Adjust the maximum file size limit if needed (currently set to 50MB)
          $newFileName = uniqid('', true) . '.' . $fileExt;
          $fileDestination[] = '../uploads/assessments/' . $newFileName;
          move_uploaded_file($fileTmpName, end($fileDestination));
        } else {
          echo '<script>alert("Error: The file size exceeds the maximum limit.");</script>';
        }
      } else {
        echo '<script>alert("Error: An error occurred during file upload.");</script>';
      }
    } else {
      echo '<script>alert("Error: Invalid file extension. Only PDF, PPT, PPTX, DOC, DOCX, and MP4 files are allowed.");</script>';
    }
  }

  // Insert assessment data into the database
  $query = "INSERT INTO `assesment`(`assesment_title`, `assesment_type`, `assesment_description`, `due_date`, `attachment_files`, `course_id`) VALUES ('$title','$type','$description','$date','" . implode(",", $fileDestination) . "','$course_id')";
  $result = mysqli_query($con, $query);

  if ($result) {
    echo '<script>alert("Assessment created successfully.");</script>';
  } else {
    echo '<script>alert("Error: Failed to create assessment.");</script>';
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Assessments</title>
  <!-- Tailwind CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
  <!-- Quill CSS -->
  <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet"> 
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <!-- Customized Bootstrap Stylesheet -->
  <link href="../css/style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>

<body >
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <a href="#" class="navbar-brand ml-lg-3">
                <h1 class="m-0 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Tutify</h1>
            </a>
    
   
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
      <li class="nav-item">
          <a class="nav-link" target="_blank" href="manage_assessments.php">Manage Assesment</a>
        </li>

      </ul>
       <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo ucwords($_SESSION["user_name"]); ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="userDropdown">
                    <a class="dropdown-item" href="../change_password.php" title="Password">Password</a>
                    <a class="dropdown-item" href="./addcourse.php">Back</a>
                    <a class="dropdown-item" href="../logout.php" title="Logout">Log out</a>
                </div>
            </li>
        </ul>
    </div>
     
  </nav>


  <div class="container col-md-11">
    <h1 class="text-center text-3xl font-bold mb-5">Assessments</h1>
    <div class="bg-white rounded shadow-lg p-6">
      <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-4">
          <label for="assessment_title" class="block text-gray-700 ">Assessment Title</label>
          <input type="text" class="form-input mt-1 block w-full border border-gray-300 rounded" id="assessment_title" name="assessment_title" required>
        </div>
        <div class="mb-4">
          <label for="assessment_type" class="block text-gray-700 ">Assessment Type</label>
          <select class="form-select mt-1 block w-full border border-gray-300 rounded" id="assessment_type" name="assessment_type" required>
            <option value="">Select Type</option>
            
            <option value="assignment">Assignment</option>
            <option value="exam">Exam</option>
          </select>
        </div>
        <div class="mb-4">
          <label for="assessment_description" class="block text-gray-700">Assessment Description</label>
          <div id="editor" class="h-32"></div>
          <input type="hidden" name="assessment_description" id="assessment_description">
        </div>
        <div class="mb-4">
          <label for="due_date" class="block text-gray-700">Due Date</label>
          <input type="date" class="form-input mt-1 block w-full" id="due_date" name="due_date" required>
        </div>
        <div class="mb-4">
          <label for="attachments" class="block text-gray-700">Attachments</label>
          <input type="file" class="form-input mt-1 block w-full" id="attachments" name="attachments[]" multiple>
           <p>Kindly upload 'pdf', 'ppt', 'pptx', 'doc', 'docx', 'mp4' upto 50MB</p>
        </div>
        <button type="submit" name="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create Assessment</button>
        <br>
        <br>
        <div class="flex justify-end mt-4">
        
        </div>
      </form>
    </div>
  </div>

  <!-- Quill JS -->
  <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
  <script>
    var quill = new Quill('#editor', {
      theme: 'snow',
      modules: {
        toolbar: [
          [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
          ['link', 'image']
        ]
      }
    });

    // Get the HTML content of the editor and set it to the hidden input field
    var form = document.querySelector('form');
    form.onsubmit = function() {
      var descriptionInput = document.querySelector('#assessment_description');
      descriptionInput.value = quill.root.innerHTML;
    };
  </script>
</body>

</html>
