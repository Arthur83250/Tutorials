<h1>Ma home page</h1>
<h2>bah alors</h2>
<a href="<?= $router->generate('contact'); ?>">Nous contacter</a>
<a href="<?= $router->generate('article', ['id' => 60, 'slug' => 'text']); ?>">Article</a>

<?php ob_start(); ?>
<script>alert('Salut')</script>
<?php $pageJavascript = ob_get_clean(); ?>