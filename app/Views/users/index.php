<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Mon Profil</h1>
    </div>
</div>

<?php
\Core\Session\Session::flash();
?>

<label>Username : </label>
<?= $item->username ?>

<br>

<a href="index.php?p=users.mdp">Changer de mot de passe</a>

<form action="index.php?p=users.updateDescription" method="post">
    <?= $form->input('id', '', ['type' => 'hidden']); ?>
    <?= $form->input('description', 'Description', ['type' => 'textarea']); ?>
    <button class="btn btn-primary">Sauvegarder</button>
</form>

