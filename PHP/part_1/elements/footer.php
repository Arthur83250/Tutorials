<main>
  </div><!-- /.container -->
  <!-- FOOTER -->
  <hr>   
  <footer class="container">    
    <div class="row">
      <div class="col-md-4">        
        <!-- FORMULAIRE NEWSLETTER -->
        <form action="/newsletter.php" method="post" class="form-inline">
          <div class="form-group">
              <input type="email" name="email" placeholder="Entre votre email" required class="form-control">
          </div><br>
          <button type="submit" class="btn btn-primary">S'inscrire</button>
        </form>
        <br>
        <!-- FIN FORMULAIRE NEWSLETTER -->
      </div>
      <div class="col-md-4">
        <h5>Navigation</h5>
          <ul class="list-unstyled text-small">
            <?= nav_menu(); ?>
          </ul>
      </div>
      <div class="col-md-4">
        <?php               
          require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'DoubleCompteur.php';
          $compteur= new DoubleCompteur(dirname(__DIR__). DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur');
          $compteur->incrementer();
          $vues = $compteur->recuperer();
        ?>
        <h5>Compteur de vue<?php if ($vues > 1): ?>s<?php endif ?></h5>
        <p>Nombre de pages vues :       
          <?= $vues ?>
        </p>
      </div>
    </div>
 </footer>
</main>
    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>


    

      