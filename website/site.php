<?php 
    require_once("./fill.php");
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
    <form action="http://localhost:3002/api/users" method="post">
            <!-- login=bob&password=boby -->
        <label for="fname">First Name :</label>
        <input type="text" name="first_name" id="fname"><br>
        <label for="lname">Last Name :</label>
        <input type="text" name="last_name" id="lname"><br>
        <label for="login">Login</label>
        <input type="text" name="login" id="login"><br>
        <label for="password">Password :</label>
        <input type="text" name="hash" id="password"><br>
        <label for="school">School :</label>
        <input type="text" name="school" id="school"><br>
        <label for="class">Class :</label>
        <input type="text" name="class" id="class"><br>
        <label for="id_permission">Role :</label>
        <select name="role" id="bob">
            <?php
                fillSelectWith("role");
            ?>
        </select>
        <input type="hidden" name="id_permission_has3" value="2">
        <input type="submit" value="register">
    </form>
</body>
</html>