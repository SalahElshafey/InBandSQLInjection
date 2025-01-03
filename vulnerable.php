<?php
// Vulnerable PHP code

// Capture user input from the GET request
$username = $_GET['username'];

// SQL query (Vulnerable to SQL Injection)
$query = "SELECT * FROM users WHERE username = '$username'";

// Debugging: Log query to JavaScript console (optional in certain setups)
echo "<script>console.log('SQL Query: $query');</script>";

// Connect to database (adjust credentials as needed)
$conn = new mysqli("localhost", "root", "", "test_db");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Execute query
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Name: " . $row['username'] . "<br>";
    }
} else {
    echo "No results found";
}

// Close connection
$conn->close();
?>
