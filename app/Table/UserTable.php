<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Table;

use \Core\Table\Table;

/**
 * Description of UserTable
 *
 * @author quentin.hoarau
 */
class UserTable extends Table
{
    
    public function getAllByType($type)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE type = ?", [$type]);
    }
    
}
