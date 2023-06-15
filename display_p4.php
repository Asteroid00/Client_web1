<html>

<head>
    <title>Product List</title>
    <link rel="stylesheet" href="mycss.css">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&family=Roboto&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="dis.css" />
</head>

<body>
<div class="navbar">
        <ul>
            <li><a href="index.html" style="margin-right: 2vh;">Contact</a></li>
            <li><a href="#">About</a></li>
            <li><a href="index.html">Services</a></li>
            <li><a href="index.html">Home</a></li>
            <li><a href="index.html"><img src="img/logo.jpg"></a></li>
        </ul>
    </div>
    <?php

    $products = [];
    // Loop through the products array
    foreach ($products as $product) {
        $productName = $product['name'];
        $productDescription = $product['description'];
        $productImage = $product['image'];

        echo '<div class="product">';
        echo '<img src="data:image/jpeg;base64,' . base64_encode($productImage) . '" alt="' . $productName . '">';
        echo '<h2>' . $productName . '</h2>';
        echo '<p>' . $productDescription . '</p>';
        echo '</div>';
    }

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
    $sql = "SELECT name, dis, image FROM p4";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {

        while ($row = mysqli_fetch_assoc($result)) {
            $productName = $row['name'];
            $productDescription = $row['dis'];
            $productImage = $row['image'];

            echo '<div class="box show">';
            echo    '<img src="data:image/jpeg;base64,' . base64_encode($productImage) . '"  alt="' . $productName . '">';
            echo    '<div class="prod-info">';
            echo        '<h2>' . $productName . '</h2>';
            echo        '<p>' .nl2br(htmlspecialchars($productDescription)) . '</p>';
            echo    '</div>';
            echo '</div>';
        }
    } else {
        echo "No products found.";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

    <script defer src="app.js"></script>
</body>

</html>