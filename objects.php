<?php
// objects.php
require_once 'config/database.php';
require_once 'includes/header.php';

$stmt = $pdo->query("
    SELECT o.*, os.story 
    FROM object o 
    LEFT JOIN object_story os ON o.story_id_o = os.id 
    ORDER BY o.id
");
$objects = $stmt->fetchAll();
?>

<div class="page-header">
    <h1 class="page-title">Мистические объекты</h1>
    <p class="page-subtitle">Проклятые артефакты и предметы силы</p>
</div>

<div class="card-grid">
    <?php foreach($objects as $object): ?>
    <div class="card">
        <div class="card-content">
            <h3><?php echo htmlspecialchars($object['object_name']); ?></h3>
            <p class="card-desc"><?php echo htmlspecialchars(mb_substr($object['desc'], 0, 120)) . '...'; ?></p>
            <a href="details.php?type=object&id=<?php echo $object['id']; ?>" class="card-link">Исследовать артефакт →</a>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>setAmbient('mystery');</script>

<?php require_once 'includes/footer.php'; ?>