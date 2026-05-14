<?php
// index.php
require_once 'config/database.php';
require_once 'includes/header.php';

// Получаем статистику
$stats = [];
$stmt = $pdo->query("SELECT COUNT(*) as count FROM creatures");
$stats['creatures'] = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM deity");
$stats['deities'] = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM object");
$stats['objects'] = $stmt->fetch()['count'];

$stmt = $pdo->query("SELECT COUNT(*) as count FROM place");
$stats['places'] = $stmt->fetch()['count'];
?>

<div class="hero">
    <div class="hero-content">
        <h2 class="hero-title">Святилище<br><span>японской мифологии</span></h2>
        <p class="hero-subtitle">Путешествие сквозь туман времени, где обитают боги и демоны</p>
    </div>
    <div class="hero-decoration">
        <div class="shimenawa"></div>
    </div>
</div>

<div class="shrine-map">
    <div class="map-container">
        <div class="gate gate-kami" data-page="kami.php">
            <div class="gate-torii">
                <div class="torii-beam top"></div>
                <div class="torii-beam middle"></div>
                <div class="torii-pillars">
                    <div class="pillar left"></div>
                    <div class="pillar right"></div>
                </div>
            </div>
            <div class="gate-info">
                <h3>Врата Ками</h3>
                <p>Боги синтоизма — хранители небес и земли</p>
                <span class="counter"><?php echo $stats['deities']; ?> божеств</span>
            </div>
        </div>
        
        <div class="gate gate-creatures" data-page="creatures.php">
            <div class="forest-gate">
                <div class="tree-shadow"></div>
                <div class="shrine-lantern"></div>
            </div>
            <div class="gate-info">
                <h3>Тёмный лес</h3>
                <p>Ёкаи — духи и демоны японских легенд</p>
                <span class="counter"><?php echo $stats['creatures']; ?> существ</span>
            </div>
        </div>
        
        <div class="gate gate-objects" data-page="objects.php">
            <div class="crypt-icon"></div>
            <div class="gate-info">
                <h3>Склеп артефактов</h3>
                <p>Проклятые предметы и мистические объекты</p>
                <span class="counter"><?php echo $stats['objects']; ?> артефактов</span>
            </div>
        </div>
        
        <div class="gate gate-places" data-page="places.php">
            <div class="mountain-icon"></div>
            <div class="gate-info">
                <h3>Священные места</h3>
                <p>Где стирается грань между мирами</p>
                <span class="counter"><?php echo $stats['places']; ?> локаций</span>
            </div>
        </div>
    </div>
</div>

<div class="legend-section">
    <div class="scroll-paper">
        <div class="scroll-content">
            <h3>Добро пожаловать в святилище</h3>
            <p>Здесь, в тумане между мирами, собраны легенды древней Японии. Боги-ками обитают в небесных чертогах, ёкаи бродят в тенистых лесах, а проклятые предметы хранят мрачные тайны. Пройдите сквозь врата тории и откройте для себя мир, где реальность встречается с мифом.</p>
        </div>
    </div>
</div>

<script>
    // Устанавливаем эмбиент для главной страницы
    if(typeof setAmbient === 'function') {
        setAmbient('crickets');
    }
</script>

<?php require_once 'includes/footer.php'; ?>