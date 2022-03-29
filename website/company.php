<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="http://localhost:3002/api/company" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name"><br>

        <label for="student_accepted">Student Accepted:</label>
        <input type="number" name="student_accepted" id="student_accepted"><br>

        <label for="students_visible">Students Visible:</label>
        <select name="current_step" id="current_step">
            <option value="true">True</option>
            <option value="false">False</option>
        </select><br>
        
        <input type="submit" value="register">
    </form>
</body>
</html>