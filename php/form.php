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


if (isset($_POST)) {

	$action = $_POST['action'];
	$type = $_POST["type"];
	$is = $_POST["is"];
	$role = $_POST['role'];
	if ($type === "add" && ($role == "student" || $role == "tutor")) {

		$role = $_POST['role'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$school = $_POST['school'];
		$class = $_POST['class'];
		$hash = $_POST['password'];
		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users";
		$data = "first_name=$first_name&last_name=$last_name&login=$email&hash=$hash&school=$school&class=$class&id_permission_has=$permission&id_permission_has3=1";
		post($url, $data);
	} else if ($type === "edit" && ($role == "student" || $role == "tutor")) {


		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$email = $_POST['email'];
		$school = $_POST['school'];
		$class = $_POST['class'];
		$hash = $_POST['password'];
		$id = $_POST["id"];
		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users/$id";
		$data = "first_name=$first_name&last_name=$last_name&login=$email&hash=$hash&school=$school&class=$class&id_permission_has=$permission&id_permission_has3=1";
		put($url, $data);
	} else if ($type === "delete" && ($role == "student" || $role == "tutor")) {

		$id = $_POST["id"];
		$permission = $role === "student" ? 1 : ($role === "tutor" ? 2 : null);
		$url = "http://localhost:3002/api/users/$id";
		delete2($url);


		//offer
	} else if ($type === "add" && $is === "offer") {

		$company = $_POST['company']; //company id
		$title = $_POST['title']; //title of the company
		$description = $_POST['description']; //description of the company
		$minor = $_POST['minor']; //minor 
		$salary = $_POST['salary']; //salary
		$places_available = $_POST['places_available']; //places available
		$published_at = date('y-m-j', time()); //date of publication
		$date = $_POST['lasts'];
		$id_address = $_POST['id_address']; //address id
		$url = "http://localhost:3002/api/internship";
		$data = "title=$title&description=$description&minor=$minor&lasts=$date&salary=$salary&published_at=$published_at&places_available=$places_available&id_company=$company&id_address=$id_address";
		post($url, $data);
	} else if ($type === "edit" && $is === "offer") {
		$id = $_POST["id"];
		$company = $_POST['company']; //company id
		$title = $_POST['title']; //title of the company
		$description = $_POST['description']; //description of the company
		$minor = $_POST['minor']; //minor 
		$salary = $_POST['salary']; //salary
		$places_available = $_POST['places_available']; //places available
		$published_at = date('y-m-j', time()); //date of publication
		$date = $_POST['lasts'];
		$id_address = $_POST['id_address']; //address id
		$url = "http://localhost:3002/api/internship/$id";
		$data = "title=$title&description=$description&minor=$minor&lasts=$date&salary=$salary&published_at=$published_at&places_available=$places_available&id_company=$company&id_address=$id_address";
		put($url, $data);
	} else if ($type === "delete" && $is === "offer") {

		$id = $_POST["id"];
		$url = "http://localhost:3002/api/internship/$id";
		delete2($url);
	}
	// business


	else if ($type === "add" && $is === "business") {

		$name = $_POST['name'];
		$student_accepted = $_POST['students_accepted'];
		$visible = ['visible'];
		if ($visible === "visible") {
			$visible = "1";
		} else {
			$visible = "0";
		}

		$data = "name=$name&student_accepted=$student_accepted&visible=$visible";
		$url = "http://localhost:3002/api/company";
		post($url, $data);
	} else if ($type === "edit" && $is === "business") {

		$id = $_POST["id"];
		var_dump($id);
		$name = $_POST['name'];
		$student_accepted = $_POST['students_accepted'];
		$visible = ['visible'];
		if ($visible === "visible") {
			$visible = "1";
		} else {
			$visible = "0";
		}
		$url = "http://localhost:3002/api/company/$id";
		$data = "name=$name&student_accepted=$student_accepted&visible=$visible";

		put($url, $data);
	} else if ($type === "delete" && $is === "business") {

		$id = $_POST["id"];
		$url = "http://localhost:3002/api/company/$id";
		delete2($url);
	}
	//header("location: http://localhost:3000/account");
	if ($action === "add") {
		echo "je suis la";
		$current_step = "1";
		$cv = $_POST['cv'];
		$motivation = $_POST['motivation'];
		$validation_link = NULL;
		$signed_validation_link = NULL;
		$convention_link = NULL;
		$signed_convention_link = NULL;
		$id_company = 1;
		echo $cv;
		echo $motivation;
		$id_user = $_POST['id'];
		$url = "http://localhost:3002/api/application";
		$data = "current_step=$current_step&cv_link=$cv&motivation_link=$motivation&validation_link=$validation_link&signed_validation_link=$signed_validation_link&convention_link=$convention_link&signed_convention_link=$signed_convention_link&id_company=$id_company&id_user=$id_user";
		post($url, $data);
	}
}
