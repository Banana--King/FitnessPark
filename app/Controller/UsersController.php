<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Core\HTML\BootstrapForm;
use Core\Auth\DBAuth;
use Core\Session\Session;
use \App;

/**
 * Description of UsersController
 *
 * @author quentin.hoarau
 */
class UsersController extends AppController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('User');
    }
    
    public function login()
    {
        $this->setTemplate('login');
        var_dump($this->template);
        var_dump($_POST);
        $errors = false;
        if( !empty($_POST) ){
            $auth = new DBAuth(App::getInstance()->getDb());
            if($auth->login($_POST['username'], $_POST['password'])){
                header('Location: index.php?p=admin.users.index');
            } else {
                $errors = true;
            }
        }

        $form = new BootstrapForm($_POST);

        $this->render('users.login', compact('form', 'errors'));
    }
    
    public function index()
    {
        $item = $this->User->find(5);
        
        $form = new BootstrapForm($item);
        $this->render('users.index', compact('item', 'form'));
    }
    
    public function updateDescription()
    {
        if( !empty($_POST) ){
            $result = $this->User->update($_POST['id'], [
                'description' => $_POST['description']
            ]);
            
            if($result){
                Session::setFlash("Votre description a bien été modifiée", 'success');
            } else {
                Session::setFlash("Erreur lors de la modification ...", 'danger');
            }
            
            return $this->index();
        }
    }
    
    public function mdp()
    {
        $item = $this->User->find(5);
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
            } elseif( $item->password != $actual_pass ){
                Session::setFlash('Erreur lors du changement de mot de passe...', 'danger');
            } else {
                Session::setFlash('Votre mot de passe a bien été modifié', 'success');
                $this->index();
            }
        }
        
        $this->render('users.mdp', compact('item', 'form'));
    }
}
