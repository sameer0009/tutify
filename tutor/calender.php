<head>
    
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.15/dist/tailwind.min.css" rel="stylesheet">
    <link href="../css/calender_styles.css" rel="stylesheet">
</head>

<?php
// Connect to the database
include('../dbcon.php');

// Get the class schedule from the database
$sql = "SELECT * FROM class_schedule";
$result = mysqli_query($con, $sql);

// Initialize an array to store the class schedule
$schedule = array();

// Loop through the results and add them to the schedule array
while ($row = mysqli_fetch_assoc($result)) {
    $date = date('Y-m-d', strtotime($row['class_date']));
    if (!isset($schedule[$date])) {
        $schedule[$date] = 1;
    } else {
        $schedule[$date]++;
    }
}

// Set the timezone
date_default_timezone_set('UTC');

// Set the month and year to display
if (isset($_GET['month'])) {
    $month = $_GET['month'];
} else {
    $month = date('n');
}
if (isset($_GET['year'])) {
    $year = $_GET['year'];
} else {
    $year = date('Y');
}

// Get the number of days in the selected month
$numDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

// Get the name of the selected month
$monthName = date('F', mktime(0, 0, 0, $month, 1, $year));

// Get the day of the week the first day of the month falls on
$firstDay = date('N', mktime(0, 0, 0, $month, 1, $year));

// Determine the number of blank cells to insert before the first day
if ($firstDay == 7) {
    $blankCells = 0;
} else {
    $blankCells = $firstDay;
}

// Start the HTML output
echo "<table class='border-collapse w-5'>";
echo "<caption class='text-black text-lg font-bold mb-4'>$monthName $year</caption>";
echo "<tr>";
echo "<th class='text-black font-bold'>Sun</th>";
echo "<th class='text-black font-bold'>Mon</th>";
echo "<th class='text-black font-bold'>Tue</th>";
echo "<th class='text-black font-bold'>Wed</th>";
echo "<th class='text-black font-bold'>Thu</th>";
echo "<th class='text-black font-bold'>Fri</th>";
echo "<th class='text-black font-bold'>Sat</th>";
echo "</tr>";

// Initialize the day counter
$dayCount = 1;

// Loop through each week in the month
while ($dayCount <= $numDays) {
    echo "<tr>";
    // Loop through each day in the week
    for ($i = 1; $i <= 7; $i++) {
        // Check if we need to insert a blank cell
        if ($blankCells > 0) {
            echo "<td class='border text-center'>&nbsp;</td>";
            $blankCells--;
        } else {
            // Check if the current day is in the class schedule
            $date = date('Y-m-d', mktime(0, 0, 0, $month, $dayCount, $year));
            $classCount = isset($schedule[$date]) ? $schedule[$date] : 0;
            // Output the day cell with the class count
            echo "<td class='border text-center'>";
            if ($classCount > 0) {
                echo "<button class='bg-yellow-500 border-none py-1 px-2'>";
            }
            echo "<span class='font-bold'>$dayCount</span>";
            if ($classCount > 0) {
                echo "</button>";
            }
            echo "</td>";
            // Increment the day counter
            $dayCount++;
        }
        // Check if we've reached the end of the month
        if ($dayCount > $numDays) {
            break;
        }
    }
    echo "</tr>";
    if ($dayCount <= $numDays) {
        echo '<tr>';
    }
}
echo '</tbody></table>';
mysqli_close($con);
?>
