<?php
// creatures.php
require_once 'config/database.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM creatures ORDER BY id LIMIT 50");
$creatures = $stmt->fetchAll();
?>

<div class="page-header">
    <h1 class="page-title">Ёкаи</h1>
    <p class="page-subtitle">Духи, демоны и существа японского фольклора</p>
</div>

<div class="card-grid">
    <?php foreach($creatures as $creature): ?>
    <div class="card">
        <div class="card-content">
            <h3><?php echo htmlspecialchars($creature['name']); ?></h3>
            <div class="card-kanji"><?php echo htmlspecialchars($creature['name_kanji']); ?></div>
            <div class="card-type"><?php echo htmlspecialchars($creature['type']); ?></div>
            <p class="card-desc"><?php echo htmlspecialchars(mb_substr($creature['desc'], 0, 120)) . '...'; ?></p>
            <a href="details.php?type=creature&id=<?php echo $creature['id']; ?>" class="card-link">Прочитать легенду →</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>setAmbient('forest');</script>

<?php require_once 'includes/footer.php'; ?>