<?php 
    require_once("./test.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="http://localhost:3002/api/address" method="post">
        <label for="country">Country:</label>
        <input type="text" name="country" id="country"><br>

        <label for="region">Region:</label>
        <input type="text" name="region" id="region"><br>

        <label for="postal_code">Postal Code:</label>
        <input type="text" name="postal_code" id="postal_code"><br>

        <label for="city">City:</label>
        <input type="text" name="city" id="city"><br>

        <label for="street">Street:</label>
        <input type="text" name="street" id="street"><br>

        <label for="id_company">Company :</label>
        <select name="id_company" id="id_company">
        <?php
            fillSelectWith("company", "name");
        ?>
        </select>

        <input type="submit" value="register">
    </form>
</body>
</html>