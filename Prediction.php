<?php

$escaped_file_path = escapeshellarg("Backend.py");  

$output = shell_exec("python $escaped_file_path");

echo $output;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction</title>
    <link href="Prediction.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li ><a href="index.html" id="logoutButton">Logout</a></li>
                <li ><a href="Analysis.php">Analysis</a></li>
                <li ><a href="Prediction.php">Prediction</a></li>
                <li><a href="Home.php">Home</a></li>
            </ul>
        </nav>
    </header>
    <h1>Prediction</h1><br>
    <form id="predictionForm">

                <label for="raisedhands">Raised Hands:</label>
        <input type="number" id="raisedhands" name="raisedhands" required>

        
        <label for="visitedResources">Visited Resources:</label>
        <input type="number" id="visitedResources" name="visitedResources" required>

        
        <label for="discussion">Discussion:</label>
        <input type="number" id="discussion" name="discussion" required>
            </div>
                
            <label for="announcementsView">Announcements View:</label>
        <input type="number" id="announcementsView" name="announcementsView" required> <br><br><br>
        <center><button type="submit" class="centered-button">Predict</button></center>
    </form>

    <script src="nav.js">
        document.getElementById('predictionForm').addEventListener('submit', function(event) {
            event.preventDefault(); 
            var formData = new FormData(this);
            fetch('/predict', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                // Handle prediction result
                console.log(data);
            })
            .catch(error => {
                console.error('There was a problem with your fetch operation:', error);
            });
        });
    </script>
</body>
</html>
