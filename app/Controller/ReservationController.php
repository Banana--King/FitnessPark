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
        $this->loadModel("Log");
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
            
            $bla = strtotime($reservation->end);
            $bla += 1800;
            $test = date("Y-m-d H:i:s", $bla);
            $end_parts = explode(" ", $test);
            if($end_parts[1] == "20:30:00"){
                $end_parts[1] = "20:00:00";
            }
            $end = $end_parts[0]." ".$end_parts[1];
            
            $event["title"] = "Occupé";
            $event["start"] = $reservation->start;
            $event["end"] = $end;
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
            
            switch($reservation->level){
                case 1: $event["color"] = "green"; break;
                case 2: $event["color"] = "orange"; break;
                case 3: $event["color"] = "red"; break;
            }
            if($reservation->askForDelete == 1){
                $event["color"] = "grey";
            }
            
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
            $user = $this->User->find($user_id);
            $coach = $this->User->find($_POST["coach"]);
            $message = "Nouvelle reservation: type".$_POST["type_seance"].", client: ".$user->email;
            $message .= ", coach: ".$coach->email.", adresse: ".$_POST["address"];
            $this->log($message);
            
            Session::setFlash("Votre réservation a été prise en compte", 'success');
        }
        
        $this->index();
    }
    
    public function askForDelete()
    {
        if (!empty($_GET)) {
            $result = $this->Reservation->update($_GET['event_id'], [
                'askForDelete' => 1,
            ]);
            Session::setFlash("La demande de suppression a été prise en compte", 'success');
            
            // on log la demande d'annulation
            $reservation = $this->Reservation->find($_GET['event_id']);
            $user = $this->User->find($reservation->id_customer);
            $coach = $this->User->find($reservation->id_coach);
            $message = "Demande de suppression reservation: client: ".$user->email.", coach: ".$coach->email;
            $this->log($message);
            
            return $this->index();
        }
    }
    
    public function delete()
    {
        if (!empty($_GET)) {
            $reservation = $this->Reservation->find($_GET['event_id']);
            
            $result = $this->Reservation->delete($_GET['event_id']);
            
            if($result){
                Session::setFlash("La séance à bien été supprimé", 'success');
            
                // on log l'annulation
                $user = $this->User->find($reservation->id_customer);
                $coach = $this->User->find($reservation->id_coach);
                $message = "Suppression reservation: client: ".$user->email.", coach: ".$coach->email;
                $this->log($message);
            }
            
            
            return $this->index();
        }
    }
    
    public function log($message)
    {
        $this->Log->create([
            'userId' => $_SESSION["auth"],
            'message' => $message,
        ]);
    }
}
