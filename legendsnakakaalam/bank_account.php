<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Bank Account</title>
</head>
<body>
    <h3>Task 9: Bank Account Simulation</h3>
    <?php
    $balance = 1000;
    $deposit = 200;
    $withdraw = 150;

    $balance += $deposit;  // Deposit money
    $balance -= $withdraw; // Withdraw money

    echo "Initial Balance = $balance <br> Deposit = $deposit <br> Withdraw = $withdraw <br> Final Balance: $balance";
    ?>
</body> 
</html>
