<?php
// Secure PHP code for user registration

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
$user = isset($_POST['username']) ? validate_input($_POST['username']) : null;
$pass = isset($_POST['password']) ? validate_input($_POST['password']) : null;

if ($user && $pass) {
    // Hash the password for security
    $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (name, pass) VALUES (?, ?)");
    $stmt->bind_param("ss", $user, $hashed_pass);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>Signup successful! You can now <a href='login.html'>login</a>.</p>";
    } else {
        echo "<p style='color: red;'>Signup failed: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
} else {
    echo "<p style='color: orange;'>Please provide a valid username and password.</p>";
}

// Close the connection
$conn->close();
?>
