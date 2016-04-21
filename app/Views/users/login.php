<?php if($errors) : ?>
	<div class="alert alert-danger">Identifiants incorrects</div>
<?php endif; ?>

<form method="post">
	<?= $form->input('username', 'Pseudo'); ?>
	<?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
	<button class="btn btn-success btn-block">Se connecter</button>
</form>
        
<!-- <form role="form">
    <fieldset>
        <div class="form-group">
            <input class="form-control" placeholder="Nom" name="lastName" type="text" autofocus>
        </div>
        <div class="form-group">
            <input class="form-control" placeholder="Prenom" name="firstName" type="text" value="">
        </div>
        <div class="checkbox">
            <label>
                <input name="remember" type="checkbox" value="Remember Me">Remember Me
            </label>
        </div>
        <!-- Change this to a button or input when using this as a form -->
        <!-- <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a>
    </fieldset>
</form> -->
