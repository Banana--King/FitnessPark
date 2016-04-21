<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Changement de mot de passe</h1>
    </div>
</div>

<?php
Core\Session\Session::flash();
?>

<form method="post">
    <?= $form->input('actual_pass', 'Mot de passe actuel'); ?>
    
    <?= $form->input('new_pass', 'Nouveau mot de passe'); ?>
    <?= $form->input('new_pass2', 'Confirmation'); ?>
    <button class="btn btn-primary">Valider</button>
    <a class="btn btn-default" href="index.php?p=users.index">Retour</a>
</form>