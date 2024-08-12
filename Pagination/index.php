index.php
<?php
require_once "database.php";
require_once "basket.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'addToBasket') {
    $productId = filter_var($_POST['productId'], FILTER_SANITIZE_NUMBER_INT);

    $db = new Database();
    $product = $db->all('items', null, null)['data'];
    $productDetails = array_filter($product, fn($item) => $item['id'] == $productId);
    $productDetails = array_shift($productDetails);

    $basket = new Basket();
    $basket->addToBasket($productDetails);

    echo json_encode(['status' => 'success']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Product Listing</title>
    <style>
        .container {
            height: 80vh;
        }

        h2 {
            margin-bottom: 50px;
        }

        .pagination {
            margin-top: 30px;
        }

        .imgbox img {
            width: 160px;
            height: auto;
            margin-bottom: 30px;
        }

        nav {
            background-color: #6f3860;
            color: #ffff;
        }

        .navbar a {
            color: #ffff;
        }

        .pagination li a {
            background-color: #898287;
            color: #ffff;
        }

        .product-item.hidden {
            display: none;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-md">
        <div class="container-fluid">
            <a class="navbar-brand mx-5" href="#">Cosmetics</a>
            <a id="view-basket" class="icon fs-5 text-end mx-5" href="cart.php">
                <i class="fa-solid fa-cart-shopping"></i>
            </a>
        </div>
    </nav>

    <section>
        <div class="container mt-5 d-flex flex-column justify-content-center">
            <h2 class="text-center">Beauty Products</h2>
            <ul class="d-flex gap-4 list-unstyled" id="product-list">
                <?php foreach ($data['data'] as $item): ?>
                    <li class="border p-3 rounded product-item" data-id="<?php echo $item['id']; ?>">
                        <div class="imgbox">
                            <img src="<?php echo htmlspecialchars($item['image_url']); ?>"
                                alt="<?php echo htmlspecialchars($item['title']); ?>">
                        </div>
                        <div class="content">
                            <h6><?php echo htmlspecialchars($item['title']); ?></h6>
                            <p>Price: <?php echo htmlspecialchars($item['price']); ?></p>
                            <button class="btn add-to-basket" style="background-color:#dd7973">Add to Basket</button>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <ul class="pagination justify-content-center">
                <li class="page-item <?php echo $data['currentPage'] <= 1 ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo max(1, $data['currentPage'] - 1); ?>"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>

                <?php if ($data['totalPages'] > 1): ?>
                    <li class="page-item <?php echo $data['currentPage'] == 1 ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=1">1</a>
                    </li>
                    <?php if ($data['currentPage'] > 5): ?>
                        <li class="page-item disabled"><span class="page-link">...</span></li>
                    <?php endif; ?>

                    <?php for ($i = max(2, $data['currentPage'] - 2); $i <= min($data['totalPages'] - 1, $data['currentPage'] + 2); $i++): ?>
                        <li class="page-item <?php echo $i == $data['currentPage'] ? 'active' : ''; ?>">
                            <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                <?php endif; ?>

                <li class="page-item <?php echo $data['currentPage'] >= $data['totalPages'] ? 'disabled' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo min($data['totalPages'], $data['currentPage'] + 1); ?>"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </div>
    </section>
    <script defer src="scripts.js"></script>
</body>

</html>