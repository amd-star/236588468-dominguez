<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Simple Math</title>
</head>
<body>
    <h3>Task 2: Simple Math</h3>

    <?php
    // Initialize variables with default values
    $a = 10;
    $b = 5;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get inputs and sanitize
        $a = isset($_POST['a']) ? (float)$_POST['a'] : $a;
        $b = isset($_POST['b']) ? (float)$_POST['b'] : $b;

        echo "You entered:<br>";
        echo "Number 1: " . htmlspecialchars($a) . "<br>";
        echo "Number 2: " . htmlspecialchars($b) . "<br><br>";
    } else {
        echo "No form data submitted. Using default values:<br>";
        echo "Number 1: $a<br>";
        echo "Number 2: $b<br><br>";
    }

    // Perform calculations
    $sum = $a + $b;
    $difference = $a - $b;
    $product = $a * $b;

    if ($b != 0) {
        $quotient = $a / $b;
        $quotient_display = $quotient;
    } else {
        $quotient_display = "Division by zero error!";
    }

    echo "Sum: $sum<br>";
    echo "Difference: $difference<br>";
    echo "Product: $product<br>";
    echo "Quotient: $quotient_display<br>";
    ?>

    <form method="post" action="">
        Put your number 1 in: <input type="text" name="a" value="<?php echo htmlspecialchars($a); ?>"><br><br>
        Put your number 2 in: <input type="text" name="b" value="<?php echo htmlspecialchars($b); ?>"><br><br>
        <input type="submit" value="Submit">
    </form>
</body> 
</html>
