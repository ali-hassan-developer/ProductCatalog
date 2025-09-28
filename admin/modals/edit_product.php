<?php include '../db.php'; ?>
<?php
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $desc = $_POST['description'];
    $price = $_POST['price'];
    $cat = $_POST['category'];
    $stock = $_POST['stock_status'];

    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $tmp = $_FILES['image']['tmp_name'];
        move_uploaded_file($tmp, "../images/" . $image);
    } else {
        $image = $row['image'];
    }

    $sql = "UPDATE products SET 
            name='$name', description='$desc', price='$price',
            category='$cat', stock_status='$stock', image='$image'
            WHERE id=$id";
    if ($conn->query($sql)) {
        echo "Product Updated!";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>
<div class="modal fade" id="editProductModal<?= $row['id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header bg-warning">
                <h5 class="modal-title">Edit Product - <?= $row['name'] ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" value="<?= $row['name'] ?>" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" rows="3"><?= $row['description'] ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" name="price" value="<?= $row['price'] ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" value="<?= $row['category'] ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock Status</label>
                        <select name="stock_status" class="form-select">
                            <option value="In Stock" <?= ($row['stock_status'] == 'In Stock') ? 'selected' : '' ?>>In Stock</option>
                            <option value="Out of Stock" <?= ($row['stock_status'] == 'Out of Stock') ? 'selected' : '' ?>>Out of Stock</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Current Image</label><br>
                        <img src="../images/<?= $row['image'] ?>" width="100" class="mb-2"><br>
                        <input type="file" name="image" class="form-control">
                    </div>

                    <button type="submit" name="update" class="btn btn-success w-100">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</div>


</body>

</html>