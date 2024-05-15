<?php
include '../Controller/eventC.php';
//'include '../controler/reservationC.php';
include_once("../model/event.php");
$eventC = new eventC();

// Check if the reservation was successful (by checking the URL parameter)
if (isset($_GET['reservation_success']) && $_GET['reservation_success'] == 'true') {
    // Get the event ID from the reservation data
    if (isset($_GET['event_id'])) {
        $reserved_event_id = $_GET['event_id'];

        // Count the number of reservations for this event
        $reservationCount = $eventC->countReservations($reserved_event_id);

        // If there are reservations for this event, display a message
        if ($reservationCount > 0) {
            echo "<p>Attention: Plusieurs personnes ont réservé cet événement (ID: $reserved_event_id).</p>";
        }
    }
}
$reservationC= new eventC();
$reservationCounts = $reservationC->countReservationsForEvents();

$list = $eventC->listevent();

$eventa = NULL;
$eventCa = new eventC();

if (
    isset($_POST["event_name"]) &&
    isset($_POST["event_description"]) &&
    isset($_POST["event_date"]) &&
    isset($_POST["event_location"])&&
    isset($_POST["event_organizer"]) 

    
    
) {
    if (
        !empty($_POST['event_name']) &&
        !empty($_POST['event_description']) &&
        !empty($_POST['event_date']) &&
        !empty($_POST['event_location'])&&
        !empty($_POST['event_organizer']) 
       
        
    ) {
        $eventa = new event(
            NULL,
            $_POST['event_name'],
            $_POST['event_description'],
            $_POST['event_date'],
            $_POST['event_location'],
            $_POST['event_organizer']
             
        );
        $eventCa->addevent($eventa);
        header('Location:indexx.php');
    } 
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang>
<!--<![endif]-->

<!-- Mirrored from colorlib.com/polygon/elaadmin/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Apr 2024 01:48:05 GMT -->

<head>




    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ela Admin - HTML5 Admin Template</title>
    <meta name="description" content="Ela Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" href="images/favicon.png">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/themify-icons.css">
    <link rel="stylesheet" href="assets/css/pe-icon-7-filled.css">
    <link href="assets/weather/css/weather-icons.css" rel="stylesheet" />
    <link href="assets/calendar/fullcalendar.css" rel="stylesheet" />
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="assets/css/charts/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/vector-map/jqvmap.min.css" rel="stylesheet">
    <style>
    #weatherWidget .currentDesc {
        color: #ffffff !important;
    }

    .traffic-chart {
        min-height: 335px;
    }

    #flotPie1 {
        height: 150px;
    }

    #flotPie1 td {
        padding: 3px;
    }

    #flotPie1 table {
        top: 20px !important;
        right: -10px !important;
    }

    .chart-container {
        display: table;
        min-width: 270px;
        text-align: left;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    #flotLine5 {
        height: 105px;
    }

    #flotBarChart {
        height: 150px;
    }

    #cellPaiChart {
        height: 160px;
    }
    </style>
    <meta name="robots" content="noindex, nofollow">
   
</head>

