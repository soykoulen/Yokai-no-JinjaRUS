<?php
// details.php
require_once 'config/database.php';
require_once 'includes/header.php';

$type = $_GET['type'] ?? '';
$id = (int)($_GET['id'] ?? 0);

$title = '';
$name = '';
$kanji = '';
$description = '';
$story = '';
$extraInfo = [];

switch($type) {
    case 'kami':
        $stmt = $pdo->prepare("SELECT * FROM deity WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        if ($item) {
            $title = 'Ками';
            $name = $item['kami'];
            $kanji = $item['name_kanji'];
            $description = $item['desc'];
            
            $stmtStory = $pdo->prepare("SELECT * FROM story_deity WHERE id = ?");
            $stmtStory->execute([$item['story_id']]);
            $storyItem = $stmtStory->fetch();
            $story = $storyItem['story'] ?? '';
            
            $extraInfo = [
                'Сфера влияния' => $item['domain']
            ];
        }
        break;
        
    case 'creature':
        $stmt = $pdo->prepare("SELECT * FROM creatures WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        if ($item) {
            $title = 'Ёкай / Юрей';
            $name = $item['name'];
            $kanji = $item['name_kanji'];
            $description = $item['desc'];
            
            $stmtStory = $pdo->prepare("SELECT * FROM story WHERE id = ?");
            $stmtStory->execute([$item['story_id']]);
            $storyItem = $stmtStory->fetch();
            $story = $storyItem['story'] ?? '';
            
            $extraInfo = [
                'Тип' => $item['type'],
                'Обитание' => $item['habitat']
            ];
        }
        break;
        
    case 'object':
        $stmt = $pdo->prepare("
            SELECT o.*, os.story, os.o_story_name 
            FROM object o 
            LEFT JOIN object_story os ON o.story_id_o = os.id 
            WHERE o.id = ?
        ");
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        if ($item) {
            $title = 'Мистический объект';
            $name = $item['object_name'];
            $description = $item['desc'];
            $story = $item['story'] ?? '';
        }
        break;
        
    case 'place':
        $stmt = $pdo->prepare("SELECT * FROM place WHERE id = ?");
        $stmt->execute([$id]);
        $item = $stmt->fetch();
        if ($item) {
            $title = 'Священное место';
            $name = $item['place_name'];
            $description = $item['desc'];
            
            $extraInfo = [
                'География' => $item['geo'],
                'Климат' => $item['climate']
            ];
        }
        break;
}

if (!$item): ?>
    <div class="error-message">
        <h2>Сущность не найдена</h2>
        <p>Возможно, дух растворился в тумане...</p>
        <a href="index.php" class="back-button">← Вернуться в святилище</a>
    </div>
<?php else: ?>
<div class="detail-container">
    <div class="detail-header">
        <h1 class="detail-name"><?php echo htmlspecialchars($name); ?></h1>
        <?php if($kanji): ?>
        <div class="detail-kanji"><?php echo htmlspecialchars($kanji); ?></div>
        <?php endif; ?>
        <div class="detail-type"><?php echo $title; ?></div>
    </div>
    
    <div class="detail-card">
        <?php foreach($extraInfo as $key => $value): ?>
        <div class="detail-section">
            <h4><?php echo $key; ?></h4>
            <p><?php echo nl2br(htmlspecialchars($value)); ?></p>
        </div>
        <?php endforeach; ?>
        
        <?php if($description): ?>
        <div class="detail-section">
            <h4>Описание</h4>
            <p><?php echo nl2br(htmlspecialchars($description)); ?></p>
        </div>
        <?php endif; ?>
        
        <?php if($story): ?>
        <div class="detail-section">
            <h4>Легенда</h4>
            <div class="detail-story"><?php echo nl2br(htmlspecialchars($story)); ?></div>
        </div>
        <?php endif; ?>
    </div>
    
    <a href="javascript:history.back()" class="back-button">← Вернуться назад</a>
</div>

<script>
    <?php
    if($type == 'kami') echo "setAmbient('temple');";
    elseif($type == 'creature') echo "setAmbient('forest');";
    else echo "setAmbient('mystery');";
    ?>
</script>

<?php endif; ?>

<?php require_once 'includes/footer.php'; ?>