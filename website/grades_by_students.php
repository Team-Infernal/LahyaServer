<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="http://localhost:3002/api/activity_domain" method="post">
        <label for="value">Value:</label>
        <input type="number" name="value" id="value" min="0" max="5"><br>

        <label for="comment">Comment:</label><br>
        <textarea name="comment" id="comment" cols="50" rows="7"></textarea><br>

        <label for="reaction_emoji">Reaction:</label>
        <input type="text" name="reaction_emoji" id="reaction_emoji"><br>

        <input type="hidden" name="id_users" id="id_users"><br>

        <input type="hidden" name="id_company" id="id_company"><br>

        <input type="submit" value="register">

    </form>
</body>
</html>