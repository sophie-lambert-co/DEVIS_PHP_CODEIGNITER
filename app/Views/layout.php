<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
     <!-- Intégration du fichier CSS personnalisé -->
     <link rel="stylesheet" type="text/css" href="../custom.css">
</head>
<body>
    <?= view('shared/header') ?>
    <?= view('shared/navbar') ?>
    <?= $content?>
    <?= view('shared/footer') ?>
</body>
</html>