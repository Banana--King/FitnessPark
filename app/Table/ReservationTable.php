<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Table;

/**
 * Description of ReservationTable
 *
 * @author quentin.hoarau
 */
class ReservationTable extends \Core\Table\Table
{
    public function allByUserId($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id_customer = ?", [$id]);
    }
    
    public function allByCoachId($id)
    {
        return $this->query("SELECT * FROM {$this->table} WHERE id_coach = ?", [$id]);
    }
}
