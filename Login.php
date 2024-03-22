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
    $username = $conn->real_escape_string($_POST['username']);
    $password = $conn->real_escape_string($_POST['password']);

    // SQL query to fetch user data
    $sql = "SELECT * FROM users WHERE username = '$username'";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password (assuming password_hash() used during signup)
        if (password_verify($password, $user['password'])) {
            // Login successful - you can start a session or redirect to a user dashboard
            header('Location: Home.php');
            // ... (session handling or redirection logic)
        } else {
            echo "Invalid username or password.";
        }
    } else {
        echo "Invalid username or password.";
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link to your CSS file -->
    <link rel="stylesheet" href="Login.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
<form method="post" action="">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>

    <button type="submit" name="submit" value="Login">Login</button>
</form>
<center><h4>Didn't Register? <a href="Signup.php">Register</a></h4></center>
    </div>
</body>
</html>
