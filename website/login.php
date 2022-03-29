<?php
include_once("./env_variables.php");
try {
    $conn = new PDO(
        "mysql:host=$DB_HOST;dbname=my_recipes;charset=utf8",
        $DB_USER,
        $DB_PASSWORD
    );
    $query = "SELECT * FROM users";
    $select_users = $conn->prepare($query);
    $users = $select_users->fetchAll();
    var_dump($users);
} catch(err) {
    echo err;
}
?>