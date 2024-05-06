<?php
include '../config.php';
include '../model/event.php';

class eventC
{
    public function listevent()
    {
        $sql = "SELECT * FROM event";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function countEvents()
    {
        $sql = "SELECT COUNT(*) as total FROM event";
        $db = config::getConnexion();
        try {
            $count = $db->query($sql);
            return $count->fetch()['total'];
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function countReservations($event_id)
    {
        $sql = "SELECT COUNT(*) as total FROM reservation WHERE event_id = :event_id";
        $db = config::getConnexion();
        try {
            $count = $db->prepare($sql);
            $count->execute(['event_id' => $event_id]);
            return $count->fetch()['total'];
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function deleteevent($event_id)
    {
        $sql = "DELETE FROM event WHERE event_id = :event_id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':event_id', $event_id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addevent($event)
    {
        $sql = "INSERT INTO event
        VALUES (NULL, :event_name, :event_description,:event_date,:event_location,:event_organizer)";  
        $db = config::getConnexion(); 
        try {
            
            
            $query = $db->prepare($sql);
            $query->execute([
                'event_name' => $event->getevent_name(),
                'event_description' => $event->getevent_description(),
                'event_date' => $event->getevent_date(),
                'event_location' => $event->getevent_location(),
                'event_organizer' => $event->getevent_organizer()
                
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateevent($event, $event_id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE event SET 
                    event_name = :event_name, 
                    event_description = :event_description, 
                    event_date = :event_date, 
                    event_location = :event_location,
                    event_organizer = :event_organizer
                  
                WHERE event_id= :event_id'
            );
            $query->execute([
                'event_id' => $event_id,
                'event_name' => $event->getevent_name(),
                'event_description' => $event->getevent_description(),
                'event_date' => $event->getevent_date(),
                'event_location' => $event->getevent_location(),
                'event_organizer' => $event->getevent_organizer()
            ]);
            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }

    function showevent($event_id)
    {
        $sql = "SELECT * from event where event_id = $event_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute();

            $event = $query->fetch();
            return $event;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function countReservationsForEvents() {
        $sql = "SELECT e.event_id, e.event_name, COUNT(r.event_id) AS reservation_count 
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
    public function getEventById($event_id)
    {
        $sql = "SELECT * FROM event WHERE event_id = :event_id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['event_id' => $event_id]);
            $event_data = $query->fetch(PDO::FETCH_ASSOC);
            
            // Vérifier si des données ont été récupérées
            if ($event_data) {
                // Créer une instance de la classe event avec les données récupérées
                $event = new event(
                    $event_data['event_id'],
                    $event_data['event_name'],
                    $event_data['event_description'],
                    $event_data['event_date'],
                    $event_data['event_location'],
                    $event_data['event_organizer']
                );
                return $event;
            } else {
                return null; // Aucun événement trouvé avec cet ID
            }
        } catch (Exception $e) {
            die('Error fetching event details: ' . $e->getMessage());
        }
    }
    

}
