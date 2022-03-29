<?php 
    function fillSelectWith($table, $column) {
    $response = file_get_contents("http://localhost:3002/api/$table");
    $response = json_decode($response);
    foreach($response as $value) {
        echo "<option value=".$value->id.">";
        echo $value->$column;
        echo "</option>";
    }
    echo "<option value='new'>New</option>";
    }
?>