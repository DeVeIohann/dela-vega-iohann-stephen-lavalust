<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        :root {
            --bg-1: #1a0d2e;
            --bg-2: #2b1647;
            --panel: rgba(42, 28, 67, 0.88);
            --panel-border: rgba(212, 175, 55, 0.5);
            --gold: #d4af37;
            --gold-soft: #f4d77d;
            --text: #f7f2ff;
            --muted: #d9caef;
            --shadow: rgba(12, 7, 25, 0.45);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, var(--bg-1) 0%, var(--bg-2) 45%, #3b1e5e 100%);
            color: var(--text);
            padding: 32px 18px;
        }

        .panel {
            width: min(92vw, 620px);
            background: var(--panel);
            border: 1px solid var(--panel-border);
            border-radius: 24px;
            box-shadow: 0 24px 60px var(--shadow);
            padding: 28px 26px;
        }

        h2 {
            margin: 0 0 24px;
            font-size: clamp(1.8rem, 2vw, 2.4rem);
            text-align: center;
        }

        form {
            display: grid;
            gap: 16px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: var(--muted);
            font-weight: 600;
        }

        input, textarea {
            width: 100%;
            border-radius: 12px;
            border: 1px solid rgba(212, 175, 55, 0.4);
            background: rgba(255,255,255,0.04);
            color: var(--text);
            padding: 12px 14px;
            font-size: 1rem;
            resize: vertical;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.18);
        }

        .actions {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        button, .cancel {
            border: none;
            border-radius: 12px;
            padding: 12px 18px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: linear-gradient(135deg, var(--gold) 0%, #f0c14a 100%);
            color: #22163d;
            box-shadow: 0 10px 20px rgba(212, 175, 55, 0.25);
        }

        .cancel {
            display: inline-block;
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold-soft);
        }
    </style>
</head>
<body>
    <div class="panel">
        <h2>Edit Product</h2>
        <form action="<?=site_url('products/edit/'.$product['id'])?>" method="POST">
            <div>
                <label>Product Name</label>
                <input type="text" name="product_name" value="<?=html_escape($product['product_name'])?>" required>
            </div>

            <div>
                <label>Description</label>
                <textarea name="description" rows="5" required><?=html_escape($product['description'])?></textarea>
            </div>

            <div>
                <label>Price</label>
                <input type="number" step="0.01" name="price" value="<?=html_escape($product['price'])?>" required>
            </div>

            <div>
                <label>Quantity</label>
                <input type="number" name="quantity" value="<?=html_escape($product['quantity'])?>" required>
            </div>

            <div class="actions">
                <button type="submit">Update Product</button>
                <a class="cancel" href="<?=site_url('products')?>">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>