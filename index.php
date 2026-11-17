<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle = 'HerbNest | Natural living, thoughtfully sourced';
$featured = $pdo->query("SELECT * FROM herbs WHERE is_active=1 ORDER BY id DESC LIMIT 4")->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<section class="hero">
 <div class="hero-copy">
  <span class="eyebrow">THE BOTANICAL MARKET</span>
  <h1>A little more<br><em>nature</em> in your day.</h1>
  <p>Explore thoughtfully selected herbs, roots and botanical essentials for your everyday pantry.</p>
  <div class="hero-actions"><a class="button" href="products.php">Explore the collection <span>↗</span></a><a class="text-link" href="usage.php">Know your herbs</a></div>
  <div class="hero-note"><span class="note-line"></span><span>Simple ingredients. Clear information. Careful choices.</span></div>
 </div>
 <div class="hero-photo"><img src="https://images.unsplash.com/photo-1518977676601-b53f82aba655?auto=format&fit=crop&w=1100&q=85" alt="Fresh herbs and botanical ingredients"><div class="photo-caption">Grown close to nature <b>01 / 03</b></div></div>
</section>
<section class="trust-strip"><span>✳ Carefully selected botanicals</span><span>✳ Clear product information</span><span>✳ Easy online ordering</span></section>
<section class="section">
 <div class="section-heading"><div><span class="eyebrow">A FEW GOOD THINGS</span><h2>Shop the favourites</h2></div><a class="text-link" href="products.php">View all herbs ↗</a></div>
 <div class="product-grid">
 <?php foreach ($featured as $item): ?>
  <article class="product-card">
   <a class="product-image" href="product-details.php?id=<?= (int)$item['id'] ?>"><img src="<?= e($item['image_url']) ?>" alt="<?= e($item['name']) ?>"><span class="image-tag"><?= e($item['category']) ?></span></a>
   <div class="product-info"><div><h3><?= e($item['name']) ?></h3><p><?= e($item['short_description']) ?></p></div><strong><?= money((float)$item['price']) ?></strong></div>
   <a class="card-link" href="product-details.php?id=<?= (int)$item['id'] ?>">View product <span>↗</span></a>
  </article>
 <?php endforeach; ?>
 </div>
</section>
<section class="guide-band"><div><span class="eyebrow">LEARN BEFORE YOU CHOOSE</span><h2>Get to know what<br>goes into your basket.</h2><p>Read simple descriptions, storage notes and general usage information for each botanical.</p><a class="button button-light" href="usage.php">Read the herb guide</a></div><img src="https://images.unsplash.com/photo-1547887538-e3a2f32cb1cc?auto=format&fit=crop&w=900&q=85" alt="Dried botanical herbs in glass jars"></section>
<?php include __DIR__ . '/includes/footer.php'; ?>
