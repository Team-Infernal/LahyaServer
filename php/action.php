<?php include_once("environment_variables.php") ?>

<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>

</body>

<?php
$mysqlConnection = new PDO(
	"mysql:host=$DB_HOST;dbname=$DB_DATABASE;charset=utf8",
	"$DB_USER",
	"$DB_PASSWORD"
);
echo $_POST["student"];
echo $_POST["tutor"];
?>

</html>