<?php 
ob_start();
?>

<form method="POST" action="<?= URL ?>livres/mv" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="titre" class="form-label">Titre : </label>
    <input type="text" class="form-control" id="titre" name="titre" value="<?= $livre->getTitre(); ?>">
  </div>
  <div class="mb-3">
    <label for="nbPages" class="form-label">Nombre de pages : </label>
    <input type="number" class="form-control" id="nbPages" name="nbPages" value="<?= $livre->getNbPages(); ?>">
  </div>
  <h3>Images : </h3>
  <img src="<?= URL ?>public/images/<?= $livre->getImage(); ?>" alt="">
  <div class="mb-3">
  <label for="image" class="form-label">Image</label>
  <input class="form-control-file" type="file" id="image" multiple name="image">
  </div>
  <input type="hidden" name="identifiant" value="<?= $livre->getId(); ?>">
  <button type="submit" class="btn btn-primary">Valider</button>
</form>

<?php 
    $content = ob_get_clean();
    $titre = "Modification du livre : ".$livre->getId();
    require "template.php";
?>