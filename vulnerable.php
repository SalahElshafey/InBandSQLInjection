<?php
// Vulnerable PHP code for educational purposes

// Connect to database
$conn = new mysqli("localhost", "root", "", "cybersecurity-project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture user input from the GET request
$username = isset($_GET['username']) ? $_GET['username'] : '';

// Correct query to match the actual column name
$query = "SELECT * FROM users WHERE name = '$username'"; // Use `name` instead of `username`

// Debugging: Log query to JavaScript console (optional in certain setups)
echo "<script>console.log('SQL Query: $query');</script>";

// Execute query
$result = $conn->query($query);

// Display results
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Name: " . $row['name'] . "<br>";
    }
} else {
    echo "No results found";
}

// Close connection
$conn->close();
?>
