<?php
require_once __DIR__ . '/includes/functions.php';
$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM herbs WHERE id=? AND is_active=1"); $stmt->execute([$id]); $herb = $stmt->fetch();
if (!$herb) { http_response_code(404); exit('Herb not found.'); }
$pageTitle = $herb['name'] . ' | HerbNest';
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 verify_csrf();
 $qty = max(1, min(20, (int)($_POST['quantity'] ?? 1)));
 $_SESSION['cart'][$id] = min(20, (int)($_SESSION['cart'][$id] ?? 0) + $qty);
 $_SESSION['cart_count'] = array_sum($_SESSION['cart']);
 header('Location: cart.php?added=1'); exit;
}
include __DIR__ . '/includes/header.php';
?>
<section class="detail-wrap">
 <div class="detail-photo"><img src="<?= e($herb['image_url']) ?>" alt="<?= e($herb['name']) ?>"></div>
 <div class="detail-copy"><span class="eyebrow"><?= e($herb['category']) ?></span><h1><?= e($herb['name']) ?></h1><p class="detail-description"><?= e($herb['description']) ?></p><div class="detail-price"><?= money((float)$herb['price']) ?> <small>/ <?= e($herb['unit']) ?></small></div>
 <p class="stock-note"><?= (int)$herb['stock'] > 0 ? 'In stock · ' . (int)$herb['stock'] . ' available' : 'Currently out of stock' ?></p>
 <form method="post" class="buy-row"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Quantity <input type="number" name="quantity" min="1" max="20" value="1"></label><button class="button" <?= (int)$herb['stock'] < 1 ? 'disabled' : '' ?>>Add to basket</button></form>
 <div class="info-note"><b>A thoughtful note</b><p>Product information is provided for general educational purposes. This listing is not medical advice and does not claim to treat or cure any condition.</p></div>
 </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
