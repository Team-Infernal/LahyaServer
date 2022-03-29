<?php
echo "bob";


$selectUsers = $conn->prepare('SELECT * FROM users');
$selectUsers->execute();
$users = $selectUsers->fetchAll();
var_dump($users);
