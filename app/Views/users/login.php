<?php if($errors) : ?>
	<div class="alert alert-danger">Identifiants incorrects</div>
<?php endif; ?>

<form method="post">
	<?= $form->input('username', 'Email'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
	<button class="btn btn-success btn-block">Se connecter</button>
</form>
