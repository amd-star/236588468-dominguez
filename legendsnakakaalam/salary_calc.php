<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Salary Calculator</title>
</head>
<body>
    <h3>Task 6: Salary Calculator</h3>
    <?php
    $basic_salary = 50000;
    $allowance = 10000;
    $deduction = 5000;

    $net_salary = $basic_salary + $allowance - $deduction;

    echo "Net Salary: $net_salary";
    ?>
</body> 
</html>
