<?php $titre = "Profil";
ob_start();
?>
<h1>Coucou</h1>
<?php $contenu = ob_get_clean(); ?>

<?php require 'gabarit.php'; ?>