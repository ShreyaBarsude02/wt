<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>String Transformations</title>
</head>
<body>
    <h2>String Transformation Application</h2>
    <form method="post">
        <label for="inputString">Enter a string:</label>
        <input type="text" name="inputString" id="inputString" required>
        <button type="submit">Transform</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $inputString = $_POST["inputString"];

        echo "<h3>Original String:</h3>";
        echo "<p>$inputString</p>";

        $uppercaseString = strtoupper($inputString);
        echo "<h3>All Uppercase:</h3>";
        echo "<p>$uppercaseString</p>";

        $lowercaseString = strtolower($inputString);
        echo "<h3>All Lowercase:</h3>";
        echo "<p>$lowercaseString</p>";

        $firstCharUppercase = ucfirst($inputString);
        echo "<h3>First Character Uppercase:</h3>";
        echo "<p>$firstCharUppercase</p>";

        $wordsFirstCharUppercase = ucwords($inputString);
        echo "<h3>First Character of Each Word Uppercase:</h3>";
        echo "<p>$wordsFirstCharUppercase</p>";
    }
    ?>
</body>
</html>
