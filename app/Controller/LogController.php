<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of LogController
 *
 * @author quentin.hoarau
 */
class LogController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Log');
    }
    
    public function add($message)
    {        
        $result = $this->Log->create([
            'userId' => $_SESSION['auth'],
            'message' => $_POST['lastName']
        ]);
    }
    
}
