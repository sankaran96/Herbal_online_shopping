<?php
require_once __DIR__ . '/includes/functions.php';
$pageTitle='Herb guide | HerbNest';
$guides=$pdo->query("SELECT name,category,short_description,description,image_url FROM herbs WHERE is_active=1 ORDER BY name")->fetchAll();
include __DIR__.'/includes/header.php';
?>
<section class="page-intro"><span class="eyebrow">THE HERB GUIDE</span><h1>Know your<br><em>botanicals.</em></h1><p>A simple reference to the herbs in our collection, including descriptions and everyday storage notes.</p></section>
<section class="section section-top"><div class="guide-grid"><?php foreach($guides as $g): ?><article class="guide-card"><img src="<?= e($g['image_url']) ?>" alt="<?= e($g['name']) ?>"><div><span class="eyebrow"><?= e($g['category']) ?></span><h3><?= e($g['name']) ?></h3><p><?= e($g['description']) ?></p></div></article><?php endforeach; ?></div><p class="disclaimer">Educational information only. Herbs may interact with medicines or be unsuitable for some people. Ask a qualified healthcare professional before using herbs for health purposes.</p></section>
<?php include __DIR__.'/includes/footer.php'; ?>
