<?php
require_once 'php/ProductCatalog.php';

$catalog = new ProductCatalog();

$catalog->addProduct('Тайвань', 120000, '7 дней', '3 человека');
$catalog->addProduct('Египет', 84000, '5 дней', '2 человека');
$catalog->addProduct('Турция', 73200, '8 дней', '2 челвека');
$catalog->addProduct('Антарктида', 245000, '15 дней', '1 человек');

$keyword = $_GET['search'] ?? '';
$category = $_GET['category'] ?? '';

$products = $keyword ? $catalog->searchProducts($keyword) : $catalog->getProducts();

if ($category) {
    $products = $catalog->filterByCategory($category);
}

$categories = $catalog->getCategories();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог туров</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Каталог туров</h1>

        <form method="GET" action="index.php" class="search-form">
            <input type="text" name="search" placeholder="Поиск туров" value="<?= htmlspecialchars($keyword) ?>">
            <select name="category">
                <option value="">Любое количество дней</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= htmlspecialchars($cat) ?>" <?= $cat === $category ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Найти</button>
        </form>

        <div class="product-list">
            <?php if (count($products) > 0): ?>
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <h2><?= htmlspecialchars($product['name']) ?></h2>
                        <p><?= htmlspecialchars($product['price']) ?> руб.</p>
                        <p><?= htmlspecialchars($product['category']) ?></p>
                        <p><?= htmlspecialchars($product['ls']) ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Товары не найдены.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>