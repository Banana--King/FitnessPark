<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

use Core\Session\Session;

/**
 * Description of ReservationController
 *
 * @author quentin.hoarau
 */
class ReservationController extends AppController
{
    public function __construct()
    {
        parent::__construct();
        $this->loadModel("Reservation");
        $this->loadModel("User");
    }
    
    public function index()
    {
        $this->checkAuth('user');
        $this->setTemplate($_SESSION['type']);
        
        $reservations = $this->Reservation->allByUserId($_SESSION['auth']);
        
        foreach ($reservations as $reservation){
            $customer = $this->User->find($reservation->id_customer);
            $coach = $this->User->find($reservation->id_coach);
            $reservation->id_customer = $customer;
            $reservation->id_coach = $coach;
        }
        
        $this->render('reservation.index', compact('reservations', 'json_events'));
    }
    
    public function getAllEvents()
    {
        $reservations = $this->Reservation->all();
        
        // création du JSON
        $json_events = [];
        foreach ($reservations as $reservation){
            $event = [];
            $event["title"] = "Occupé";
            $event["start"] = $reservation->start;
            $event["end"] = $reservation->end;
            array_push($json_events, $event);
        }
        $result = json_encode($json_events);
        echo $result;
    }
    
    public function getEventsByUser()
    {
        // detecte si on est un coach ou un client
        if($_SESSION['type'] == "customer"){
            $reservations = $this->Reservation->allByUserId($_SESSION['auth']);
        } elseif($_SESSION['type'] == "coach"){
            $reservations = $this->Reservation->allByCoachId($_SESSION['auth']);
        }
        
        // création du JSON
        $json_events = [];
        foreach ($reservations as $reservation){
            $event = [];
            $event["title"] = $reservation->type;
            $event["start"] = $reservation->start;
            $event["end"] = $reservation->end;
            $event["description"] = $reservation->id;
            array_push($json_events, $event);
        }
        $result = json_encode($json_events);
        echo $result;
    }
    
    public function getEventById()
    {
        extract($_GET);
        $reservation = $this->Reservation->find($event_id);
        
        switch ($reservation->level){
            case 1: $reservation->level = "Débutant"; break;
            case 2: $reservation->level = "Intermédiaire"; break;
            case 3: $reservation->level = "Avancé"; break;
        }
        
        // on attribut l'objet coach
        $customer = $this->User->find($reservation->id_customer);
        $coach = $this->User->find($reservation->id_coach);
        $reservation->id_customer = $customer;
        $reservation->id_coach = $coach;
        
        $this->renderAjax("reservation.eventDetails", compact('reservation'));
    }
    
    public function newReservationForm()
    {
        $this->checkAuth('user');
        $this->setTemplate($_SESSION['type']);
        
        $coaches = $this->User->getAllByType("coach");
        $this->render('reservation.new_reservation', compact('coaches'));
    }
    
    public function add()
    {
        if( !empty($_POST) ){
            $empty = false;
            foreach($_POST as $value){
                if( empty($value) ){
                    $empty = true;
                }
            }
        }
        
        if($empty){
            Session::setFlash("Tous les champs sont obligatoires", 'danger');
        } else {
            $user_id = $_SESSION["auth"];
            $date_parts = explode(" - ", $_POST["daterange"]);
            $start = $date_parts[0];
            $end = $date_parts[1];
            
            $result = $this->Reservation->create([
                'type' => $_POST['type_seance'],
                'id_customer' => $user_id,
                'id_coach' => $_POST["coach"],
                'level' => $_POST["level"],
                'address' => $_POST["address"],
                'start' => $start,
                'end' => $end,
            ]);

            // il faut logger le message !
            
            Session::setFlash("Votre réservation a été prise en compte", 'success');
        }
        
        $this->index();
    }
}
