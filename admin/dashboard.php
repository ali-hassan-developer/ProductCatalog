<?php include '../db.php'; ?>
<?php
// Add product
if (isset($_POST['submit'])) {
    // ... same logic as before
}

// Update product
if (isset($_POST['update'])) {
    // ... update query logic
}

// Delete product (soft delete)
if (isset($_POST['delete'])) {
    $deleteId = $_POST['delete_id'];
    $conn->query("UPDATE products SET is_deleted='yes' WHERE id=$deleteId");
    echo "<script>alert('Product deleted!'); window.location.href='dashboard.php';</script>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h2 class="mb-4">Admin Dashboard</h2>

        <!-- Add Button -->
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addProductModal">
            + Add New Product
        </button>

        <div class="card shadow">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM products WHERE is_deleted='no'";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                  <td>{$row['id']}</td>
                  <td>{$row['name']}</td>
                  <td>{$row['category']}</td>
                  <td>\${$row['price']}</td>
                  <td>{$row['stock_status']}</td>
                  <td>
                    <button class='btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#editProductModal{$row['id']}'>Edit</button>
                    <button class='btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#deleteProductModal{$row['id']}'>Delete</button>
                  </td>
                </tr>";


                            include 'modals/edit_product.php';
                            include 'modals/delete_product.php';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include Add Product Modal -->
    <?php include 'modals/add_product.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>