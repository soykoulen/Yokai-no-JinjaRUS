<?php
// places.php
require_once 'config/database.php';
require_once 'includes/header.php';

$stmt = $pdo->query("SELECT * FROM place ORDER BY id");
$places = $stmt->fetchAll();
?>

<div class="page-header">
    <h1 class="page-title">Священные места</h1>
    <p class="page-subtitle">Где стирается грань между мирами</p>
</div>

<div class="card-grid">
    <?php foreach($places as $place): ?>
    <div class="card">
        <div class="card-content">
            <h3><?php echo htmlspecialchars($place['place_name']); ?></h3>
            <p class="card-desc"><?php echo htmlspecialchars(mb_substr($place['desc'], 0, 120)) . '...'; ?></p>
            <a href="details.php?type=place&id=<?php echo $place['id']; ?>" class="card-link">Посетить место →</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>setAmbient('mystery');</script>

<?php require_once 'includes/footer.php'; ?>