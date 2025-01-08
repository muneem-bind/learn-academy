<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST["full_name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    // Perform validation
    // (You can add more validation as per your requirements)

    if ($password != $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Database connection
    $servername = "localhost";
    $username = "username"; // Replace with your MySQL username
    $password = "password"; // Replace with your MySQL password
    $dbname = "database";   // Replace with your MySQL database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert user data into the database
    $sql = "INSERT INTO Users (full_name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $full_name, $email, $hashed_password);

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $stmt->close();
    $conn->close();
}
?>
