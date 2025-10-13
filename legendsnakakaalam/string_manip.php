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
    $sentence = "Hello World, welcome to PHP programming!";

    $length = strlen($sentence);
    $word_count = str_word_count($sentence);
    $uppercase = strtoupper($sentence);
    $lowercase = strtolower($sentence);

    echo "Length: $length, Word Count: $word_count, Uppercase: $uppercase, Lowercase: $lowercase";
    ?>
</body> 
</html>
