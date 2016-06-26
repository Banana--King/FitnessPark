<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<h2><?= $item->firstName." ".$item->lastName ?></h2>

<div class="form-group">
    <label>email: </label>
    <span><?= $item->email ?></span>
</div>

<div class="form-group">
    <label>description: </label>
    <textarea class="form-control" disabled><?= $item->description ?></textarea>
</div>
