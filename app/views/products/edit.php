<!DOCTYPE html>
<html>
<head><title>Edit Product</title></head>
<body>
    <h2>Edit Product</h2>
    <form action="<?=site_url('products/edit/'.$product['id'])?>" method="POST">
        <label>Product Name:</label><br>
        <input type="text" name="product_name" value="<?=html_escape($product['product_name'])?>" required><br><br>

        <label>Description:</label><br>
        <textarea name="description" required><?=html_escape($product['description'])?></textarea><br><br>

        <label>Price:</label><br>
        <input type="number" step="0.01" name="price" value="<?=html_escape($product['price'])?>" required><br><br>

        <label>Quantity:</label><br>
        <input type="number" name="quantity" value="<?=html_escape($product['quantity'])?>" required><br><br>

        <button type="submit">Update Product</button>
        <a href="<?=site_url('products')?>">Cancel</a>
    </form>
</body>
</html>