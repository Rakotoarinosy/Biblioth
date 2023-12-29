<?php 
ob_start();
?>
<form method="POST" action="<?= URL ?>livres/av" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="titre" class="form-label">Titre : </label>
    <input type="text" class="form-control" id="titre" name="titre"   aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="nbPages" class="form-label">Nombre de pages : </label>
    <input type="number" class="form-control" id="nbPages" name="nbPages"   aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
  <label for="image" class="form-label">Image</label>
  <input class="form-control-file" type="file" id="image" multiple name="image">
  </div>
  <button type="submit" class="btn btn-primary">Valider</button>
</form>
<?php 
    $content = ob_get_clean();
    $titre = "Ajout d'un livre";
    require "template.php";
?>