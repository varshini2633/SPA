<?php
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "SPA";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If the form is submitted
if (isset($_POST['submit'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm_password']);

    // Check for password match
    if ($password == $confirm_password) {
        // Hash the password before saving
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert data into the database
        $sql = "INSERT INTO users (name, username, password) VALUES ('$name', '$username', '$hashed_password')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            header('Location: Home.php');
    exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Passwords do not match.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <link rel="stylesheet" href="Signup.css">

</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
<form method="post" action="" id="signupForm">
    <label for="name">Name:</label><br>
    <input type="text" id="name" name="name"><br><br>

    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <label for="confirm_password">Confirm Password:</label><br>
    <input type="password" id="confirm_password" name="confirm_password"><br><br>

    <button type="submit" name="submit" value="Register" id="submit">Signup</button> 
</form>
<center><h4>Already signed up? <a href="Login.php">Login</a></h4></center>
    </div>
</body>
</html>
