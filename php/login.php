<?php
include_once("environment_variables.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

	$login = $_POST["email"];
	$pwd = $_POST["password"];

	try {
		$connection = new PDO(
			"mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8",
			"$DB_USER",
			"$DB_PASSWORD",
			[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
		);
	} catch (PDOException $e) {
		echo "Error: " . $e->getMessage();
	}

	$stmt = $connection->prepare("SELECT hash FROM users WHERE login = :login");
	$stmt->execute([
		"login" => $login,
	]);
	// var_dump($stmt->fetchAll());
	var_dump($stmt->fetch()["hash"]);
	var_dump(password_verify("qwerty", password_hash("qwerty", PASSWORD_DEFAULT)));
}

/*
$url = "http://localhost:3002/api/users";

$headers = array(
	"Content-Type: application/x-www-form-urlencoded",
);

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);



$data = "first_name=$first_name&last_name=$last_name&login=$login&hash=$pwd&school=$school&class=$class&id_permission_has=1&id_permission_has3=1";

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$resp = curl_exec($curl);
curl_close($curl);
var_dump($resp);
