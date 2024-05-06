<?php
include '../config1.php';
include '../model/reservation.php';

class ReservationC {
    
    public function listReservation() {
        $sql = "SELECT * FROM reservation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }


    public function addReservation($reservation) {
        $sql = "INSERT INTO reservation 
                VALUES (NULL, :event_id, :participant_name, :participant_email, :participant_phone, :num_of_people, :reservation_status)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'event_id' => $reservation->getEventId(),
                'participant_name' => $reservation->getParticipantName(),
                'participant_email' => $reservation->getParticipantEmail(),
                'participant_phone' => $reservation->getParticipantPhone(),
                'num_of_people' => $reservation->getNumOfPeople(),
                'reservation_status' => $reservation->getReservationStatus()
            ]);
        } catch (Exception $e) {
            die('Error adding reservation: ' . $e->getMessage());
        }
    }
    
    public function updateReservation($reservation, $reservation_id) {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE reservation SET 
                    reservation_name = :reservation_name, 
                    reservation_date = :reservation_date, 
                    reservation_location = :reservation_location, 
                    reservation_organizer = :reservation_organizer 
                WHERE reservation_id = :reservation_id'
            );
            $query->execute([
                'reservation_id' => $reservation_id,
                'reservation_name' => $reservation->getReservationName(),
                'reservation_date' => $reservation->getReservationDate()->format('Y-m-d'),
                'reservation_location' => $reservation->getReservationLocation(),
                'reservation_organizer' => $reservation->getReservationOrganizer()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            die('Error updating reservation: ' . $e->getMessage());
        }
    }

    public function showReservation($reservation_id) {
        $sql = "SELECT * FROM reservation WHERE reservation_id = $reservation_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $reservation = $query->fetch();
            return $reservation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function deletereservation($reservation_id)
    {
        $sql = "DELETE FROM reservation WHERE reservation_id = :reservation_id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':reservation_id', $reservation_id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    
    public function affress()
    {   
        $sql="SELECT reservation.*,event.* FROM reservation INNER JOIN event ON reservation.event_id = event.event_id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste; 
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }
    
    public function countReservationsForEvents() {
        $sql = "SELECT e.event_id, e.event_name, COUNT(r.id) AS reservation_count 
                FROM event e
                LEFT JOIN reservation r ON e.event_id = r.event_id
                GROUP BY e.event_id, e.event_name";
        $db = config::getConnexion();
        try {
            $query = $db->query($sql);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            die('Error counting reservations for events: ' . $e->getMessage());
        }
    }
    public function sortReservationsByNumOfPeople() {
        $sql = "SELECT * FROM reservation ORDER BY num_of_people ASC";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error sorting reservations by number of people: ' . $e->getMessage());
        }
    }


    

    
}



?>
