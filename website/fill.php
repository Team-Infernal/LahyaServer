<?php 
    function fillSelectWith($table) {
        $response = file_get_contents("http://localhost:3002/api/$table");
        $response = json_decode($response);
        foreach($response as $value) {
            echo "<option value='1'>";
            foreach($value as $value2) {
                echo $value2. " ";
            }
            echo "</option>";
        }
        echo "<option value='New'>New</option>";
    }
?>