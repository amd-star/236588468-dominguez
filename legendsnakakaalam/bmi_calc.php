<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>BMI Calculator</title>
</head>
<body>
    <h3>Task 7: BMI Calculator</h3>
    <?php
    $weight = 70; // in kg
    $height = 1.75; // in meters

    $bmi = $weight / ($height * $height);

    echo "BMI: $bmi";
    ?>
</body> 
</html>
