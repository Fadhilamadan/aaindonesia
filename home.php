<?php
session_start();
require './db.php';

$sqlU = "SELECT * FROM `users`,`employees` WHERE users.employee_id = employees.id AND users.username = '".$_COOKIE['idU']."'";
$resultU = mysqli_query($link, $sqlU);
$rowU = mysqli_fetch_array($resultU);
if(!$resultU) {
    echo "SQL ERROR: ".$sqlU;
}

if(!isset($_COOKIE['loginU'])) {
    header('location: login.php');
}
if($rowU['nama'] == null){
    header('location: proses.php?cmd=logout');
}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Home</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS -->
    <link href="assets/css/paper-dashboard.css?v=1.2.1" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />

    <!-- Animation library for notifications -->
    <link href="assets/css/animate.min.css" rel="stylesheet"/>

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="assets/css/themify-icons.css" rel="stylesheet">

</head>
<body>
    <div class="wrapper">
        <!-- Menu -->
        <div class="sidebar" data-background-color="brown" data-active-color="danger"> <div class="logo"> <a href="home.php" class="simple-text logo-mini"> AA Indonesia </a> <a href="home.php" class="simple-text logo-normal"> AA Indonesia </a> </div><div class="sidebar-wrapper"> <ul class="nav"> <li class="active"> <a href="home.php"> <i class="ti-panel"></i> <p>Dashboard</p></a> </li><li> <a data-toggle="collapse" href="#agentExamples"> <i class="ti-user"></i> <p>Agent <b class="caret"></b> </p></a> <div class="collapse" id="agentExamples"> <ul class="nav"> <li> <a href="agent/info.php"> <span class="sidebar-mini">I</span> <span class="sidebar-normal">Info</span> </a> </li><li> <a href="agent/daftar.php"> <span class="sidebar-mini">D</span> <span class="sidebar-normal">Daftar</span> </a> </li></ul> </div></li><li> <a data-toggle="collapse" href="#cabangExamples"> <i class="ti-home"></i> <p> Cabang <b class="caret"></b> </p></a> <div class="collapse" id="cabangExamples"> <ul class="nav"> <li> <a href="cabang/info.php"> <span class="sidebar-mini">I</span> <span class="sidebar-normal">Info</span> </a> </li><li> <a href="cabang/daftar.php"> <span class="sidebar-mini">D</span> <span class="sidebar-normal">Daftar</span> </a> </li></ul> </div></li><li> <a href="closing.php"> <i class="ti-pencil-alt"></i> <p> Closing </p></a> </li><li> <a data-toggle="collapse" href="#laporanExamples"> <i class="ti-stats-up"></i> <p> Laporan <b class="caret"></b> </p></a> <div class="collapse" id="laporanExamples"> <ul class="nav"> <li> <a href="laporan/rekapitulasi.php"> <span class="sidebar-mini">RK</span> <span class="sidebar-normal">Rekapitulasi</span> </a> </li><li> <a href="laporan/komisi.php"> <span class="sidebar-mini">KM</span> <span class="sidebar-normal">Komisi</span> </a> </li><li> <a href="laporan/unit"> <span class="sidebar-mini">UN</span> <span class="sidebar-normal">Unit</span> </a> </li><li> <a href="laporan/aktif.php"> <span class="sidebar-mini">AK</span> <span class="sidebar-normal">Aktif</span> </a> </li><li> <a href="laporan/pasif.php"> <span class="sidebar-mini">PS</span> <span class="sidebar-normal">Pasif</span> </a> </li></ul> </div></li><li> <a href="pengaturan.php"> <i class="ti-settings"></i> <p> Pengaturan </p></a> </li></ul> </div></div>
        <!-- Menu -->

        <div class="main-panel">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse">

                        <a class="navbar-brand" href="home.php">Dashboard</a>

                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a>
                                    <i class="ti-user"></i>
                                    <p>
                                        <?php echo $rowU['nama'];?>   
                                    </p>
                                </a>                                  
                            </li>
                            <li>
                                <a href="proses.php?cmd=logout">
                                    <i class="ti-power-off"></i>
                                    <p>
                                        Logout
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="numbers pull-left" id="hasilKomisi"></div>
                                        </div>
                                    </div>
                                    <h6 class="big-title">Total Komisi Bulan Ini<span class="text-muted"> dalam juta</span></h6>
                                    <div id="chartKomisi"></div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-content">
                                    <div class="row">
                                        <div class="col-xs-7">
                                            <div class="numbers pull-left" id="hasilUnit"></div>
                                        </div>
                                    </div>
                                    <h6 class="big-title">Total Unit Terjual Bulan Ini</h6>
                                    <div id="chartUnit"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <br/><footer class="footer"> <div class="container-fluid"> <nav class="pull-left"> <ul> <li> <a href="#"> Media Solution </a> </li><li> <a href="#"> Blog </a> </li><li> <a href="#"> Licenses </a> </li></ul> </nav> <div class="copyright pull-right"> &copy; <script>document.write(new Date().getFullYear())</script> - Made with <i class="fa fa-heart heart"></i> by <a href="#">Media Solution</a> </div></div></footer>
        </div>
    </div>

