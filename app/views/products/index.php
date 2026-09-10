<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand" href="#">Product System</a>
        <div class="d-flex align-items-center text-white">
            <span class="me-3">Welcome, <?= $_SESSION['username'] ?? 'User'; ?></span>
            <a href="<?= site_url('auth/logout'); ?>" class="btn btn-outline-light btn-sm">Logout</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Products</h2>
        <a href="<?= site_url('products/create'); ?>" class="btn btn-primary">+ Add Product</a>
    </div>

    <?php if(!empty($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= $_SESSION['success']; ?></div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(!empty($products)): foreach($products as $p): ?>
                        <tr>
                            <td><?= $p['id']; ?></td>
                            <td><?= htmlspecialchars($p['product_name']); ?></td>
                            <td><?= htmlspecialchars($p['description']); ?></td>
                            <td>$<?= number_format($p['price'], 2); ?></td>
                            <td><?= $p['quantity']; ?></td>
                            <td><?= $p['created_at']; ?></td>
                            <td>
                                <a href="<?= site_url('products/edit/' . $p['id']); ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="<?= site_url('products/delete/' . $p['id']); ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this product?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; else: ?>
                        <tr><td colspan="7" class="text-center py-3">No products found.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>