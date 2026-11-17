<?php
require_once __DIR__ . '/includes/functions.php';
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){
 verify_csrf(); $login=trim($_POST['login']??''); $password=$_POST['password']??'';
 $stmt=$pdo->prepare("SELECT * FROM customers WHERE username=? OR email=? LIMIT 1");$stmt->execute([$login,$login]);$c=$stmt->fetch();
 if($c && password_verify($password,$c['password_hash'])){session_regenerate_id(true);$_SESSION['customer_id']=(int)$c['id'];$_SESSION['customer_name']=$c['name'];header('Location: products.php');exit;}
 $error='Username or password is incorrect.';
}
$pageTitle='Customer sign in | HerbNest';include __DIR__.'/includes/header.php';
?>
<section class="auth-section"><div class="auth-card"><span class="eyebrow">CUSTOMER PORTAL</span><h1>Good to see you.</h1><p>Sign in to shop and view your orders.</p><?php if($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-stack"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Username or email<input name="login" required></label><label>Password<input type="password" name="password" required></label><button class="button">Sign in</button></form><p class="auth-foot">New here? <a href="register.php">Create an account</a></p></div></section>
<?php include __DIR__.'/includes/footer.php'; ?>
