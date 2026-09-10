<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; font-weight: bold; }
        input[type="text"], input[type="number"], textarea { width: 300px; padding: 8px; box-sizing: border-box; }
        .btn { padding: 6px 12px; text-decoration: none; border-radius: 4px; display: inline-block; cursor: pointer; border: none; }
        .btn-add { background-color: #28a745; color: white; margin-bottom: 10px; }
        .btn-edit { background-color: #007bff; color: white; }
        .btn-delete { background-color: #dc3545; color: white; }
    </style>
</head>
<body>

    <!-- ACTION 1: LIST PRODUCTS -->
    <?php if ($action === 'list'): ?>
        <h2>Product Management</h2>
        <?php if (!empty($username)): ?><p>Signed in as <?= htmlspecialchars($username); ?> | <a href="<?= site_url('logout'); ?>">Log out</a></p><?php endif; ?>
        <a href="<?= site_url('products/create'); ?>" class="btn btn-add">+ Add New Product</a>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($products as $p): ?>
                <tr>
                    <td><?= $p['id']; ?></td>
                    <td><?= htmlspecialchars($p['product_name']); ?></td>
                    <td><?= htmlspecialchars($p['description']); ?></td>
                    <td>$<?= number_format($p['price'], 2); ?></td>
                    <td><?= $p['quantity']; ?></td>
                    <td><?= $p['created_at']; ?></td>
                    <td>
                        <a href="<?= site_url('products/edit/' . $p['id']); ?>" class="btn btn-edit">Edit</a>
                        <a href="<?= site_url('products/delete/' . $p['id']); ?>" class="btn btn-delete" onclick="return confirm('Delete this product?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php if (empty($products)): ?>
                <tr>
                    <td colspan="7">No products found. Add your first product to get started.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>

    <!-- ACTION 2: ADD PRODUCT FORM -->
    <?php elseif ($action === 'create'): ?>
        <h2>Add New Product</h2>
        <form action="<?= site_url('products/create'); ?>" method="POST">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4"></textarea>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" step="0.01" name="price" required>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" required>
            </div>
            <button type="submit" class="btn btn-add">Save Product</button>
            <a href="<?= site_url('products'); ?>">Cancel</a>
        </form>

    <!-- ACTION 3: EDIT PRODUCT FORM -->
    <?php elseif ($action === 'edit'): ?>
        <h2>Edit Product</h2>
        <form action="<?= site_url('products/edit/' . $product['id']); ?>" method="POST">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']); ?>" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="4"><?= htmlspecialchars($product['description']); ?></textarea>
            </div>
            <div class="form-group">
                <label>Price</label>
                <input type="number" step="0.01" name="price" value="<?= $product['price']; ?>" required>
            </div>
            <div class="form-group">
                <label>Quantity</label>
                <input type="number" name="quantity" value="<?= $product['quantity']; ?>" required>
            </div>
            <button type="submit" class="btn btn-edit">Update Product</button>
            <a href="<?= site_url('products'); ?>">Cancel</a>
        </form>
    <?php endif; ?>

</body>
</html>
