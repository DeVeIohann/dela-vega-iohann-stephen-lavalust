<!DOCTYPE html>
<html>
<head><title>Product List</title></head>
<body>
    <h2>Product Management</h2>
    <a href="<?=site_url('products/create')?>">Add New Product</a> | 
    <a href="<?=site_url('auth/logout')?>">Logout</a>
    <br><br>
    <table border="1" cellpadding="8" cellspacing="0">
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
                <td><?=html_escape($p['id'])?></td>
                <td><?=html_escape($p['product_name'])?></td>
                <td><?=html_escape($p['description'])?></td>
                <td>$<?=html_escape($p['price'])?></td>
                <td><?=html_escape($p['quantity'])?></td>
                <td><?=html_escape($p['created_at'])?></td>
                <td>
                    <a href="<?=site_url('products/edit/'.$p['id'])?>">Edit</a> | 
                    <a href="<?=site_url('products/delete/'.$p['id'])?>" onclick="return confirm('Delete this product?');">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>