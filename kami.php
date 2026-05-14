<?php
// kami.php
require_once 'config/database.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM deity ORDER BY id LIMIT 30");
$deities = $stmt->fetchAll();
?>

<div class="page-header">
    <h1 class="page-title">Ками</h1>
    <p class="page-subtitle">Небесные божества синтоизма</p>
</div>

<div class="card-grid">
    <?php foreach($deities as $deity): ?>
    <div class="card">
        <div class="card-content">
            <h3><?php echo htmlspecialchars($deity['kami']); ?></h3>
            <div class="card-kanji"><?php echo htmlspecialchars($deity['name_kanji']); ?></div>
            <div class="card-type"><?php echo htmlspecialchars($deity['domain']); ?></div>
            <p class="card-desc"><?php echo htmlspecialchars(mb_substr($deity['desc'], 0, 120)) . '...'; ?></p>
            <a href="details.php?type=kami&id=<?php echo $deity['id']; ?>" class="card-link">Узнать историю →</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>setAmbient('temple');</script>

<?php require_once 'includes/footer.php'; ?>