<?php require_once "basket.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = $_POST['productId'] ?? '';

    if ($action === 'removeFromBasket' && !empty($productId)) {
        $basket->removeFromBasket($productId);
        echo 'Item removed';
    } elseif ($action === 'clearBasket') {
        $basket->clearBasket();
        echo 'Basket cleared';
    }
} ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Basket</title>
    <style>
        .container {
            margin-top: 30px;
        }

        .basket-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        .btn-remove {
            background-color: #dd7973;
            color: #fff;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Cosmetics</a>
            <a class="btn btn-light" href="index.php">
                <i class="fa-solid fa-arrow-left"></i> Back to Products
            </a>
        </div>
    </nav>

    <div class="container">
        <h2>Your Basket</h2>

        <?php if (!empty($basketContents)): ?>
            <ul class="list-unstyled">
                <?php foreach ($basketContents as $item): ?>
                    <li class="basket-item d-flex justify-content-between align-items-center">
                        <div>
                            <h5><?php echo htmlspecialchars($item['name']); ?></h5>
                            <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
                            <p>Quantity: <?php echo $item['quantity']; ?></p>
                        </div>
                        <form method="post" action="cart.php" class="remove-form">
                            <input type="hidden" name="productId" value="<?php echo htmlspecialchars($item['id']); ?>">
                            <input type="hidden" name="action" value="removeFromBasket">
                            <button type="submit" class="btn btn-remove btn-sm">Remove</button>
                        </form>

                    </li>
                <?php endforeach; ?>
            </ul>

            <form method="post" action="cart.php" class="clear-form">
                <input type="hidden" name="action" value="clearBasket">
                <button type="submit" class="btn btn-danger">Clear Basket</button>
            </form>

        <?php else: ?>
            <p>Your basket is empty.</p>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script defer src="scripts.js"></script>
</body>

</html>