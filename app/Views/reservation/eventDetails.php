<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<table class="table table-condensed table-hover table-responsive">
    <tbody>
        <tr>
            <th scope="row">Type</th>
            <td><?= $reservation->type ?></td>
        </tr>
        <tr>
            <th scope="row">Niveau</th>
            <td><?= $reservation->level ?></td>
        </tr>
        <tr>
            <th scope="row">Client</th>
            <td><?= $reservation->id_customer->lastName." ".$reservation->id_customer->firstName ?></td>
        </tr>
        <tr>
            <th scope="row">Coach</th>
            <td><?= $reservation->id_coach->lastName." ".$reservation->id_coach->firstName ?></td>
        </tr>
        <tr>
            <th scope="row">Adresse</th>
            <td><?= $reservation->address ?></td>
        </tr>
        <tr>
            <th scope="row">Début</th>
            <td><?= $reservation->start ?></td>
        </tr>
        <tr>
            <th scope="row">Fin</th>
            <td><?= $reservation->end ?></td>
        </tr>
    </tbody>
</table>
