<?php 
ob_start();
?>

Ici la pages d'accueil

<?php 
    $content = ob_get_clean();
    $titre = "Bibiliothéque MGA";
    require "template.php";
?>