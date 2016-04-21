<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller\Admin;

/**
 * Description of LogController
 *
 * @author quentin.hoarau
 */
class LogsController extends AppController
{
    
    public function __construct()
    {
        parent::__construct();
        $this->loadModel('Log');
    }
    
    public function index()
    {
        $items = $this->Log->all();
        $this->render('admin.logs.index', compact('items'));
    }
    
}
