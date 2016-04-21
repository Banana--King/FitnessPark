<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core\Session;

/**
 * Description of Session
 *
 * @author quentin.hoarau
 */
class Session
{
    
    public static function setFlash($message, $type = 'danger')
    {
        $_SESSION['flash'] = array(
            "message" => $message,
            "type"    => $type,
        ); 
    }
    
    public static function flash()
    {
        if( isset($_SESSION['flash']) ){
            switch ($_SESSION['flash']['type']){
                case 'success': $icon = 'fa fa-check'; break;
                case 'warning': $icon = 'fa fa-warning'; break;
                case 'danger': $icon = 'fa fa-exclamation-circle'; break;
            }
            ?>
            <div class="alert alert-dismissible alert-<?= $_SESSION['flash']['type'] ?>">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <i class="<?= $icon; ?>"></i> <?= $_SESSION['flash']['message']; ?>
            </div>
            <?php
            unset($_SESSION['flash']);
        }
    }
}
