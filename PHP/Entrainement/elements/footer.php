<nav class="navbar fixed-bottom bg-body-tertiary">
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <a class="navbar-brand" href="#">Compteur de vues</a>
      </div>
      <div class="col-4">
        <p>
          <?php 
          require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR  . 'Counter.php';
          $counter = new Counter(dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur');
          $counter->increment();
          $views = $counter->get_count();        
          ?>
          Il y a <?= $views ?> visite<?php if ($views > 1): ?>s<?php endif; ?> sur le site.
        </p>
      </div>
    </div>
  </div>
</nav>
</body>
</html>