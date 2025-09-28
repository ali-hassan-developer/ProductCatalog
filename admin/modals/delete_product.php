<!--  -->
<div class="modal fade" id="deleteProductModal<?= $row['id'] ?>" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">

      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title">Delete Product</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <p>Are you sure you want to delete <strong><?= $row['name'] ?></strong>?</p>
      </div>

      <div class="modal-footer">
        <form method="POST">
          <input type="hidden" name="delete_id" value="<?= $row['id'] ?>">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" name="delete" class="btn btn-danger">Yes, Delete</button>
        </form>
      </div>

    </div>
  </div>
</div>

