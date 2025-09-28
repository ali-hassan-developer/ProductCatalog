<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Product Catalog</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Product Catalog</h1>

    <!-- Search + Filter Form -->
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search products..." 
               value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
        
        <select name="category">
            <option value="">All Categories</option>
            <?php
            $catSql = "SELECT DISTINCT category FROM products where is_deleted='no'";
            $catResult = $conn->query($catSql);
            while ($cat = $catResult->fetch_assoc()) {
                $selected = (isset($_GET['category']) && $_GET['category'] == $cat['category']) ? 'selected' : '';
                echo "<option value='" . $cat['category'] . "' $selected>" . $cat['category'] . "</option>";
            }
            ?>
        </select>
        <button type="submit">Filter</button>
    </form>

    <div class="product-container">
        <?php
        $where = "1"; // default (always true)

        if (!empty($_GET['search'])) {
            $search = $conn->real_escape_string($_GET['search']);
            $where .= " AND name LIKE '%$search%'";
        }

        if (!empty($_GET['category'])) {
            $category = $conn->real_escape_string($_GET['category']);
            $where .= " AND category='$category'";
        }

        $sql = "SELECT * FROM products WHERE is_deleted='no' AND $where";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='product'>";
                echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p>Price: $" . $row['price'] . "</p>";
                echo "<p>Status: " . $row['stock_status'] . "</p>";
                echo "<a href='product_detail.php?id=" . $row['id'] . "'>View Details</a>";
                echo "</div>";
            }
        } else {
            echo "<p>No products found!</p>";
        }
        ?>
    </div>
</body>
</html>
