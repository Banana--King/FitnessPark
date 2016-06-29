<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">Nouvelle reservation</h1>
    </div>
</div>

<?php
\Core\Session\Session::flash();
?>

<div id="message"></div>

<link rel='stylesheet' href='/FitnessPark/public/bower_components/fullcalendar/dist/fullcalendar.css' />

<form action="index.php?p=reservation.add" method="POST">
    <div class="row">
        <div class="col-md-6">      
            <div class="form-group">
                <label>Type de séance</label>
                <select class="form-control" id="type_seance" name="type_seance">
                    <option>Cardio</option>
                    <option>Renforcement musculaire</option>
                    <option>Yoga</option>
                </select>
            </div>

            <div class="form-group">
                <label>Coach</label>
                <select class="form-control" id="coach" name="coach">
                    <?php foreach($coaches as $coach) { ?>
                    <option value="<?= $coach->id; ?>"><?= $coach->firstName." ".$coach->lastName; ?></option>
                    <?php } ?>
                </select>
            </div>

            <div class="form-group">
                <label>Difficulté</label>
                <div class="radio">
                    <label>
                    <input id="level1" type="radio" checked="" value="1" name="level">
                    Débutant
                    </label>
                </div>
                <div class="radio">
                    <label>
                    <input id="level2" type="radio" value="2" name="level">
                    Intermédiaire
                    </label>
                </div>
                <div class="radio">
                    <label>
                    <input id="level3" type="radio" value="3" name="level">
                    Avancé
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Adresse (à vérifier pour valider la réservation)</label>
                <div class="input-group">
                    <input id="address" type="text" class="form-control" name="address">
                    <span class="input-group-btn">
                        <button id="address-validation" class="btn btn-default" type="button">
                            <i class="fa fa-map-marker"></i>
                        </button>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label>Plage Hoaraire</label>
                <input id="daterange" class="form-control" type="text" placeholder="Plage hoaraire" name="daterange">
            </div>
        </div>
        
        <div class="col-md-6">
            <div id="reservation-map" style="height: 425px;"></div>
        </div>
    </div>
    
    <button class="btn btn-primary">Valider</button>
    <a class="btn btn-default" href="index.php?p=reservation.index">Annuler</a>
</form>

<div id="daterange-modal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Plage Hoaraire</h4>
      </div>
      <div class="modal-body">
        <div id='reservation-calendar'></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
