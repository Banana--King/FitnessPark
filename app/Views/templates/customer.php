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
                <a class="navbar-brand" href="index.php">FitnessPark (user)</a>
            </div>
            <!-- /.navbar-header -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?p=users.index"><i class="fa fa-dashboard fa-fw"></i> Mon profil</a>
                        </li>
                        <li>
                            <a href="index.php?p=reservation.newReservationForm"><i class="fa fa-bar-chart-o fa-fw"></i> Réserver Coach</a>
                        </li>
                        <li>
                            <a href="index.php?p=reservation.index"><i class="fa fa-table fa-fw"></i> Mes réservations</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit fa-fw"></i> Rechercher Coachs</a>
                        </li>
                        <li>
                            <a href="index.php?p=users.logout"><i class="fa fa-wrench fa-fw"></i> Deconnexion</a>
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
            $("#daterange").on("click", function(){
                $("#daterange-modal").modal();
            });
            $("#daterange").keyup(function(){
                $("#daterange").val('');
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
                            console.log(response);
                            $("#event-description-modal #result").html(response);
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
            
            var maxDate = Date();
            $('#reservation-calendar').fullCalendar({
                lang: 'fr',
                defaultView: 'agendaWeek',
                selectable: true,
                selectHelper: true,
                nowIndicator: true,
                allDaySlot: false,
                minTime: "08:00:00",
                maxTime: "20:00:00",
                selectOverlap: false,
                select: function(start, end, jsEvent, view) {
                    var today = moment();
                    var min_date = today.add(4, 'hours');
                    if(start < today){
                        $('#reservation-calendar').fullCalendar('unselect');
                        return;
                    }
                    
                    var duration = moment.duration(end.diff(start));
                    var hours = duration.asHours();
                    console.log(hours);
                    if(hours < 1 || hours > 2){
                        $('#reservation-calendar').fullCalendar('unselect');
                        return;
                    }
                    
                    $.each(start._i, function(index, value){
                        if(value.toString().length < 2){
                            if(index === 1){
                                value = (value+1);
                            }
                            var tmp_string = "0" + value;
                            start._i[index] = tmp_string;
                        }
                    });
                    $.each(end._i, function(index, value){
                        if(value.toString().length < 2){
                            if(index === 1){
                                value = (value+1);
                            }
                            var tmp_string = "0" + value;
                            end._i[index] = tmp_string;
                        }
                    });
                    
                    var event_start = start._i[0]+"-"+start._i[1]+"-"+start._i[2]+" "+start._i[3]+":"+start._i[4]+":"+start._i[5];
                    var event_end = end._i[0]+"-"+end._i[1]+"-"+end._i[2]+" "+end._i[3]+":"+end._i[4]+":"+end._i[5];
                    
                    $("#daterange").val(event_start + " - " + event_end);
                    $("#daterange-modal").modal('hide');
                },
                eventSources: [
                    'index.php?p=reservation.getAllEvents'
                ]
            });
        });
    </script>
    
</body>

</html>
