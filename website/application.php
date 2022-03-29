<?php 
    require_once("./fill.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="http://localhost:3002/api/application" method="post">
        <label for="current_step">Step:*</label>
        <select name="current_step" id="current_step">
            <option value="1">1) Offre formulée par l'Etudiant</option>
            <option value="2">2) Reponse de l'entreprise</option>
            <option value="3">3) Fiche de validation de stage émise par l'entreprise</option>
            <option value="4">4) Fiche de validation de stage signée par le pilote</option>
            <option value="5">5) Convention de stage émise par le pilote</option>
            <option value="6">6) Convention de stage signée par l'entreprise.</option>
        </select><br>

        <label for="cv_link">CV Link</label>
        <input type="text" name="cv_link" id="cv_link"><br>

        <label for="motivation_link">Motivation Link</label>
        <input type="text" name="motivation_link" id="motivation_link"><br>

        <label for="validation_link">Validation Link</label>
        <input type="text" name="validation_link" id="validation_link"><br>

        <label for="signed_validation_link">Signed Validation Link</label>
        <input type="text" name="signed_validation_link" id="signed_validation_link"><br>

        <label for="convention_link">Convention Link</label>
        <input type="text" name="convention_link" id="convention_link"><br>

        <label for="signed_convention_link">Signed Convention Link</label>
        <input type="text" name="signed_convention_link" id="signed_convention_link"><br>
        
        <label for="id_company">Company :</label>
        <select name="id_company" id="id_company">
        <?php
            fillSelectWith("company", "id");
        ?>
        </select><br>
        <input type="submit" value="register">
    </form>
</body>
</html>