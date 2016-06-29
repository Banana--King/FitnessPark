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
                            <a href="index.php?p=users.index"><i class="fa fa-user fa-fw"></i> Mon profil</a>
                        </li>
                        <li>
                            <a href="index.php?p=reservation.newReservationForm"><i class="fa fa-shopping-cart fa-fw"></i> Réserver Coach</a>
                        </li>
                        <li>
                            <a href="index.php?p=reservation.index"><i class="fa fa-calendar fa-fw"></i> Mes réservations</a>
                        </li>
                        <li>
                            <a href="index.php?p=users.searchCoach"><i class="fa fa-search fa-fw"></i> Rechercher Coachs</a>
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
    
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBM2ztAQugm4BID2w1QQf_5EvqrGaxCx8Y" defer></script>
    
    <script>
        var map;
        var initialMarker;
        var marker;
        var circle;
        var geocoder;
        var markers = [];
        var myLatLng = {lat: 48.93585242484315, lng: 2.3009490966796875};
        function initMap() {

            // Create a map object and specify the DOM element for display.
            map = new google.maps.Map(document.getElementById('reservation-map'), {
                center: myLatLng,
                scrollwheel: false,
                zoom: 12
            });

            // Create a marker and set its position.
            initialMarker = new google.maps.Marker({
                map: map,
                position: myLatLng,
                title: 'FitnessPark'
            });
            markers.push(initialMarker);
            
            // Add circle overlay and bind to marker
            circle = new google.maps.Circle({
                map: map,
                center: myLatLng,
                radius: 5000,
                fillColor: '#AA0000',
                fillOpacity: 0.2
            });
            circle.bindTo('center', initialMarker, 'position');
        }
        
        function pointInCircle(point, radius, center)
        {
            return (google.maps.geometry.spherical.computeDistanceBetween(point, center) <= radius);
        }
        
        function message(msg, type, target)
        {
            var message = ''
                +'<p class="alert alert-dismissible alert-'+type+'">'
                +   '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                +       '<span aria-hidden="true">&times;</span>'
                +   '</button>'
                +   '<i class="fa fa-warning"> </i> '+ msg
                +'</p>';
            $(target).html(message);
        }
        
        $(document).ready(function() {
            if($("#reservation-map").length > 0){
                initMap();
            }
            
            $("#address-validation").on('click', function(){
                geocoder = new google.maps.Geocoder();
                //var address = "48 Avenue Jean Moulin, 92390 Villeneuve-la-Garenne";
                var address = $("#address").val();
                geocoder.geocode( { 'address': address}, function(results, status) {
                    if(status == "ZERO_RESULTS"){
                        var msg = 'Aucune adresse trouvée...';
                        message(msg, 'warning', '#message');
                        return;
                    }
                    if (status == google.maps.GeocoderStatus.OK) {
                        var latitude = results[0].geometry.location.lat();
                        var longitude = results[0].geometry.location.lng();
                        
                        var tmp_latlng = results[0].geometry.location;
                        
                        // l'adresse demandée est bien dans le périmètre ! donc on peut créer le marker
                        if( pointInCircle(tmp_latlng, circle.radius, circle.center) ){
                            // Create a marker and set its position.
                            marker = new google.maps.Marker({
                                map: map,
                                position: {lat: latitude, lng: longitude},
                                title: 'Rendez-vous ici !'
                            });
                            markers.push(marker);
                        } else { // on annule tout
                            var msg = 'Cette adresse n\'est pas dans la zone recommandee';
                            message(msg, 'warning', '#message');
                        }
                    }
                }); 
            });
            
            $("#address").on('keyup', function(){
                // retire tous les markers de la map
                $.each(markers, function(key, value){
                    markers[key].setMap(null);
                });
                
                // remet le marker initial
                markers = [];
                markers.push(initialMarker);
                
                // Create a marker and set its position.
                initialMarker = new google.maps.Marker({
                    map: map,
                    position: myLatLng,
                    title: 'FitnessPark'
                });
            });
            
            // validation de l'adresse du formulaire avant de l'envoyer
            $("#reservation-form").on('submit', function(e){
                e.preventDefault();
                
                geocoder = new google.maps.Geocoder();
                //var address = "48 Avenue Jean Moulin, 92390 Villeneuve-la-Garenne";
                var address = $("#address").val();

                geocoder.geocode( { 'address': address}, function(results, status) {
                    if(status == "ZERO_RESULTS"){
                        var msg = 'Aucune adresse trouvée...';
                        message(msg, 'warning', '#message');
                    }
                    if (status == google.maps.GeocoderStatus.OK) {

                        var tmp_latlng = results[0].geometry.location;

                        // l'adresse demandée est bien dans le périmètre ! donc on peut créer le marker
                        if( pointInCircle(tmp_latlng, circle.radius, circle.center) ){
                            $("#reservation-form").unbind('submit');
                            return false;
                        } else { // on annule tout
                            var msg = 'Cette adresse n\'est pas dans la zone recommandee';
                            message(msg, 'warning', '#message');
                        }
                    }
                });
            });
            
            var event_selected;
            $("#daterange").on("click", function(){
                $("#daterange-modal").modal();
            });
            $("#daterange").keyup(function(){
                $("#daterange").val('');
            });
            
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
                    event_selected = event;
                    var event_id = event.description;
                    $.ajax({
                        url: 'index.php?p=reservation.getEventById',
                        data: {
                            event_id: event_id
                        },
                        success: function(response){
                            $("#delete-reservation").removeClass("disabled");
                            $("#event-description-modal #result").html(response);
                            
                            var now = moment();
                            var limit_time = now.add(4, 'hours');
                            if(event.start < limit_time){
                                $("#delete-reservation").addClass("hidden");
                            } else {
                                $("#delete-reservation").removeClass("hidden");
                                $("#confirm").attr("href", "index.php?p=reservation.askForDelete&event_id="+event_id);
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
            
            var maxDate = Date();
            $('#reservation-calendar').fullCalendar({
                timezone: 'local',
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
                    if(start < min_date){
                        $('#reservation-calendar').fullCalendar('unselect');
                        var msg = 'Il faut reserver au minimum 3 heures en avance';
                        message(msg, 'warning', '#calendar-message');
                        return;
                    }
                    
                    var duration = moment.duration(end.diff(start));
                    var hours = duration.asHours();
                    
                    if(hours < 1 || hours > 2){
                        $('#reservation-calendar').fullCalendar('unselect');
                        var msg = 'la seance doit durer entre 1h et 2h';
                        message(msg, 'warning', '#calendar-message');
                        return;
                    }
                    
                    var event_start = start.format('YYYY-MM-DD HH:mm:ss');
                    var event_end = end.format('YYYY-MM-DD HH:mm:ss');
                    
                    // on vérifie s'il y a un event qui commence juste apres
                    var is_next_reservation = function(){
                        var tmp;
                        $.ajax({
                            url: 'index.php?p=reservation.checkIfNextReservation',
                            data: {
                                reservation_time: event_end
                            },
                            async: false,
                            success: function(response){
                                tmp = response;
                            }
                        });
                        return tmp;
                    }();
                    
                    // s'il y a un résultat, on annule tout
                    if(is_next_reservation === 'true'){
                        $('#reservation-calendar').fullCalendar('unselect');
                        var msg = 'Il faut que la seance se termine 30min avant la suivante (pour laisser au coach d\'effectuer son prochain deplacement)';
                        message(msg, 'warning', '#calendar-message');
                        return;
                    }
                    
                    
                    $("#daterange").val(event_start + " - " + event_end);
                    $("#daterange-modal").modal('hide');
                },
                eventSources: [
                    'index.php?p=reservation.getAllEvents'
                ]
            });
            
            $('#daterange-modal').on('show.bs.modal', function (e) {
                $("#calendar-message").html('');
            });
            
            
            // searchCoach
            $("#coach-selection").on('change', function(){
                var coach_id = $("#coach-selection").val();
                if(coach_id == ""){
                    $("#coach-result").html("");
                    return;
                }
                $.ajax({
                    url: 'index.php?p=users.getCoachInfos',
                    data: {
                        coach_id: coach_id
                    },
                    success: function(response){
                        $("#coach-result").html(response);
                    }
                });
            });
        });
    </script>

</body>

</html>
