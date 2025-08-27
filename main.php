<?php
// Tagalog: I-check kung na-submit ang form gamit ang POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tagalog: Kunin ang mga input mula sa form
    $quiz = $_POST['quiz'];
    $assignment = $_POST['assignment'];
    $exam = $_POST['exam'];

    // Tagalog: I-define ang weights ng bawat component
    $quiz_weight = 0.3;       // 30%
    $assignment_weight = 0.3; // 30%
    $exam_score = 0.4;       // 40%
    $weighted_average = ($quiz * $quiz_weight) + ($assignment * $assignment_weight) + ($exam * $exam_weight);

    // Tagalog: I-validate kung lahat ng input ay numeric at nasa pagitan ng 0 at 100
    if (
        is_numeric($quiz) && $quiz >= 0 && $quiz <= 100 &&
        is_numeric($assignment) && $assignment >= 0 && $assignment <= 100 &&
        is_numeric($exam) && $exam >= 0 && $exam <= 100
    ) {
       
        // Tagalog: Tukuyin ang letter grade base sa weighted average
        if ($weighted_average >= 90) {
            $grade = "A";
        } elseif ($weighted_average >= 80) {
            $grade = "B";
        } elseif ($weighted_average >= 70) {
            $grade = "C";
        } elseif ($weighted_average >= 60) {
            $grade = "D";
        } else {
            $grade = "F";
        }

        // Tagalog: Ipakita ang resulta
        echo "<div class='result'>";
        echo "Weighted Average: <strong>" . round($weighted_average, 2) . "</strong><br>";
        echo "Letter Grade: <strong>$grade</strong>";
        echo "</div>";
    } else {
        // Tagalog: Magpakita ng error message kung may invalid input
        echo "<div class='error'>";
        echo "Error: Lahat ng scores ay dapat numeric at nasa pagitan ng 0 hanggang 100.";
        echo "</div>";
    }
}
?>