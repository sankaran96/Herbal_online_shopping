<?php
require_once __DIR__ . '/includes/functions.php';
$error='';
if ($_SERVER['REQUEST_METHOD']==='POST') {
 verify_csrf();
 $name=trim($_POST['name']??''); $email=strtolower(trim($_POST['email']??'')); $username=trim($_POST['username']??''); $password=$_POST['password']??'';
 if ($name==='' || !filter_var($email,FILTER_VALIDATE_EMAIL) || $username==='' || strlen($password)<8) $error='Enter valid details. Password must contain at least 8 characters.';
 else {
  try {
   $stmt=$pdo->prepare("INSERT INTO customers(name,email,username,password_hash) VALUES(?,?,?,?)");
   $stmt->execute([$name,$email,$username,password_hash($password,PASSWORD_DEFAULT)]);
   $_SESSION['customer_id']=(int)$pdo->lastInsertId(); $_SESSION['customer_name']=$name;
   header('Location: products.php'); exit;
  } catch(PDOException $e) { $error='Email or username is already registered.'; }
 }
}
$pageTitle='Create account | HerbNest'; include __DIR__.'/includes/header.php';
?>
<section class="auth-section"><div class="auth-card"><span class="eyebrow">WELCOME TO HERBNEST</span><h1>Create your account</h1><p>Save your details and keep track of your orders.</p><?php if($error): ?><div class="alert"><?= e($error) ?></div><?php endif; ?>
<form method="post" class="form-stack"><input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>"><label>Full name<input name="name" required></label><label>Email address<input type="email" name="email" required></label><label>Username<input name="username" required></label><label>Password<input type="password" name="password" minlength="8" required></label><button class="button">Create account</button></form><p class="auth-foot">Already registered? <a href="login.php">Sign in</a></p></div></section>
<?php include __DIR__.'/includes/footer.php'; ?>
