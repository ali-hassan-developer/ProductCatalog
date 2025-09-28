<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Details</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $sql = "SELECT * FROM products WHERE id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='product-detail'>";
            echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<h2>" . $row['name'] . "</h2>";
            echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
            echo "<p><strong>Category:</strong> " . $row['category'] . "</p>";
            echo "<p><strong>Status:</strong> " . $row['stock_status'] . "</p>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<a href='index.php'>Back to Catalog</a>";
            echo "</div>";
        } else {
            echo "<p>Product not found!</p>";
        }
    } else {
        echo "<p>No product selected!</p>";
    }
    ?>
</body>
</html>
