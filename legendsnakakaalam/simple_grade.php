<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Grading System</title>
</head>
<body>
    <h3>Task 10: Simple Grading System</h3>
    <?php
    $math_score = 85;
    $english_score = 90;
    $science_score = 78;

    $average = ($math_score + $english_score + $science_score) / 3;

    if ($average >= 90) {
        $grade = 'A';
    } elseif ($average >= 80) {
        $grade = 'B';
    } elseif ($average >= 70) {
        $grade = 'C';
    } else {
        $grade = 'D';
    }

    echo "Average: $average, Grade: $grade";
    ?>
</body> 
</html>
