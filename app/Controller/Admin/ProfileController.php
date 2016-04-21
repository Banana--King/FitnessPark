<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Admin;

use Core\HTML\BootstrapForm;
use Core\Session\Session;

/**
 * Description of ProfileController
 *
 * @author quentin.hoarau
 */
class ProfileController extends AppController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }
    
    
    /**
     * Affiche la page de profil de l'administrateur
     */
    public function index()
    {
        $item = $this->User->find($_SESSION['auth']);
        
        $form = new BootstrapForm($item);
        $this->render('admin.profile.index', compact('item', 'form'));
    }
    
    public function mdp()
    {
        $item = $this->User->find($_SESSION['auth']);
        $form = new BootstrapForm();
        
        if( !empty($_POST) ){
            extract($_POST);
            if(
                $actual_pass === '' ||
                $new_pass === '' ||
                $new_pass2 === ''
            ){
                Session::setFlash('Tous les champs doivent être remplis', 'warning');
            } elseif( $new_pass != $new_pass2 ){
                Session::setFlash('Le nouveau mot de passe et la confirmation ne sont pas identiques', 'warning');
            } elseif( $item->password != sha1($actual_pass) ){
                Session::setFlash('Erreur lors du changement de mot de passe...', 'danger');
            } else {
                Session::setFlash('Votre mot de passe a bien été modifié', 'success');
                $result = $this->User->update($item->id, [
                    'password' => sha1($new_pass),
                ]);
                $this->index();
            }
        }
        
        $this->render('admin.profile.mdp', compact('item', 'form'));
    }
    
}
