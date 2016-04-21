<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Gestion des utilisateurs</h1>
    </div>
</div>

<?php
\Core\Session\Session::flash();
?>

<p>
    <a href="?p=admin.users.add" class="btn btn-success">Ajouter</a>
</p>

<div class="table-responsive">
    <table class="table table-striped table-condensed">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $user) : ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->lastName; ?></td>
                <td><?= $user->firstName; ?></td>
                <td>
                    <a class="btn btn-primary" href="?p=admin.users.edit&id=<?= $user->id; ?>">Editer</a>
                    <form action="?p=admin.users.delete" method="post" style="display: inline;">
                        <input type="hidden" name="id" value="<?= $user->id ?>">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
