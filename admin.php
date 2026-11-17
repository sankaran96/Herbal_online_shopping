<?php
require_once __DIR__ . '/includes/functions.php';
if(!empty($_SESSION['admin_id'])){header('Location: admin/dashboard.php');exit;}
$error='';
if($_SERVER['REQUEST_METHOD']==='POST'){verify_csrf();$username=trim($_POST['username']??'');$password=$_POST['password']??'';$st=$pdo->prepare("SELECT * FROM admins WHERE username=? LIMIT 1");$st->execute([$username]);$a=$st->fetch();if($a&&password_verify($password,$a['password_hash'])){session_regenerate_id(true);$_SESSION['admin_id']=(int)$a['id'];$_SESSION['admin_name']=$a['name'];header('Location: admin/dashboard.php');exit;}$error='Admin username or password is incorrect.';}
$pageTitle='Admin sign in | HerbNest';include __DIR__.'/includes/header.php';
?>
<section class="auth-section"><div class="auth-card"><span class="eyebrow">ADMINISTRATION</span><h1>Admin sign in</h1><p>Manage the herb catalogue and customer orders.</p><?php if($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?><form method="post" class="form-stack"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Admin username<input name="username" required></label><label>Password<input type="password" name="password" required></label><button class="button">Open dashboard</button></form><p class="auth-foot"><a href="index.php">← Back to store</a></p></div></section>
<?php include __DIR__.'/includes/footer.php'; ?>