<body>

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">

                    <li class="menu-title">Dashboard</li>
                    <li class="menu-item-has-children dropdown">
                        <a href="indexx.php" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>gestion event</a>
                            
                        <a href="admin.php" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-cogs"></i>reclamation</a>
                        <a href="/jobentry/Ramzi/view/back/index.php" class="dropdown-toggle" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-cogs"></i>blog</a>


                        <ul class="sub-menu children dropdown-menu">
                            <li><i class="fa fa-puzzle-piece"></i><a href="indexx.php">Buttons</a></li>

                        </ul>
                    </li>

                </ul>
            </div>
        </nav>
    </aside>


    <div id="right-panel" class="right-panel">

        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="indexx.php/"><img
                            src="https://colorlib.com/polygon/elaadmin/images/logo.png" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="indexx.php"><img
                            src="https://colorlib.com/polygon/elaadmin/images/logo2.png" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..."
                                    aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div>
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown for-message">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="message"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-envelope"></i>
                                <span class="count bg-primary">4</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="message">
                                <p class="red">You have 4 Mails</p>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="elaadmin/images/avatar/1.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jonathan Smith</span>
                                        <span class="time float-right">Just now</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="elaadmin/images/avatar/2.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Jack Sanders</span>
                                        <span class="time float-right">5 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="elaadmin/images/avatar/3.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Cheryl Wheeler</span>
                                        <span class="time float-right">10 minutes ago</span>
                                        <p>Hello, this is an example msg</p>
                                    </div>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <span class="photo media-left"><img alt="avatar"
                                            src="elaadmin/images/avatar/4.jpg"></span>
                                    <div class="message media-body">
                                        <span class="name float-left">Rachel Santos</span>
                                        <span class="time float-right">15 minutes ago</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img class="user-avatar rounded-circle"
                                src="https://colorlib.com/polygon/elaadmin/images/admin.jpg" alt="User Avatar">
                        </a>
                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href="#"><i class="fa fa-user"></i>My Profile</a>
                            <a class="nav-link" href="#"><i class="fa fa-bell-o"></i>Notifications <span
                                    class="count">13</span></a>
                            <a class="nav-link" href="#"><i class="fa fa-cog"></i>Settings</a>
                            <a class="nav-link" href="#"><i class="fa fa-power-off"></i>Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <script src="js.js"></script>   
        <div class="content pb-0">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <script src="js.js"></script>
                        <script>
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
</script>


                        <div class="card-header"><strong>events</strong><small> info</small></div>
                        <div class="card-body card-block">
                       
                            <form action="" id="form" method="POST" class="" onsubmit="return validateForm()">
                                <div class="form-group"><label for="event_name"
                                        class=" form-control-label">event_name</label><input type="text" id="event_name" name = "event_name"
                                        placeholder="Enter your event_name" class="form-control"></div>
                                <div class="form-group"><label for="event_description"
                                        class=" form-control-label">event_description</label><input type="text"
                                        id="event_description" placeholder="Enter your event_description" name="event_description"
                                        class="form-control"></div>
                                <div class="form-group"><label for="event_date"
                                        class=" form-control-label">event_date</label><input type="date" id="event_date" name="event_date"
                                        placeholder="Enter street name" class="form-control"></div>
                                <div class="row form-group">
                                    <div class="col-8">
                                        <div class="form-group"><label for="event_location"
                                                class=" form-control-label">event_location</label><input type="text"
                                                id="event_location"  name = "event_location" placeholder="Enter your event_location"
                                                class="form-control"></div>
                                    </div>
                                    <div class="col-8">
                                        <div class="form-group"><label for="event_organizer"
                                                class=" form-control-label">
                                                event_organizer</label><input type="text" id="event_organizer"
                                                placeholder="event_organizer" name="event_organizer" class="form-control"></div>
                                    </div>
                                </div>

                                <div class="form-actions form-group">
                                    <button type="submit" value="save" name="save" class="btn btn-primary btn-sm">Submit</button>
                                    <button type="reset" value="reset" class="btn btn-primary btn-sm">Reset</button>
                                </div>

                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="content pb-0">
            <div class="clearfix"></div>
            <div class="orders">
                <div class="row">
                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="box-title">data events </h4> <input type="text" id="searsh" name="searsh">
                            </div>
                            
                            

                            <div class="card-body--">
                                <div id="resultTable"class="table-stats order-table ov-h">
                                    <table class="table ">
                                        <thead>
                                            <tr>

                                                <th>event_id </th>
                                                <th>event_name</th>
                                                <th>event_description</th>
                                                <th>event_date</th>
                                                <th>event_location</th>
                                                <th>event_organizer</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <?php
                                          
                                             foreach ($list as $event) {
                                            ?>
                                        <tr>
                                            <td>
                                                <?= $event['event_id']; ?>
                                            </td>
                                            <td>
                                                <?= $event['event_name']; ?>
                                            </td>
                                            <td>
                                                <?= $event['event_description']; ?>
                                            </td>
                                            <td>
                                                <?= $event['event_date']; ?>
                                            </td>
                                            <td>
                                                <?= $event['event_location']; ?>
                                            </td>
                                            <td>
                                                <?= $event['event_organizer']; ?>
                                            </td>
                                            

                                            <td align="center">
                                                <form method="POST" action="updateevent.php">
                                                    <div class="container py-2">
                                                        <button class="btn btn-info" type="submit" name="update"
                                                            value="update">Update</button>
                                                        <input type="hidden" value=<?PHP echo $event['event_id']; ?>
                                                        name="event_id">
                                                </form>
                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="deleteevent.php?event_id=<?php echo $event['event_id']; ?>">
                                                    <div class="container py-2">
                                                        <button class="btn btn-danger" type="submit" name="Delete"
                                                            value="Delete">Delete</a>
                                                </form>
                                            </td>

                                           
                                            <td>
                                                <button class="btn btn-primary" onclick="window.location.href='pdf.php?event_id=<?php echo $event['event_id']; ?>'">upload</button>
                                            </td>

                                            <?php
                                          }
                                        ?>

                                    </table>
                                    <script>
                                    document.getElementById("searsh").addEventListener("input", function() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searsh");
        filter = input.value.toUpperCase();
        table = document.getElementById("resultTable");
        tr = table.getElementsByTagName("tr");

        // Parcourt toutes les lignes et masque celles qui ne correspondent pas à la recherche
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[1]; // Colonne ID
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    });
</script>
                                    
                                    <?php
                              

// Afficher les résultats
foreach ($reservationCounts as $count) {    ?>
   <?php  echo "Event ID: " . $count['event_id'] . "<br>";?>
   <?php  echo "Event Name: " . $count['event_name'] . "<br>";?>
   <?php  echo "Reservation Count: " . $count['reservation_count'] . "<br>";?>
   <?php  echo "--------------------------"."<br>"?>
   <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            





            <div class="modal fade none-border" id="event-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Add New Event</strong></h4>
                        </div>
                        <div class="modal-body"></div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect"
                                data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success save-event waves-effect waves-light">Create
                                event</button>
                            <button type="button" class="btn btn-danger delete-event waves-effect waves-light"
                                data-dismiss="modal">Delete</button>
                        </div>
                    </div>
                </div>
            </div>



        </div>
        <div class="clearfix"></div>

    </div>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/popper.min.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/plugins.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/main.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/lib/chart-js/Chart.bundle.js"></script>

    <script src="https://colorlib.com/polygon/elaadmin/assets/js/lib/chartist/chartist.min.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/lib/chartist/chartist-plugin-legend.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/lib/flot-chart/jquery.flot.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/lib/flot-chart/jquery.flot.pie.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/lib/flot-chart/jquery.flot.spline.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/weather/js/jquery.simpleWeather.min.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/weather/js/weather-init.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/js/lib/moment/moment.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/calendar/fullcalendar.min.js"></script>
    <script src="https://colorlib.com/polygon/elaadmin/assets/calendar/fullcalendar-init.js"></script>

</body>

<!-- Mirrored from colorlib.com/polygon/elaadmin/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Apr 2024 01:48:07 GMT -->

</html>