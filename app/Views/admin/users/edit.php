<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Ajouter ou modifier un utilisateur</h1>
    </div>
</div>

<form method="post">
    <?= $form->input('email', 'Email', ['type' => 'email']); ?>
    <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
    <?= $form->input('lastName', 'Nom'); ?>
    <?= $form->input('firstName', 'Prénom'); ?>
    <?= $form->input('description', 'Description', ['type' => 'textarea']); ?>
    
    <?= $form->select('type', 'Type', $types); ?>
    <button class="btn btn-primary">Sauvegarder</button>
    <a class="btn btn-default" href="index.php?p=admin.users.index">Retour</a>
</form>