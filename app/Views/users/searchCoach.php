<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Rechercher un coach</h1>
    </div>
</div>

<?php
\Core\Session\Session::flash();
?>

<div class="form-group">
    <label>Coach : </label>
    <select class="form-control" id="coach-selection">
        <option value="">Rechercher un coach</option>
        <?php foreach($items as $coach){ ?>
        <option value="<?= $coach->id ?>"><?= $coach->firstName." ".$coach->lastName ?></option>
        <?php } ?>
    </select>
</div>

<br>

<div id="coach-result"></div>