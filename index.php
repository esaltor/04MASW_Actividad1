<?php
require_once __DIR__ . '/controllers/PlatformController.php';
require_once __DIR__ . '/controllers/DirectorController.php';
require_once __DIR__ . '/controllers/ActorController.php';
require_once __DIR__ . '/controllers/LanguageController.php';
require_once __DIR__ . '/controllers/SeriesController.php';

$routes = [
    'platform' => [
        'list' => 'views/Platform/list.php',
        'create' => 'views/Platform/create.php',
        'edit' => 'views/Platform/edit.php',
        'delete' => 'views/Platform/delete.php',
    ],
    'director' => [
        'list' => 'views/Director/list.php',
        'create' => 'views/Director/create.php',
        'edit' => 'views/Director/edit.php',
        'delete' => 'views/Director/delete.php',
    ],
    'actor' => [
        'list' => 'views/Actor/list.php',
        'create' => 'views/Actor/create.php',
        'edit' => 'views/Actor/edit.php',
        'delete' => 'views/Actor/delete.php',
    ],
    'language' => [
        'list' => 'views/Language/list.php',
        'create' => 'views/Language/create.php',
        'edit' => 'views/Language/edit.php',
        'delete' => 'views/Language/delete.php',
    ],
    'series' => [
        'list' => 'views/Series/list.php',
        'create' => 'views/Series/create.php',
        'edit' => 'views/Series/edit.php',
        'delete' => 'views/Series/delete.php',
    ],
];

$controller = isset($_GET['controller']) ? strtolower($_GET['controller']) : '';
$action = isset($_GET['action']) ? strtolower($_GET['action']) : '';
$viewFile = null;

if ($controller && $action && isset($routes[$controller][$action])) {
    $candidate = __DIR__ . '/' . $routes[$controller][$action];
    if (is_file($candidate)) {
        $viewFile = $candidate;
    }
}

$pageTitle = $viewFile ? ucfirst($controller) . ' - ' . ucfirst($action) : 'Biblioteca de series';
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?php echo htmlspecialchars($pageTitle, ENT_QUOTES, 'UTF-8'); ?></title>
  <link rel="stylesheet" href="assets/styles.css" />
</head>
<body>
  <div class="container">
    <header>
      <h1>Biblioteca de series</h1>
      <nav class="nav" aria-label="Secciones">
        <a href="index.php">Home</a>
        <a href="index.php?controller=platform&action=list">Plataformas</a>
        <a href="index.php?controller=director&action=list">Directores</a>
        <a href="index.php?controller=actor&action=list">Actores</a>
        <a href="index.php?controller=language&action=list">Idiomas</a>
        <a href="index.php?controller=series&action=list">Series</a>
      </nav>
    </header>

    <main>
      <?php if ($viewFile): ?>
        <?php include $viewFile; ?>
      <?php else: ?>
        <p>Home basica para acceder a las secciones de la aplicacion.</p>
        <section class="grid" aria-label="Secciones">
          <a class="card" href="index.php?controller=platform&action=list">
            <h2>Plataformas</h2>
            <span>Gestion de plataformas</span>
          </a>
          <a class="card" href="index.php?controller=director&action=list">
            <h2>Directores</h2>
            <span>Gestion de directores</span>
          </a>
          <a class="card" href="index.php?controller=actor&action=list">
            <h2>Actores</h2>
            <span>Gestion de actores</span>
          </a>
          <a class="card" href="index.php?controller=language&action=list">
            <h2>Idiomas</h2>
            <span>Gestion de idiomas</span>
          </a>
          <a class="card" href="index.php?controller=series&action=list">
            <h2>Series</h2>
            <span>Gestion de series</span>
          </a>
        </section>
      <?php endif; ?>
    </main>
  </div>
</body>
</html>
