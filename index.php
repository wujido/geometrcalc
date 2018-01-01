<?php
spl_autoload_register(function ($class_name) {
    include 'Classes/' . $class_name . '.php';
});
$obrazec = new Obrazec();
$layout = new Layout();
$teleso = new Teleso();


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php
    foreach (glob("css/*.css") as $css) {
        echo "<link type='text/css' rel='stylesheet' href='$css'>\n";
    }
    foreach (glob("js/*.js") as $js) {
        echo "<script type='text/javascript' src='$js'></script>\n";
    }
    ?>
    <title>Výpočet hodnot geometrických těles</title>
  </head>
  <body>
    <div class="body-container">
<header id="main-header">
        <?php include 'layout/header.html'; ?>
  </header>
      <div class="content-container">
  <section id="section">
      <div class="section-container">
        <?php
          $path = 'site/';
          if (isset($_GET['folder'])) {
              $path = $path . $_GET['folder'] . '/';
          }

          if (isset($_GET['site'])) {
              $page = $_GET['site'];
          } else {
              $page='default';
          }

          if (preg_match('/^[a-z0-9]+$/', $page)) {
              if (isset($page)) {
                  if (file_exists($path . $page . '.php')) {
                      $vlozeno = include $path . $page . '.php';
                  } else {
                      $vlozeno = false;
                  }
              }
          }
          if (!$vlozeno) {
              include('layout/nenalezeno.html');
          }
          ?>
      </div>
    </section>
      </div>


    <footer id="footer">
    <?php include 'layout/footer.php'; ?>
    </footer>
    </div>

  </body>
</html>
