<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'Shop herbs | HerbNest';
$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM herbs WHERE is_active=1";
$params = [];
if ($q !== '') { $sql .= " AND (name LIKE ? OR category LIKE ?)"; $params = ["%$q%", "%$q%"]; }
$sql .= " ORDER BY name";
$stmt = $pdo->prepare($sql); $stmt->execute($params); $herbs = $stmt->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<section class="page-intro"><span class="eyebrow">THE COLLECTION</span><h1>Find your everyday<br><em>botanical.</em></h1><p>Browse the collection and choose what suits your kitchen and routine.</p></section>
<section class="section section-top">
 <form class="search-form" method="get"><input name="q" value="<?= e($q) ?>" placeholder="Search herbs or categories"><button class="button" type="submit">Search</button></form>
 <div class="product-grid">
 <?php foreach ($herbs as $item): ?>
 <article class="product-card">
  <a class="product-image" href="product-details.php?id=<?= (int)$item['id'] ?>"><img src="<?= e($item['image_url']) ?>" alt="<?= e($item['name']) ?>"><span class="image-tag"><?= e($item['category']) ?></span></a>
  <div class="product-info"><div><h3><?= e($item['name']) ?></h3><p><?= e($item['short_description']) ?></p></div><strong><?= money((float)$item['price']) ?></strong></div>
  <a class="card-link" href="product-details.php?id=<?= (int)$item['id'] ?>">View details <span>↗</span></a>
 </article>
 <?php endforeach; ?>
 <?php if (!$herbs): ?><p>No products found. Try another search.</p><?php endif; ?>
 </div>
</section>
<?php include __DIR__ . '/includes/footer.php'; ?>
