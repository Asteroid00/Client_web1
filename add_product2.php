<?php
// Retrieve the name and description from the form
$name = $_POST['name'];
$description = $_POST['dis'];

// Create a connection to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mgr";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $image = $_FILES["image"]["tmp_name"];

    // Convert image to binary data
    $imageData = addslashes(file_get_contents($image));
// Prepare the SQL statement to insert the data into the table
$sql = "INSERT INTO p2 (name, dis,image) VALUES ('$name', '$description','$imageData')";

// Execute the SQL statement
if ($conn->query($sql) === TRUE) {
    echo "Product added successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
}

// Close the database connection
$conn->close();
?>
