<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= App::getInstance()->title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="/FitnessPark/public/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/FitnessPark/public/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/FitnessPark/public/bower_components/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/FitnessPark/public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">FitnessPark (coach)</a>
            </div>
            <!-- /.navbar-header -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?p=users.index"><i class="fa fa-user fa-fw"></i> Mon profil</a>
                        </li>
                        <li>
                            <a href="index.php?p=reservation.index"><i class="fa fa-calendar fa-fw"></i> Mon planning</a>
                        </li>
                        <li>
                            <a href="index.php?p=users.logout"><i class="fa fa-sign-out fa-fw"></i> Deconnexion</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <?= $content; ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="/FitnessPark/public/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="/FitnessPark/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="/FitnessPark/public/bower_components/metisMenu/dist/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="/FitnessPark/public/bower_components/startbootstrap-sb-admin-2/dist/js/sb-admin-2.js"></script>
    
    <!-- FullCalendar JavaScript -->
    <script src="/FitnessPark/public/bower_components/moment/min/moment.min.js" type="text/javascript"></script>
    <script src='/FitnessPark/public/bower_components/fullcalendar/dist/fullcalendar.js'></script>
    
    <script>
        $(document).ready(function() {
            $("#delete-reservation").on('click', function(){
                $("#delete-confirmation").modal();
            });
            
            $("#index-calendar").fullCalendar({
                lang: 'fr',
                defaultView: 'agendaWeek',
                nowIndicator: true,
                allDaySlot: false,
                minTime: "08:00:00",
                maxTime: "20:00:00",
                eventClick: function( event, jsEvent, view ){
                    var event_id = event.description;
                    $.ajax({
                        url: 'index.php?p=reservation.getEventById',
                        data: {
                            event_id: event_id
                        },
                        success: function(response){
                            $("#event-description-modal #result").html(response);
                            if(event.color == "grey"){
                                $("#delete-reservation").removeClass("hidden");
                                $("#confirm").attr("href", "index.php?p=reservation.delete&event_id="+event_id);
                            } else {
                                $("#delete-reservation").addClass("hidden");
                            }
                            
                            $("#event-description-modal").modal();
                        },
                        error: function(){
                            alert("Il y a eu une erreur lors du chargement de l'event...");
                        }
                    });
                },
                eventSources: [
                    'index.php?p=reservation.getEventsByUser'
                ]
            });
        });
    </script>
    
</body>

</html>
