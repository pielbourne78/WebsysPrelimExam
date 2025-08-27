<!DOCTYPE html>
<html>
<head>
    <title>Grade Calculator</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Grade Calculator</h1>
    <?php
    //mga variables
    $error = '';
    $final_grade = null;
    $letter = '';
    // Para malaman kung na submit na yung form
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $quiz = $_POST['quiz'] ?? '';
        $assignment = $_POST['assignment'] ?? '';
        $exam = $_POST['exam'] ?? '';

        // Para malaman na valid yung input ng user
        if ($quiz === '' || $assignment === '' || $exam === '') {
            $error = "All fields must be filled.";
        // Check kung numeric ba yung input ng user
        } elseif (
            !is_numeric($quiz) || !is_numeric($assignment) || !is_numeric($exam)
        ) {
            $error = "All fields must be numeric values.";
        // Range ng grade na ininput ng user
        } elseif (
            $quiz < 0 || $quiz > 100 ||
            $assignment < 0 || $assignment > 100 ||
            $exam < 0 || $exam > 100
        ) {
            $error = "All scores must be between 0 and 100.";
         /* Formula para sa final grade kasama grade weight pati components na (Quiz:30%,
            Assignment:30%, Exam:40%) */  
        } else {
            $final_grade = ($quiz * 0.3) + ($assignment * 0.3) + ($exam * 0.4);

            // Grading Remarks o nirerepresent na grade ng letter
            if ($final_grade >= 90) {
                $letter = 'A';
            } elseif ($final_grade >= 80) {
                $letter = 'B';
            } elseif ($final_grade >= 70) {
                $letter = 'C';
            } elseif ($final_grade >= 60) {
                $letter = 'D';
            } else {
                $letter = 'F';
            }
        }
    }
    // if mali yung input na nilagay ng user
    if ($error) {
        echo "<div class='error' style='color:red;font-weight:bold;'>$error</div>";
     // if tama yung input na nilagay ng user
    } elseif ($final_grade !== null) {
        echo "<div class='result'>";
        echo "<p>Final Grade: <strong>" . round($final_grade, 2) . "</strong></p>";
        echo "<p>Letter Grade: <strong>$letter</strong></p>";
        echo "</div>";
    }
    ?>
        <!--Form para sa input ng user-->
    <div class="calculator">
        <form method="post">
            <input type="text" name="quiz" placeholder="Quiz score" required
                value="<?php echo isset($_POST['quiz']) ? htmlspecialchars($_POST['quiz']) : ''; ?>">
            <input type="text" name="assignment" placeholder="Assignment score" required
                value="<?php echo isset($_POST['assignment']) ? htmlspecialchars($_POST['assignment']) : ''; ?>">
            <input type="text" name="exam" placeholder="Exam score" required
                value="<?php echo isset($_POST['exam']) ? htmlspecialchars($_POST['exam']) : ''; ?>">
            <button type="submit">Submit</button>
        </form>
         
    </div>
</body>
</html>