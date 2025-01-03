<?php
// Secure PHP code

// Connect to database
$conn = new mysqli("localhost", "root", "", "cybersecurity-project");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate and sanitize input
function validate_input($data) {
    return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
}

// Get and validate input from the form
$user = isset($_GET['username']) ? validate_input($_GET['username']) : null;
$pass = isset($_GET['password']) ? validate_input($_GET['password']) : null;

if ($user && $pass) {
    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE name = ? AND pass = ?");
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Login successful!<br>";

        // Fetch and display user data (if needed)
        while ($row = $result->fetch_assoc()) {
            echo "ID: " . $row["id"] . " - Name: " . $row["name"] . "<br>";
        }
    } else {
        echo "Invalid credentials.";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "Please provide a valid username and password.";
}

// Close the connection
$conn->close();
?>
