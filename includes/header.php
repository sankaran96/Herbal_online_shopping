<?php
$pageTitle = $pageTitle ?? 'HerbNest | Natural living, thoughtfully sourced';
$active = basename($_SERVER['PHP_SELF']);
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($pageTitle) ?></title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="site-header">
  <div class="nav-wrap">
    <a class="brand" href="index.php"><span class="brand-mark">✿</span><span>herbnest<small>BOTANICAL MARKET</small></span></a>
    <nav class="main-nav">
      <a href="index.php">Home</a><a href="products.php">Shop herbs</a><a href="usage.php">Herb guide</a>
    </nav>
    <div class="nav-actions">
      <a class="nav-link" href="cart.php">Cart <span class="cart-count"><?= (int)($_SESSION['cart_count'] ?? 0) ?></span></a>
      <?php if (!empty($_SESSION['customer_id'])): ?>
        <a class="button button-small" href="orders.php">My account</a>
      <?php else: ?>
        <a class="button button-small" href="login.php">Sign in</a>
      <?php endif; ?>
    </div>
  </div>
</header>
<main>
