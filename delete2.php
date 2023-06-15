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

// Check if a record ID is provided
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Prepare and execute the SQL DELETE query
    $sql = "DELETE FROM p2 WHERE id = $id";
    $result = mysqli_query($conn, $sql);

    // Check if the deletion was successful
    if ($result) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    echo "Invalid record ID.";
}

// Close the database connection
mysqli_close($conn);
?>
