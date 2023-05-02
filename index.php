<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/styles.css">
    <link rel="stylesheet" href="CSS/W3.css">
    <title>Login</title>
</head>
<body>

 <form method="POST" action="login.php">
    <h1>Login</h1>
    <label for="ID">ID</label>
    <input type="text" id="ID" name="ID" required>
    <label for="password">Password</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit_login" name="submit_login">Login</button>
    <br>
    <button onclick="location.href='admin_files/admin_login.php'">Admin Login</button>
 </form>
</body>
</html>