<!DOCTYPE html>
<html>

<head>
    <title>Delete Data</title>
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 20px;
}

.navbar {
    background-color: black;
    width: 100%;
}

.navbar ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
}

.navbar li {
    text-align: center;
    font-size: small;
}

.navbar li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
    margin-left: 2vh;
}

.navbar li a:hover {
    background-color: #333333;
}
.data-entry {
    background-color: #f5f5f5;
    padding: 10px;
    margin-bottom: 10px;
}

.data-entry p {
    margin: 5px 0;
}

.data-entry form {
    display: inline-block;
    margin-top: 10px;
}

.data-entry input[type="submit"] {
    background-color: #dc3545;
    color: #fff;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.data-entry input[type="submit"]:hover {
    background-color: #c82333;
}

    </style>
</head>

<body>
<div class="navbar">
        <ul>
            <li><a href="index.html">Home</a></li>
        </ul>
    </div>
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

    // Fetch data from the database
    $sql = "SELECT * FROM p2";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $img = $row['image'];
            $name = $row['name'];
            $dis = $row['dis'];
            $id=$row['id'];

            echo '<div class="data-entry">';
            echo '<p><strong>Name:</strong> ' . $name . '</p>';
            echo '<p><strong>Description:</strong> ' . $dis . '</p>';
            echo '<img src="data:image/jpeg;base64,' . base64_encode($img) . '"  alt="' . $name . '">';
            echo '<form action="delete.php" method="post">';
            echo '<input type="hidden" name="id" value="' . $id . '">';
            echo '<input type="submit" value="Delete">';
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo "No data found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>
</body>

</html>
