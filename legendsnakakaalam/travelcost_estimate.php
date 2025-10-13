<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travel Cost Estimator</title>
</head>
<body>
    <h3>Task 12: Travel Cost Estimator</h3>
    <?php
    $distance = 200;         // in km
    $fuel_consumption = 15;  // km per liter
    $fuel_price = 50;        // per liter

    $fuel_needed = $distance / $fuel_consumption;
    $total_cost = $fuel_needed * $fuel_price;

    echo "Total Travel Cost: $total_cost";
    ?>
</body>
</html>
