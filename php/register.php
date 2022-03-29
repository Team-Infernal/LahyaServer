<?php
$pwd = $_POST["hash"];
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$login = $_POST["login"];
$hash = $_POST["hash"];
$school = $_POST["school"];
$class = $_POST["class"];

$pwd = password_hash($_POST["hash"], PASSWORD_DEFAULT);

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
