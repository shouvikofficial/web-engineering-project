
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        label{
            width: 300px;
            display:block;
        }
    </style>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Upload Data</h1>
    <div>
        <form action="code.php" method="post" id="form">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username">
            </div><br>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email">
            </div><br>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password">
            </div><br>
            <div>
                <input type="submit" name="Register" value="Submit">
            </div>
        </form>
    </div>
</body>
</html>