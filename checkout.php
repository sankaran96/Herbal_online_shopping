<?php
require_once __DIR__ . '/includes/functions.php';
customer_only();
$cart=$_SESSION['cart']??[];$ids=array_map('intval',array_keys($cart));$items=[];$total=0;
if($ids){$marks=implode(',',array_fill(0,count($ids),'?'));$st=$pdo->prepare("SELECT * FROM herbs WHERE id IN ($marks) AND is_active=1");$st->execute($ids);foreach($st->fetchAll() as $h){$h['qty']=$cart[$h['id']];$total+=$h['price']*$h['qty'];$items[]=$h;}}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();if(!$items)$error='Your basket is empty.';else{
 try{$pdo->beginTransaction();$st=$pdo->prepare("INSERT INTO orders(customer_id,total_amount,address,phone,status) VALUES(?,?,?,?, 'Pending')");$st->execute([$_SESSION['customer_id'],$total,trim($_POST['address']??''),trim($_POST['phone']??'')]);$oid=(int)$pdo->lastInsertId();$line=$pdo->prepare("INSERT INTO order_items(order_id,herb_id,quantity,unit_price) VALUES(?,?,?,?)");foreach($items as $h){$line->execute([$oid,$h['id'],$h['qty'],$h['price']]);}$pdo->commit();unset($_SESSION['cart'],$_SESSION['cart_count']);header('Location: orders.php?placed=1');exit;}catch(Throwable $e){$pdo->rollBack();$error='Could not place the order. Please try again.';}
}}
$pageTitle='Checkout | HerbNest';include __DIR__.'/includes/header.php';
?>
<section class="page-intro compact"><span class="eyebrow">ALMOST THERE</span><h1>Checkout.</h1><p>Enter your delivery details to place your order.</p></section><section class="section section-top"><div class="checkout-layout"><form method="post" class="auth-card form-stack"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><h2>Delivery information</h2><?php if($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?><label>Phone number<input name="phone" required></label><label>Delivery address<textarea name="address" rows="4" required></textarea></label><button class="button">Place order · <?= money((float)$total) ?></button></form><aside class="order-summary"><h3>Order summary</h3><?php foreach($items as $h): ?><p><?= e($h['name']) ?> × <?= (int)$h['qty'] ?><b><?= money((float)$h['price']*$h['qty']) ?></b></p><?php endforeach; ?><hr><p class="summary-total">Total <b><?= money((float)$total) ?></b></p></aside></div></section>
<?php include __DIR__.'/includes/footer.php'; ?>
