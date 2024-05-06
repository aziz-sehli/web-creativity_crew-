<?php
require_once("../view/dompdf/autoload.inc.php");
require_once("../controler/eventC.php");

use Dompdf\Dompdf;
use Dompdf\Options;

// Récupérer l'ID de l'événement depuis les paramètres GET
if (isset($_GET['event_id'])) {
    $id = intval($_GET['event_id']);
} else {
    echo("ID de l'événement non reçu.");
    exit;
}

// Créer une instance du contrôleur eventC
$eventController = new eventC();

// Récupérer les détails de l'événement à partir de l'ID
$event = $eventController->getEventById($id);

// Si aucun événement n'est trouvé avec l'ID spécifié
if (!$event) {
    echo "L'événement avec l'ID $id n'existe pas.";
    exit;
}

// Charger le contenu HTML du fichier pdf.html
$html = file_get_contents("pdf.html");

// Remplacer les balises HTML avec les données de l'événement
$html = str_replace("{event_id}", $event->getevent_id(), $html);
$html = str_replace("{event_name}", $event->getevent_name(), $html);
$html = str_replace("{event_date}", $event->getevent_date(), $html);
$html = str_replace("{event_description}", $event->getevent_description(), $html);
$html = str_replace("{event_location}", $event->getevent_location(), $html);
$html = str_replace("{event_organizer}", $event->getevent_organizer(), $html);

// Créer une instance de Dompdf
$options = new Options();
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);
$nom=$event->getevent_name();

// Charger le contenu HTML dans Dompdf
$dompdf->loadHtml($html);

// Rendre le PDF
$dompdf->render();

// Afficher le PDF dans le navigateur et le télécharger
$dompdf->stream("evenement_$nom.pdf");
?>
