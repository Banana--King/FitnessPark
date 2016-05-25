<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mon Profil (admin)</h1>
    </div>
</div>

<?php
\Core\Session\Session::flash();
?>

<label>Username : </label>
<?= $item->email ?>

<br>

<a href="index.php?p=admin.profile.mdp">Changer de mot de passe</a>

<form action="index.php?p=admin.profile.updateDescription" method="post">
    <?= $form->input('id', '', ['type' => 'hidden']); ?>
    <?= $form->input('description', 'Description', ['type' => 'textarea']); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>

