<?php
include_once("environment_variables.php");
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

function post($url, $data)
{
	$curl = curl_init($url);
	curl_setopt_array($curl, array(
		CURLOPT_HTTPHEADER => array("application/x-www-form-urlencoded"),
		CURLOPT_URL => $url,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $data
	));
	curl_exec($curl);
	curl_close($curl);
}

function put($url, $data)
{
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_HTTPHEADER => array("application/x-www-form-urlencoded"),
		CURLOPT_URL => $url,
		CURLOPT_PUT => true,
		CURLOPT_POSTFIELDS => $data,
	));
	curl_exec($curl);
	curl_close($curl);
}

if (isset($_POST['role']) . isset($_POST['type']) . isset($_POST['first_name']) . isset($_POST['last_name']) . isset($_POST['email']) . isset($_POST['school']) . isset($_POST['class'])) {

	$role = $_POST['role'];
	$type = $_POST['type'];

	$id = $_POST['id'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$school = $_POST['school'];
	$class = $_POST['class'];

	if ($type === "add") {
		$hash = $_POST['password'];
		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users";
		$data = "first_name=$first_name&last_name=$last_name&login=$email&hash=$hash&school=$school&class=$class&id_permission_has=$permission&id_permission_has3=1";
		post($url, $data);
	} else if ($type === "edit") {
		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users/1";
		$data = "first_name=$first_name&last_name=$last_name&login=$email&hash=$hash&school=$school&class=$class&id_permission_has=$permission&id_permission_has3=1";
		put($url, $data);
	} else if ($type === "delete") {
		// $first_name = "kiki";
		// $last_name = "de tout";
		// $stmt = $connection->prepare("SET FOREIGN_KEY_CHECKS = 0; DELETE FROM `users` WHERE `first_name` = $first_name AND `last_name` = $last_name; SET FOREIGN_KEY_CHECKS = 1;");
		// $stmt->execute();
		// $url = "localhost:3002/api/users?id=" + $id;

		// $curl = $curl_init($url);
		// curl_setopt($curl, CURLOPT_URL, $url);
		// curl_setopt($curl, CURLOPT_DELETE, true);
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		// $resp = curl_exec($curl);
		// curl_close($curl);
		// var_dump($resp);
		echo "Je supprime";
	}
} else {
	echo "Il manque une valeur";
}
