<!DOCTYPE html>
<html lang="en" ng-app="crmApp">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <?php
    include("resources/core/baseLoginCss.php");
  ?>

  <!-- All Angular modules -->
  <script src="public/assets/templates/js/jquery.min.js"></script>
  <script src="public/assets/templates/js/bootstrap.bundle.min.js"></script>

  <script src="public/assets/angular/angular.min.js"></script>
  <script src="public/assets/angular/angular-route.js"></script>
  <script src="public/assets/angular/angular-cookies.js"></script>
  <script src="public/assets/angular/ng-tags.min.js"></script>
  <!-- ============================================================== -->
  <!-- Angular routeur -->
  <script src="routes/router.js"></script>

  <title>Annuaire</title>

</head>

<body>

  <?php
    include("resources/core/coreCssTemplates.php");
  ?>
  <main ng-view></main>

  <!-- Include angular public ressources -->
  <?php

    function getAllRessourcesPublicFile($path)
    {
      $tabPath = [];
      $ignore = array('.', '..', 'cgi-bin', '.DS_Store');
      $files = scandir($path);
      foreach ($files as $file) {
        if (in_array($file, $ignore))
          continue;

        $diretory = rtrim($path, '/') . '/' . $file;
        $file = utf8_encode($file);
        $diretory = utf8_encode($diretory);

        if (is_dir($diretory)) {
          $tabFile[] = $file;
          $tabPath[] = $diretory;
        }
      }

      return array("path" => $tabPath);
    }

    $tabName = getAllRessourcesPublicFile("resources")["path"];
    foreach ($tabName as $value) {
      if ($value !== "resources/core") {
        ?>
            <script src="<?php echo $value; ?>/public/js/app.js?version=<?php echo date('Ymdms'); ?>"></script>
            <link rel="stylesheet" href="<?php echo $value; ?>/public/css/style.css?version=<?php echo date('Ymdms'); ?>">
        <?php
      }
    }
  ?>
</body>

</ng-app=>