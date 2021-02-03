<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Documento 1</title>
</head>
<body>
    <h1>Documento 1</h1>
    <?php 
        $variable = 2;
        $variable = 10;
        echo "<h2>".($variable + 5)."<h2/>";
        $variable++;
        echo "<h2>".$variable."<h2/>";
        echo "<h2>".$variable++."<h2/>";
        echo "<h2>".$variable."<h2/>";
        echo "<h2>".++$variable."<h2/>";
    ?>
    <img src="speedwango.jpg" alt="jojo">
</body>
</html>