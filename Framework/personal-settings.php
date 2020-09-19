<?php
session_start();

	if(!isset($_SESSION["Us3rN4mE"])){
		header('Location: login.php');
	}
	// VAMOS A TRAER LA INFORMACION DE CONFIG UNA SOLA VEZ 'require_once'
	if (file_exists('/home/irvincabezas/public_html/production/app/system/config.php')) {
		require_once('/home/irvincabezas/public_html/production/app/system/config.php');
	}else{
		header("Location: http://imagine-studio-solutions.com/production/app/500.html");
	}
	require_once(DIR_DATABASE . 'db.php');
	require_once(DIR_FUNCTIONS . 'functions.php');
	$connection = db_connect();
	//SOLICITAMOS TODOS LOS QUERYS DE LA PAGINA
	$QUERYuser = 			"SELECT 	CONCAT(user_name, ' ', user_last_name) as name,user_email 
							 FROM 		users 
							 WHERE 		user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	$QueryGetUsers = 		"SELECT 	u.id_user as id_user, u.user_name as user_name, u.user_last_name as user_last_name, u.user_email as user_email,u.user_password as password,ut.users_type_name as users_type_name, date_format(u.date_added, '%Y-%m-%d') AS date_added
							 FROM 		users as u, users_type as ut
							 WHERE 		u.f_User_Type = ut.id_users_type AND u.id_user NOT IN (SELECT (SELECT u2.id_user from users as u2 WHERE u2.id_user=ow.f_operator_user) AS operator
							 FROM 		operator_x_workgroup ow, daily_workgroup dw
							 WHERE 		ow.f_group = dw.id_daily_workgroup AND
							 				DAY(dw.date_created) = DAY(NOW()) AND
							 				MONTH(dw.date_created) = MONTH(NOW()) AND
							 				YEAR(dw.date_created) = YEAR(NOW()));"; 
	$QueryGetMessages = 	"SELECT 	m.id_message as messageid, m.f_user_sender as usersenderid, m.f_user_receiver,
							 			(select CONCAT(u.user_name,' ',u.user_last_name) from users as u,messages as m2 where messageid =m2.id_message and u.id_user = usersenderid) as f_user_sender_name,m.message,DATE_FORMAT(date_sent, '%d de %M a las %h:%i %p') as date_sent 
							 FROM 		messages as m,users as u
							 WHERE 		u.id_user = m.f_user_receiver and m.f_user_receiver = ".$_SESSION["Us3r1D"].";";	
	$QueryGetUserTypes = 	"SELECT 	id_users_type,users_type_name 
							 FROM 		users_type;";
	$QueryGetViews = 		"SELECT 	v.id_view, v.view_name
					  		 FROM 		views as v;";
	$QueryGetSelectedView = "SELECT 	us.f_view
							 FROM 		user_settings as us, views as v
							 WHERE		us.f_view = v.id_view AND
							 			us.f_user = ".$_SESSION["Us3r1D"].";";
	$QueryGetSettingsID = 	"SELECT 	us.iduser_settings,us.f_view,us.language
							 FROM 		user_settings as us, views as v
							 WHERE		us.f_view = v.id_view AND
							 			us.f_user = ".$_SESSION["Us3r1D"].";";						 



	
	//EJECUTAMOS TODOS LOS QUERY
	$result1 = 					mysqli_query($connection, $QUERYuser) or trigger_error("Query Failed! SQL: $QUERYuser- Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_QueryGetUsers = 	mysqli_query($connection, $QueryGetUsers) or trigger_error("Query Failed! SQL: $QueryGetUsers - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_messages = 			mysqli_query($connection, $QueryGetMessages) or trigger_error("Query Failed! SQL: $QueryGetMessages - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_user_type = 		mysqli_query($connection, $QueryGetUserTypes) or trigger_error("Query Failed! SQL: $QueryGetUserTypes - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_GetViews = 			mysqli_query($connection, $QueryGetViews) or trigger_error("Query Failed! SQL: $QueryGetViews - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_GetSelectedView = 	mysqli_query($connection, $QueryGetViews) or trigger_error("Query Failed! SQL: $QueryGetViews - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_GetSettingsID = 	mysqli_query($connection, $QueryGetSettingsID) or trigger_error("Query Failed! SQL: $QueryGetSettingsID - Error: ". mysqli_error($connection), E_USER_ERROR);


	$res1 = mysqli_fetch_assoc($result1);
	$res2 = mysqli_fetch_assoc($result_GetSettingsID);

	$id_settings = $res2["iduser_settings"];
	$f_user_view= $res2["f_view"];
	$f_user_language = $res2["language"];
    
	mysqli_close($connection);
	  
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="../plugins/images/favicon.png">
    <title>Ample Admin Template - The Ultimate Multipurpose admin template</title>
    <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- xeditable css -->
    <link href="../plugins/bower_components/x-editable/dist/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet" />
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
<![endif]-->
</head>

<body class="fix-header">
    <!-- ============================================================== -->
    <!-- Preloader -->
    <!-- ============================================================== -->
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
        </svg>
    </div>
    <!-- ============================================================== -->
    <!-- Wrapper -->
    <!-- ============================================================== -->
    <div id="wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <nav class="navbar navbar-default navbar-static-top m-b-0">
            <div class="navbar-header">
                 <?php include 'views/general/header.php';  ?>
            </div>
            <!-- /.navbar-header -->
            <!-- /.navbar-top-links -->
            <!-- /.navbar-static-side -->
        </nav>
        <!-- End Top Navigation -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav slimscrollsidebar">
                <div class="sidebar-head">
                    <h3><span class="fa-fw open-close"><i class="ti-menu hidden-xs"></i><i class="ti-close visible-xs"></i></span> <span class="hide-menu">Navigation</span></h3> </div>
                <?php include 'views/general/menu.php';  ?>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Left Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page Content -->
        <!-- ============================================================== -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">MANTENIMIENTO DE USUARIOS</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Panel de Control</a></li>
                            <li class="active">Usuarios</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
				 <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Configuracion Personal</h3>
                            <p class="text-muted m-b-30 font-13"> Inline editor</p>
                            <div class="row">
                                <div class="col-md-12">
                                    <table style="clear: both" class="table table-bordered table-striped" id="user">
                                        <tbody>
	                                        
                                            <tr>
                                                <td width="35%">Seleccione su pagina de inicio de prefencia</td>
                                                <td width="65%">
                                                    <a href="#" id="f_views" name="f_views" data-name="f_views" data-type="select" data-url="update_user_settings_view.go"  data-pk="<?echo $id_settings;?>" data-value="<?echo $f_user_view;?>"></a>                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Idioma del Sistema</td>
                                                <td>
                                       
                                                    <a href="#" id="f_lang" name="f_lang" data-name="f_lang" data-type="select" data-url="update_user_settings_language.go"  data-pk="<?echo $id_settings;?>" data-value="<?echo $f_user_language;?>"></a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Service Panel <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul id="themecolors" class="m-t-20">
                                <li><b>With Light sidebar</b></li>
                                <li><a href="javascript:void(0)" theme="default" class="default-theme">1</a></li>
                                <li><a href="javascript:void(0)" theme="green" class="green-theme">2</a></li>
                                <li><a href="javascript:void(0)" theme="gray" class="yellow-theme">3</a></li>
                                <li><a href="javascript:void(0)" theme="blue" class="blue-theme">4</a></li>
                                <li><a href="javascript:void(0)" theme="purple" class="purple-theme">5</a></li>
                                <li><a href="javascript:void(0)" theme="megna" class="megna-theme">6</a></li>
                                <li><b>With Dark sidebar</b></li>
                                <br/>
                                <li><a href="javascript:void(0)" theme="default-dark" class="default-dark-theme">7</a></li>
                                <li><a href="javascript:void(0)" theme="green-dark" class="green-dark-theme">8</a></li>
                                <li><a href="javascript:void(0)" theme="gray-dark" class="yellow-dark-theme">9</a></li>
                                <li><a href="javascript:void(0)" theme="blue-dark" class="blue-dark-theme working">10</a></li>
                                <li><a href="javascript:void(0)" theme="purple-dark" class="purple-dark-theme">11</a></li>
                                <li><a href="javascript:void(0)" theme="megna-dark" class="megna-dark-theme">12</a></li>
                            </ul>
                            <ul class="m-t-20 all-demos">
                                <li><b>Choose other demos</b></li>
                            </ul>
                            <ul class="m-t-20 chatonline">
                                <li><b>Chat option</b></li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/varun.jpg" alt="user-img" class="img-circle"> <span>Varun Dhavan <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/genu.jpg" alt="user-img" class="img-circle"> <span>Genelia Deshmukh <small class="text-warning">Away</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/ritesh.jpg" alt="user-img" class="img-circle"> <span>Ritesh Deshmukh <small class="text-danger">Busy</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/arijit.jpg" alt="user-img" class="img-circle"> <span>Arijit Sinh <small class="text-muted">Offline</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/govinda.jpg" alt="user-img" class="img-circle"> <span>Govinda Star <small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/hritik.jpg" alt="user-img" class="img-circle"> <span>John Abraham<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/john.jpg" alt="user-img" class="img-circle"> <span>Hritik Roshan<small class="text-success">online</small></span></a>
                                </li>
                                <li>
                                    <a href="javascript:void(0)"><img src="../plugins/images/users/pawandeep.jpg" alt="user-img" class="img-circle"> <span>Pwandeep rajan <small class="text-success">online</small></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- /.container-fluid -->
            <footer class="footer text-center"> 2017 &copy; Ample Admin brought to you by themedesigner.in </footer>
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- Dropzone Plugin JavaScript -->
    <!-- jQuery x-editable -->
    <script src="../plugins/bower_components/moment/moment.js"></script>
    <script type="text/javascript" src="../plugins/bower_components/x-editable/dist/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script type="text/javascript">
        $(function () {
            //editables 
            $('#username').editable({
                type: 'text'
                , pk: 1
                , name: 'username'
                , title: 'Enter username'
            });
            $('#firstname').editable({
                validate: function (value) {
                    if ($.trim(value) == '') return 'This field is required';
                }
            });
            $('#sex').editable({
               source: [
                    <?
								$num_views = mysqli_num_rows($result_GetViews);
								$i_views = 0;
								while($row= mysqli_fetch_assoc($result_GetViews)){
									$i_views = $i_views + 1;
									echo '{';
									echo 'value: ' . $row["id_view"];
									echo ', text: ' . "'".$row["view_name"]."'";
									echo '}';
									if($num_views!=$i_views){
										echo ',';
									}                          
								}
								mysqli_data_seek($result_GetViews,0);
								
							?>
      ]
                , display: function (value, sourceData) {
                    var colors = {
                            "": "#98a6ad"
                            , 1: "#5fbeaa"
                            , 2: "#5d9cec"
                        }
                        , elem = $.grep(sourceData, function (o) {
                            return o.value == value;
                        });
                    if (elem.length) {
                        $(this).text(elem[0].text).css("color", colors[value]);
                    }
                    else {
                        $(this).empty();
                    }
                }
            });
            $('#status').editable();
            $('#group').editable({
                showbuttons: false
            });
            $('#dob').editable();
            $('#comments').editable({
                showbuttons: 'bottom'
            });
            //inline
            $('#inline-username').editable({
                type: 'text'
                , pk: 1
                , name: 'username'
                , title: 'Enter username'
                , mode: 'inline'
            });
            $('#inline-firstname').editable({
                validate: function (value) {
                    if ($.trim(value) == '') return 'This field is required';
                }
                , mode: 'inline'
            });
            $('#f_views').editable({
				  mode: 'inline'
                , source: [
                    <?
								$num_views = mysqli_num_rows($result_GetViews);
								$i_views = 0;
								while($row= mysqli_fetch_assoc($result_GetViews)){
									$i_views = $i_views + 1;
									echo '{';
									echo 'value: ' . $row["id_view"];
									echo ', text: ' . "'".$row["view_name"]."'";
									echo '}';
									if($num_views!=$i_views){
										echo ',';
									}                          
								}
								mysqli_data_seek($result_GetViews,0);
								
							?>
      ]
                , display: function (value, sourceData) {
                    var colors = {
                            "": "#98a6ad"
                            , 1: "#5fbeaa"
                            , 2: "#5d9cec"
                        }
                        , elem = $.grep(sourceData, function (o) {
                            return o.value == value;
                        });
                    if (elem.length) {
                        $(this).text(elem[0].text).css("color", colors[value]);
                    }
                    else {
                        $(this).empty();
                    }
                }
            });
            $('#f_lang').editable({
				  mode: 'inline'
                , source: [
                   {
								value: 'ES'
								, text: 'Español'
					}
					,
					{
								value: 'EN'
								, text: 'English'
					}
      ]
                , display: function (value, sourceData) {
                    var colors = {
                            "": "#98a6ad"
                            , 1: "#5fbeaa"
                            , 2: "#5d9cec"
                        }
                        , elem = $.grep(sourceData, function (o) {
                            return o.value == value;
                        });
                    if (elem.length) {
                        $(this).text(elem[0].text).css("color", colors[value]);
                    }
                    else {
                        $(this).empty();
                    }
                }
            });
            $('#inline-status').editable({
                mode: 'inline'
            });
            $('#inline-group').editable({
                showbuttons: false
                , mode: 'inline'
            });
            $('#inline-dob').editable({
                mode: 'inline'
            });
            $('#inline-comments').editable({
                showbuttons: 'bottom'
                , mode: 'inline'
            });
        });
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>

</html>