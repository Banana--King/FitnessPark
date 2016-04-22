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
 * Description of UserController
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
    
    /**
     * Affiche la page d'index de gestion des Users
     */
    public function index()
    {
        $items = $this->User->all();
        $this->render('admin.users.index', compact('items'));
    }
    
    /**
     * Ajoute un User, sinon affiche un formulaire d'ajout
     * @return mixed \App\Controller\Admin\UsersController->index()
     */
    public function add()
    {
        $types = [
            'admin' => 'admin',
            'coach' => 'coach',
            'customer' => 'customer'
        ];
        
        if (!empty($_POST)) {
            $empty = false;
            foreach($_POST as $key => $value){
                if( $key != 'description' && empty($value) ){
                    $empty = true;
                }
            }
            
            if($empty){
                Session::setFlash("Tous les champs sont obligatoires (sauf description) !", 'warning');
                $form = new BootstrapForm($_POST);
            } elseif( $_POST['password'] != $_POST['password2'] ){
                Session::setFlash("Les mots de passe ne sont pas les mêmes !", 'warning');
                $form = new BootstrapForm($_POST);
            } else {
                $result = $this->User->create([
                    'email' => $_POST['email'],
                    'password' => sha1($_POST['password']),
                    'lastName' => $_POST['lastName'],
                    'firstName' => $_POST['firstName'],
                    'description' => $_POST['description'],
                    'type' => $_POST['type'],
                ]);
                if($result){
                    Session::setFlash("L'utilisateur à bien été ajouté", 'success');
                } else {
                    Session::setFlash("Erreur lors de l'ajout d'un utilisateur...", 'danger');
                }
                return $this->index();
            }
        } else {
            $form = new BootstrapForm();
        }
        
        $this->render('admin.users.add', compact('form', 'types'));
    }
    
    /**
     * Modifie un User, sinon affiche un formulaire de modification
     * @return mixed \App\Controller\Admin\UsersController->index()
     */
    public function edit()
    {
        if (!empty($_POST)) {
            $empty = false;
            foreach($_POST as $key => $value){
                if( $key != 'description' && empty($value) ){
                    $empty = true;
                }
            }
            
            if($empty){
                Session::setFlash("Tous les champs sont obligatoires (sauf description) !", 'warning');
                $form = new BootstrapForm($_POST);
            } else {
                $result = $this->User->update($_GET['id'], [
                    'email' => $_POST['email'],
                    'lastName' => $_POST['lastName'],
                    'firstName' => $_POST['firstName'],
                    'description' => $_POST['description'],
                    'type' => $_POST['type'],
                ]);
                Session::setFlash("L'utilisateur à bien été modifié", 'success');
                if($result){
                    return $this->index();
                }
            }
        }
        
        $types = [
            'admin' => 'admin',
            'coach' => 'coach',
            'customer' => 'customer'
        ];
        $user = $this->User->find($_GET['id']);
        $form = new BootstrapForm($user);

        $this->render('admin.users.edit', compact('form', 'types'));
    }
    
    /**
     * Supprime un User
     * @return mixed \App\Controller\Admin\UsersController->index()
     */
    public function delete()
    {
        if (!empty($_POST)) {
            $result = $this->User->delete($_POST['id']);
            Session::setFlash("L'utilisateur à bien été supprimé", 'success');
            return $this->index();
        }
    }
    
}
