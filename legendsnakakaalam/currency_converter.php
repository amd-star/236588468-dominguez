<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currency Converter</title>
</head>
<body>
    <h3>Task 11: Currency Converter</h3>
    <?php
    $php_amount = 1000;

    $usd_rate = 0.056;  // PHP to USD
    $eur_rate = 0.051;  // PHP to EUR
    $jpy_rate = 7.8;    // PHP to JPY

    $usd = $php_amount * $usd_rate;
    $eur = $php_amount * $eur_rate;
    $jpy = $php_amount * $jpy_rate;

    echo "$php_amount PHP is equal to $usd USD, $eur EUR, $jpy JPY";
    ?>
</body>
</html>
