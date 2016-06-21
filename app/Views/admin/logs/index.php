<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="row">
    <div class="col-lg-12">
    <h1 class="page-header">Gestion des logs</h1>
    </div>
</div>

<div class="dataTable_wrapper">
    <table class="table table-striped table-condensed fitnesspark-datatable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($items as $log) : ?>
            <tr>
                <td><?= $log->id; ?></td>
                <td><?= $log->userId; ?></td>
                <td><?= $log->message; ?></td>
                <td><?= $log->date; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>