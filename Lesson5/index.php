<?php
$databaseConnection = new PDO('mysql:host=localhost;dbname=test_db', 'root', '');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $sqlQuery = "SELECT * FROM users WHERE username ='". $_POST['username']."' AND password='".$_POST['password']."'";
    // $queryResult = $databaseConnection->query($sqlQuery);
    // SELECT * FROM users WHERE username ='user' AND password='' OR '2'='2'
    $sqlQuery = "SELECT * FROM users WHERE username = :username AND password = :password";
    $preparedQuery = $databaseConnection->prepare($sqlQuery);
    $preparedQuery->execute([
        ':username' => $_POST['username'],
        ':password' => $_POST['password']
    ]);
    $userData = $preparedQuery->fetch();
    if ($userData) {
        echo "<h3>Welcome, " . htmlspecialchars($_POST['username']) . "!</h3>";
    } else {
        echo "<h3>Login failed. Invalid username or password.</h3>";
    }
}


?>

<!-- Login Form -->
<h2>Login Form (Vulnerable)</h2>
<form method="POST">
    <label>Username:</label><br>
    <input type="text" name="username"><br>
    <label>Password:</label><br>
    <input type="password" name="password"><br><br>
    <input type="submit" value="Login">
</form>
