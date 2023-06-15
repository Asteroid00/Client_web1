<?php
// Establish a database connection (replace with your own database credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mgr';

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM login WHERE uid = '$username' AND pass = '$password'";
    $result = mysqli_query($conn, $sql);

    // Check if the query returned a matching record
    if (mysqli_num_rows($result) === 1) {
        // Redirect to connect.php if login is successful
        header("Location: connection.html");
        exit;
    } else {
        // Show an error message if login fails
        echo "Invalid username or password.";
    }
}

// Close the database connection
mysqli_close($conn);
?>
