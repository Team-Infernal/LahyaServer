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
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
	curl_exec($curl);
	curl_close($curl);
	
}
function delete2($url)
{
	$curl = curl_init();
	curl_setopt($curl, CURLOPT_URL, $url);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_exec($curl);
	curl_close($curl);
}

//Student and Tutor
if (isset($_POST['role']) . isset($_POST['type']) . isset($_POST['first_name']) . isset($_POST['last_name']) . isset($_POST['email']) . isset($_POST['school']) . isset($_POST['class'])) {

	$role = $_POST['role'];
	$type = $_POST['type'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$email = $_POST['email'];
	$school = $_POST['school'];
	$class = $_POST['class'];
	$hash = $_POST['password'];

	if ($type === "add") {

		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users";
		$data = "first_name=$first_name&last_name=$last_name&login=$email&hash=$hash&school=$school&class=$class&id_permission_has=$permission&id_permission_has3=1";
		post($url, $data);

	} else if ($type === "edit") {

		$id = $_POST["id"];
		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users/$id";
		$data = "first_name=$first_name&last_name=$last_name&login=$email&hash=$hash&school=$school&class=$class&id_permission_has=$permission&id_permission_has3=1";
		put($url, $data);

	} else if ($type === "delete") {

		$id = $_POST["id"];
		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users/$id";
		delete2($url);

	}
	header("location: http://localhost:3000/account");
} 
else {
	header("location: http://localhost:3000/account");
}
