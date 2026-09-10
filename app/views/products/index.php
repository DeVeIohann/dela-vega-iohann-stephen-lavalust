<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <style>
        :root {
            --bg-1: #1a0d2e;
            --bg-2: #2b1647;
            --panel: rgba(46, 31, 72, 0.9);
            --panel-soft: rgba(255,255,255,0.04);
            --gold: #d4af37;
            --gold-soft: #f4d77d;
            --violet: #6f3ec9;
            --violet-soft: #8c5ae7;
            --text: #f7f2ff;
            --muted: #d9caef;
            --border: rgba(212, 175, 55, 0.3);
            --shadow: rgba(12, 7, 25, 0.45);
        }

        * { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(135deg, #1a0d2e 0%, #2b1647 45%, #3b1e5e 100%);
            color: var(--text);
            padding: 34px 18px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 24px;
            box-shadow: 0 24px 60px var(--shadow);
            padding: 28px 22px;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.3);
        }

        h2 {
            margin: 0;
            font-size: clamp(1.8rem, 2vw, 2.4rem);
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.2s ease;
        }

        .btn:hover { transform: translateY(-1px); }

        .btn-primary {
            background: linear-gradient(135deg, var(--gold) 0%, #f0c14a 100%);
            color: #1e1635;
        }

        .btn-secondary {
            background: transparent;
            border: 1px solid var(--gold);
            color: var(--gold-soft);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            overflow: hidden;
            border-radius: 18px;
            background: rgba(255,255,255,0.02);
            border: 1px solid var(--border);
        }

        th, td {
            padding: 14px 12px;
            text-align: left;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
            vertical-align: top;
        }

        th {
            background: rgba(111, 62, 201, 0.4);
            color: var(--gold-soft);
            font-size: 0.9rem;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        td {
            color: var(--text);
        }

        .actions-cell {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .link {
            color: var(--gold-soft);
            text-decoration: none;
            font-weight: 700;
        }

        .link-danger {
            color: #ffd08d;
        }

        .link:hover { text-decoration: underline; }
    </style>
    <link rel="stylesheet" href="<?=site_url('public/css/lavalust.css')?>">
</head>
<body>
    <div class="container">
        <div class="topbar">
            <h2>Product Management</h2>
            <div class="actions">
                <a class="btn btn-primary" href="<?=site_url('products/create')?>">Add New Product</a>
                <a class="btn btn-secondary" href="<?=site_url('auth/logout')?>">Logout</a>
            </div>
        </div>

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
                    <td><?=html_escape($p['id'])?></td>
                    <td><?=html_escape($p['product_name'])?></td>
                    <td><?=html_escape($p['description'])?></td>
                    <td>$<?=html_escape($p['price'])?></td>
                    <td><?=html_escape($p['quantity'])?></td>
                    <td><?=html_escape($p['created_at'])?></td>
                    <td>
                        <div class="actions-cell">
                            <a class="link" href="<?=site_url('products/edit/'.$p['id'])?>">Edit</a>
                            <a class="link link-danger" href="<?=site_url('products/delete/'.$p['id'])?>" onclick="return confirm('Delete this product?');">Delete</a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>