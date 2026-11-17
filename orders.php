<?php
require_once __DIR__ . '/includes/functions.php';customer_only();
$st=$pdo->prepare("SELECT * FROM orders WHERE customer_id=? ORDER BY created_at DESC");$st->execute([$_SESSION['customer_id']]);$orders=$st->fetchAll();
$pageTitle='My orders | HerbNest';include __DIR__.'/includes/header.php';
?>
<section class="page-intro compact"><span class="eyebrow">CUSTOMER PORTAL</span><h1>Your orders.</h1><p>Welcome, <?= e($_SESSION['customer_name']??'customer') ?>.</p></section><section class="section section-top"><?php if(isset($_GET['placed'])): ?><div class="success">Your order has been placed successfully.</div><?php endif; ?><?php if(!$orders): ?><div class="empty-state"><h2>No orders yet.</h2><a class="button" href="products.php">Start shopping</a></div><?php else: ?><div class="table-wrap"><table><thead><tr><th>Order</th><th>Date</th><th>Total</th><th>Status</th></tr></thead><tbody><?php foreach($orders as $o): ?><tr><td>#<?= (int)$o['id'] ?></td><td><?= e($o['created_at']) ?></td><td><?= money((float)$o['total_amount']) ?></td><td><span class="status"><?= e($o['status']) ?></span></td></tr><?php endforeach; ?></tbody></table></div><?php endif; ?></section>
<?php include __DIR__.'/includes/footer.php'; ?>
