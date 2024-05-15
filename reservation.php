<?php

class Reservation
{
    private $reservation_id=NULL;
    private $event_id;
    private $participant_name;
    private $participant_email;
    private $participant_phone;
    private $num_of_people;
    private $reservation_status;

    public function __construct($reservation_id, $event_id, $participant_name, $participant_email, $participant_phone, $num_of_people, $reservation_status)
    {
        $this->reservation_id = $reservation_id;
        $this->event_id = $event_id;
        $this->participant_name = $participant_name;
        $this->participant_email = $participant_email;
        $this->participant_phone = $participant_phone;
        $this->num_of_people = $num_of_people;
        $this->reservation_status = $reservation_status;
    }

    // Getters and setters for each property
    public function getReservationId()
    {
        return $this->reservation_id;
    }

    public function setReservationId($reservation_id)
    {
        $this->reservation_id = $reservation_id;
    }

    public function getEventId()
    {
        return $this->event_id;
    }

    public function setEventId($event_id)
    {
        $this->event_id = $event_id;
    }

    public function getParticipantName()
    {
        return $this->participant_name;
    }

    public function setParticipantName($participant_name)
    {
        $this->participant_name = $participant_name;
    }

    public function getParticipantEmail()
    {
        return $this->participant_email;
    }

    public function setParticipantEmail($participant_email)
    {
        $this->participant_email = $participant_email;
    }

    public function getParticipantPhone()
    {
        return $this->participant_phone;
    }

    public function setParticipantPhone($participant_phone)
    {
        $this->participant_phone = $participant_phone;
    }

    public function getNumOfPeople()
    {
        return $this->num_of_people;
    }

    public function setNumOfPeople($num_of_people)
    {
        $this->num_of_people = $num_of_people;
    }

    public function getReservationStatus()
    {
        return $this->reservation_status;
    }

    public function setReservationStatus($reservation_status)
    {
        $this->reservation_status = $reservation_status;
    }
}
?>
