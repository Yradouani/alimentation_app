<?php $titre = "Accueil";
ob_start();
?>

<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>