<script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582CL4NjpNgssKAz6JMkPltAPvhVgLvKlTyG2Q11ufhKxvls%2b8rFsEzchpoITXnhMJFZld3kCxvoNkNPdSGq2TK2v2KoYMSUVA%2fRJ8BGERO2px0q4sLTPEm9fUuNuLFnySTHe4rKMiVTFxzcx8n7HsaQFwVEyjcKFBhkyxu22Wv%2fOkug1QYCC8c53H1tyHX0DwMT3kwOtKb7Pd6d%2fZyWJMhwMIlSRie7MjjQkiZIZlwTOaqTwZnJ0bnnsAEwI6kB%2ffkvG98edF7%2bNYHlQTs9IqhcuHwDJeoUt5MC6UYm12Ow1kfcGZLMQ%2fzAI67OTHn5Hh%2bV2u%2bWlCakD5DO1DZreCnzBJGUgasGQ8CC03skMa4OoNtUe5tVfYln6XYMf2PnTyxn31eoe1fCtXp6jcqWhudE7v6HNOLwqR6WniFk2hpic29awXcEGr6uk7CWaq%2fW6E5uSf8uect1F3yAT9IHca9agjmyu%2bqk%2f5HfEJUuawf4zpVC5FdRyAQzLwBTUi1ByX7LcRxJzibYJ3G%2bE3Efd7g0a%2b7Tefj0bfZeqoD7eB3rJ5phfNTt04G0Iy0%2bO5LJMGA%2fJHJ8YYeTp2prakOqivYnA3w%2fIvn8B8HfBmrugQ7wyGpSSkLijr5wgT2jVePhr8ATCZICeiEeMG2KmGB5qficquy0AOL5Esbb35sfVSUbBq1lDSygllLluf6lx75BFS0ewDgjBSQOhUliXezxocRE1CnFjzZG3aOm0DwRrMYopRpE25GHtYghrKotUSSpacXSsjbOyKGL%2fohRkQV%2biLkXWGVfamefhj7Rstqx3YVwHP4l7JxT9eaQc7tN9gXikwh2rvAquOV3UGCh8uXx3Yn8u9axvDPtApe8K8EdBmDCTDRuRIj2%2bWMEIEk2%2bsW1k8Qw%3d%3d" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script></body>

    <!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
    <script src="assets/js/jquery-3.1.1.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Forms Validations Plugin -->
    <script src="assets/js/jquery.validate.min.js"></script>

    <!-- Promise Library for SweetAlert2 working on IE -->
    <script src="assets/js/es6-promise-auto.min.js"></script>

    <!--  Plugin for Date Time Picker and Full Calendar Plugin-->
    <script src="assets/js/moment.min.js"></script>

    <!--  Date Time Picker Plugin is included in this js file -->
    <script src="assets/js/bootstrap-datetimepicker.js"></script>

    <!--  Select Picker Plugin -->
    <script src="assets/js/bootstrap-selectpicker.js"></script>

    <!--  Switch and Tags Input Plugins -->
    <script src="assets/js/bootstrap-switch-tags.js"></script>

    <!-- Circle Percentage-chart -->
    <script src="assets/js/jquery.easypiechart.min.js"></script>

    <!--  Charts Plugin -->
    <script src="assets/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="assets/js/bootstrap-notify.js"></script>

    <!-- Sweet Alert 2 plugin -->
    <script src="assets/js/sweetalert2.js"></script>

    <!-- Vector Map plugin -->
    <script src="assets/js/jquery-jvectormap.js"></script>

    <!-- Wizard Plugin    -->
    <script src="assets/js/jquery.bootstrap.wizard.min.js"></script>

    <!--  Bootstrap Table Plugin    -->
    <script src="assets/js/bootstrap-table.js"></script>

    <!--  Plugin for DataTables.net  -->
    <script src="assets/js/jquery.datatables.js"></script>

    <!--  Full Calendar Plugin    -->
    <script src="assets/js/fullcalendar.min.js"></script>

    <!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
    <script src="assets/js/paper-dashboard.js?v=1.2.1"></script>

    <!--   Sharrre Library    -->
    <script src="assets/js/jquery.sharrre.js"></script>

    <!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
    <script src="assets/js/demo.js"></script>

    <script type="text/javascript">
        function fGanti(a){
            var x = a.toLocaleString(['ban', 'id']);
            return x;
        }
        $.ajax({
            url     : 'proses.php?cmd=chart_unit',
            success: function(data){
                var x = JSON.parse(data);

                Chartist.Bar('#chartUnit', {
                  labels: x.tanggal,
                  series: [
                    x.total
                  ]
                }, {
                  height: '500px',
                  seriesBarDistance: 10,
                  reverseData: false,
                  horizontalBars: false,
                  axisY: {
                    offset: 70
                  }
                });

                $('#hasilUnit').html(x.semua+' Unit');
            }
        })
        $.ajax({
            url     : 'proses.php?cmd=chart_komisi',
            success: function(data){
                var x = JSON.parse(data);

                Chartist.Bar('#chartKomisi', {
                  labels: x.nama,
                  series: [
                    x.total
                  ]
                }, {
                  height: '500px',
                  seriesBarDistance: 10,
                  reverseData: false,
                  horizontalBars: false,
                  axisY: {
                    offset: 70
                  }
                });

                $('#hasilKomisi').html('Rp '+fGanti(x.semua))
            }
        })
        
        
    </script>

</html>