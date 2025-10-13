<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>String Manipulation</title>
</head>
<body>
    <h3>Task 8: String Manipulation</h3>
    <?php
    $sentence = "hello uc , hindi ko na kaya.!";

    $length = strlen($sentence); 
    $word_count = str_word_count($sentence);
    $uppercase = strtoupper($sentence);
    $lowercase = strtolower($sentence);

    echo "Length: $length <br>Word Count: $word_count <br>Uppercase: $uppercase <br>Lowercase: $lowercase";

    ?>
</body> 
</html>
