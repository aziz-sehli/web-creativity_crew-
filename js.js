
    // Fonction de validation du formulaire
    function validateForm() {
        // Récupérer les valeurs des champs
        var eventName = document.getElementById('event_name').value;
        var eventDescription = document.getElementById('event_description').value;
        var eventDate = document.getElementById('event_date').value;
        var eventLocation = document.getElementById('event_location').value;
        var eventOrganizer = document.getElementById('event_organizer').value;

        // Vérifier si les champs sont vides
        if (eventName == "" || eventDescription == "" || eventDate == "" || eventLocation == "" || eventOrganizer == "") {
            alert("Tous les champs doivent être remplis.");
            return false; // Empêcher la soumission du formulaire
        }

        // Vérifier si la date est supérieure à la date actuelle
        var currentDate = new Date();
        var selectedDate = new Date(eventDate);
        if (selectedDate <= currentDate) {
            alert("La date doit être supérieure à la date actuelle.");
            return false; // Empêcher la soumission du formulaire
        }

        // Vérifier si event_name et event_organizer ne contiennent pas de symboles et de chiffres
        var nameRegex = /^[a-zA-Z\s]*$/; // Seules les lettres et les espaces sont autorisés
        if (!nameRegex.test(eventName) || !nameRegex.test(eventOrganizer)) {
            alert("Les champs event_name et event_organizer ne doivent contenir que des lettres et des espaces.");
            return false; // Empêcher la soumission du formulaire
        }

        // Validation réussie
        return true; // Autoriser la soumission du formulaire
    }
