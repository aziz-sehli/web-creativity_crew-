<?php
include '../controler/reservationC.php';
include_once("../model/reservation.php");
$reservationC = new reservationC();

// Check if the reservation was successful (by checking the URL parameter)
if (isset($_GET['reservation_success']) && $_GET['reservation_success'] == 'true') {
    // Get the reservation ID from the reservation data
    if (isset($_GET['reservation_id'])) {
        $reserved_reservation_id = $_GET['reservation_id'];

        // Count the number of reservations for this reservation
        $reservationCount = $reservationC->countReservations($reserved_reservation_id);

        // If there are reservations for this reservation, display a message
        if ($reservationCount > 0) {
            echo "<p>Attention: Plusieurs personnes ont réservé cette réservation (ID: $reserved_reservation_id).</p>";
        }
    }
}

$list = $reservationC->listreservation();

$reservation = NULL;
$reservationCa = new reservationC();

if (
    isset($_POST["participant_name"]) &&
    isset($_POST["participant_email"]) &&
    isset($_POST["participant_phone"]) &&
    isset($_POST["num_of_people"]) 
) {
    if (
        !empty($_POST['participant_name']) &&
        !empty($_POST['participant_email']) &&
        !empty($_POST['participant_phone']) &&
        !empty($_POST['num_of_people']) 
    ) {
        $reservation = new Reservation(
            NULL,
            $_POST['participant_name'],
            $_POST['participant_email'],
            $_POST['participant_phone'],
            $_POST['num_of_people']
        );
        $reservationCa->addReservation($reservation);
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
                            aria-expanded="false"> <i class="menu-icon fa fa-cogs"></i>gestion reservation</a>
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
        <div class="content pb-0">
            <div class="clearfix"></div>
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <script src="js.js"></script>
                        <div class="card-header"><strong>Réservations</strong><small> informations</small></div>
                        <div class="card-body card-block">
                       
                            <form action="" id="form" method="POST" class="">
                                <div class="form-group"><label for="participant_name"
                                        class=" form-control-label">participant_name</label><input type="text" id="participant_name" name = "participant_name"
                                        placeholder="Enter participant_name" class="form-control"></div>
                                <div class="form-group"><label for="participant_email"
                                        class=" form-control-label">participant_email</label><input type="email"
                                        id="participant_email" placeholder="Enter participant_email" name="participant_email"
                                        class="form-control"></div>
                                <div class="form-group"><label for="participant_phone"
                                        class=" form-control-label">participant_phone</label><input type="tel" id="participant_phone" name="participant_phone"
                                        placeholder="Enter participant_phone" class="form-control"></div>
                                <div class="form-group"><label for="num_of_people"
                                        class=" form-control-label">num_of_people</label><input type="number"
                                        id="num_of_people"  name = "num_of_people" placeholder="Enter num_of_people"
                                        class="form-control"></div>
                                
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
                                <h4 class="box-title">Réservations </h4>
                            </div>
                            <div class="card-body--">
                                <div class="table-stats order-table ov-h">
                                    <table class="table ">
                                        <thead>
                                            <tr>

                                                <th>reservation_id </th>
                                                <th>participant_name</th>
                                                <th>participant_email</th>
                                                <th>participant_phone</th>
                                                <th>num_of_people</th>
                                                <th></th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <?php
                                          
                                             foreach ($list as $reservation) {
                                            ?>
                                        <tr>
                                            <td>
                                                <?= $reservation['reservation_id']; ?>
                                            </td>
                                            <td>
                                                <?= $reservation['participant_name']; ?>
                                            </td>
                                            <td>
                                                <?= $reservation['participant_email']; ?>
                                            </td>
                                            <td>
                                                <?= $reservation['participant_phone']; ?>
                                            </td>
                                            <td>
                                                <?= $reservation['num_of_people']; ?>
                                            </td>

                                            <td align="center">
                                                <form method="POST" action="updatereservation.php">
                                                    <div class="container py-2">
                                                        <button class="btn btn-info" type="submit" name="update"
                                                            value="update">Update</button>
                                                        <input type="hidden" value=<?PHP echo $reservation['reservation_id']; ?>
                                                        name="reservation_id">
                                                </form>
                                            </td>
                                            <td>
                                                <form method="POST"
                                                    action="deletereservation.php?reservation_id=<?php echo $reservation['reservation_id']; ?>">
                                                    <div class="container py-2">
                                                        <button class="btn btn-danger" type="submit" name="Delete"
                                                            value="Delete">Delete</a>
                                                </form>
                                            </td>

                                            <?php
                                          }
                                        ?>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>






            <div class="modal fade none-border" id="reservation-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title"><strong>Supprimer</strong> Reservation</h4>
                        </div>
                        <div class="modal-body">
                            <form action="deletereservation.php" method="POST">
                                <input type="hidden" name="reservation_id" id="reservation_id">
                                <div class="alert alert-danger">
                                    <p>Êtes-vous sûr de vouloir supprimer cette réservation ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button>
                                    <button type="submit" class="btn btn-danger">Confirmer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

        </div>

    </div>
    </div>
    </div>

    <script src="assets/js/vendor/jquery-2.1.4.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/lib/chart-js/Chart.bundle.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.min.js"></script>
    <script src="assets/js/lib/vector-map/jquery.vmap.sampledata.js"></script>
    <script src="assets/js/lib/vector-map/country/jquery.vmap.world.js"></script>
</body>

<!-- Mirrored from colorlib.com/polygon/elaadmin/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 15 Apr 2024 01:49:23 GMT -->

</html>
