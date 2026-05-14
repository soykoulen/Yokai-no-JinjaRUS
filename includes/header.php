<?php
// includes/header.php
session_start();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yokai no Jinja - Святилище мифов</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Cinza:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="bg-overlay"></div>
    <div class="fog-layer"></div>
    <div class="particles"></div>
    
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <div class="torii-icon"></div>
                <h1><span>Yokai</span> no Jinja</h1>
            </div>
            <nav class="nav">
                <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Главная</a>
                <a href="kami.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'kami.php' ? 'active' : ''; ?>">Ками</a>
                <a href="creatures.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'creatures.php' ? 'active' : ''; ?>">Ёкаи</a>
                <a href="objects.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'objects.php' ? 'active' : ''; ?>">Артефакты</a>
                <a href="places.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'places.php' ? 'active' : ''; ?>">Святые места</a>
            </nav>
        </div>
    </header>
    
    <main class="main">