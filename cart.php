<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 verify_csrf();
 foreach (($_POST['quantity'] ?? []) as $id => $qty) {
  $id=(int)$id; $qty=max(0,min(20,(int)$qty));
  if ($qty===0) unset($_SESSION['cart'][$id]); else $_SESSION['cart'][$id]=$qty;
 }
 $_SESSION['cart_count']=array_sum($_SESSION['cart'] ?? []);
 header('Location: cart.php'); exit;
}
$cart = $_SESSION['cart'] ?? []; $items=[]; $total=0;
if ($cart) {
 $ids=array_map('intval',array_keys($cart)); $marks=implode(',',array_fill(0,count($ids),'?'));
 $stmt=$pdo->prepare("SELECT * FROM herbs WHERE id IN ($marks) AND is_active=1"); $stmt->execute($ids);
 foreach($stmt->fetchAll() as $h){$h['quantity']=$cart[$h['id']];$h['line_total']=$h['price']*$h['quantity'];$total+=$h['line_total'];$items[]=$h;}
}
$pageTitle='Your basket | HerbNest'; include __DIR__ . '/includes/header.php';
?>
<section class="page-intro compact"><span class="eyebrow">YOUR SELECTION</span><h1>Your basket.</h1><p>Check your items and quantities before checkout.</p></section>
<section class="section section-top">
 <?php if (!$items): ?><div class="empty-state"><h2>Your basket is waiting.</h2><p>Browse the botanical collection to add something you like.</p><a class="button" href="products.php">Browse herbs</a></div>
 <?php else: ?>
 <form method="post"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>">
 <div class="cart-list"><?php foreach($items as $h): ?><div class="cart-item"><img src="<?= e($h['image_url']) ?>" alt=""><div class="cart-name"><b><?= e($h['name']) ?></b><small><?= money((float)$h['price']) ?> / <?= e($h['unit']) ?></small></div><label>Qty <input type="number" name="quantity[<?= (int)$h['id'] ?>]" min="0" max="20" value="<?= (int)$h['quantity'] ?>"></label><strong><?= money((float)$h['line_total']) ?></strong></div><?php endforeach; ?></div>
 <div class="cart-summary"><button class="button button-outline" type="submit">Update basket</button><div><span>Total</span><strong><?= money((float)$total) ?></strong><a class="button" href="checkout.php">Continue to checkout</a></div></div>
 </form><?php endif; ?>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
