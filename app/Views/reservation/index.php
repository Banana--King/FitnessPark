<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$title = "Mes réservations";
if($_SESSION['type'] == "coach"){
    $title = "Mon planning";
}
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $title ?></h1>
    </div>
</div>

<?php
\Core\Session\Session::flash();
?>
<link rel='stylesheet' href='/FitnessPark/public/bower_components/fullcalendar/dist/fullcalendar.css' />

<div id="index-calendar">
</div>

<div id="event-description-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ma réservation</h4>
      </div>
      <div class="modal-body">
        <div id="result"></div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-danger" id="delete-reservation" type="button" class="btn btn-default">Annuler</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<div id="delete-confirmation" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Supprimer ma séance</h4>
      </div>
      <div class="modal-body">
        <div id="result">Etes-vous sûr de vouloir supprimer cette séance ?</div>
      </div>
      <div class="modal-footer">
        <a href="" class="btn btn-danger" id="confirm">Oui</a>
        <button class="btn btn-primary" type="button" class="btn btn-default" data-dismiss="modal">Non</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
