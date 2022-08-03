
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="form-feldolgoz.php" method="post">
        <label for="">Kifejezés:</label>
        <input type="text" name="expression">
        <div class="solution" value=""><?php "echo $feldolgozas ? '' " ?></div>
        <input type="submit" value="submit">
    </form>
</body>
</html>


