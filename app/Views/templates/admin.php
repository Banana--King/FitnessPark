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

    <!-- DataTables CSS -->
    <link href="/FitnessPark/public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/FitnessPark/public/bower_components/startbootstrap-sb-admin-2/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/FitnessPark/public/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
     
    <!-- FitnessPark custom CSS -->
    <link href="/FitnessPark/public/css/style.css" rel="stylesheet">
    <link href="/FitnessPark/public/bower_components/datatables.net-buttons-dt/css/buttons.datatables.css" rel="stylesheet">
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
                <a class="navbar-brand" href="index.php">FitnessPark (admin)</a>
            </div>
            <!-- /.navbar-header -->


            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="index.php?p=admin.profile.index"><i class="fa fa-user fa-fw"></i> Mon profil</a>
                        </li>
                        <li>
                            <a href="index.php?p=admin.logs.index"><i class="fa fa-book fa-fw"></i> Logs</a>
                        </li>
                        <li>
                            <a href="index.php?p=admin.users.index"><i class="fa fa-users fa-fw"></i> Utilisateurs</a>
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
    
    <!-- DataTables JavaScript -->
    <script src="/FitnessPark/public/bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
    <script src="/FitnessPark/public/bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
    <script src="/FitnessPark/public/bower_components/datatables-responsive/js/dataTables.responsive.js"></script>
    <script src="/FitnessPark/public/bower_components/datatables.net-buttons/js/dataTables.buttons.js" type="text/javascript"></script>
    <script src="/FitnessPark/public/bower_components/jszip/dist/jszip.js" type="text/javascript"></script>
    <script src="/FitnessPark/public/bower_components/pdfmake/build/pdfmake.js" type="text/javascript"></script>
    <script src="/FitnessPark/public/bower_components/pdfmake/build/vfs_fonts.js" type="text/javascript"></script>
    <script src="/FitnessPark/public/bower_components/datatables.net-buttons/js/buttons.html5.js" type="text/javascript"></script>
    
    
    <script>
        $(document).ready(function() {
            var table = $('.fitnesspark-datatable').DataTable();
            
            new $.fn.dataTable.Buttons( table, {
                buttons: [
                    'copy', 'pdf', 'excel', 'csv'
                ]
            } );
            
            table.buttons().container()
                .appendTo( $('.col-sm-6:eq(0)', table.table().container() ) );
        } );
    </script>
</body>

</html>
