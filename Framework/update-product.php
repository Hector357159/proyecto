<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
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
	if (empty($_GET)) {
    	header('Location:' . HTTP_SERVER );
	}
	require_once(DIR_DATABASE . 'db.php');
	$connection = db_connect();
	//SOLICITAMOS TODOS LOS QUERYS DE LA PAGINA
	$id = $_REQUEST['id'];
$QUERYuser = "SELECT CONCAT(user_name, ' ', user_last_name) as name,user_email FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	
$QueryGetCustomers = "select c.id_customer as id_customer,c.customer_name, c.customer_address,c.customer_number,c.date_added,co.nicename as country from customers as c,country as co where co.id_country = c.f_country;"; 
$QueryGetMessages = "SELECT m.id_message as messageid, m.f_user_sender as usersenderid, m.f_user_receiver,
(select CONCAT(u.user_name,' ',u.user_last_name) from users as u,messages as m2 where messageid =m2.id_message and u.id_user = usersenderid) as f_user_sender_name,m.message,DATE_FORMAT(date_sent, '%d de %M a las %h:%i %p') as date_sent 
FROM messages as m,users as u
WHERE u.id_user = m.f_user_receiver and m.f_user_receiver = ".$_SESSION["Us3r1D"].";";	
$QueryProductToEdit = "Select p.id_product,p.product_code,p.name_product,p.date_created,c.customer_name,c.id_customer,p.notes FROM product as p, customers as c where c.id_customer = p.f_customer and p.id_product=$id;";
$QUERYGetUserID="SELECT id_user as id_user FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";	
$QUERYGetActiveUser = "SELECT CONCAT(user_name, ' ', user_last_name) as name FROM users WHERE user_email="."'".$_SESSION["Us3rN4mE"]."'".";";
	
	//EJECUTAMOS TODOS LOS QUERY
	$result1 = mysqli_query($connection, $QUERYuser) or trigger_error("Query Failed! SQL: $QUERYuser- Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_QueryGetCustomers = mysqli_query($connection, $QueryGetCustomers) or trigger_error("Query Failed! SQL: $QueryGetCustomers - Error: ". mysqli_error($connection), E_USER_ERROR);
    $result_messages = mysqli_query($connection, $QueryGetMessages) or trigger_error("Query Failed! SQL: $QueryGetMessages - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_product = mysqli_query($connection, $QueryProductToEdit) or trigger_error("Query Failed! SQL: $QueryProductToEdit - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_idUser = mysqli_query($connection, $QUERYGetUserID) or trigger_error("Query Failed! SQL: $QUERYGetUserID - Error: ". mysqli_error($connection), E_USER_ERROR);
	$result_activeUser = mysqli_query($connection, $QUERYGetActiveUser) or trigger_error("Query Failed! SQL: $QUERYGetActiveUser - Error: ". mysqli_error($connection), E_USER_ERROR);

	$res1 = mysqli_fetch_assoc($result1);
	$user = mysqli_fetch_assoc($result_activeUser);
	$user_id = mysqli_fetch_assoc($result_idUser);
	$product = mysqli_fetch_assoc($result_product);
    
    
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
    <link href="../plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
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
                        <h4 class="page-title">MANTENIMIENTO DE PRODUCTOS</h4> </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12"> 
                        
                        <ol class="breadcrumb">
                            <li><a href="#">Panel de Control</a></li>
                            <li class="active">Productos</li>
                        </ol>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /row -->
                <div class="row">
					<div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title m-b-0">Actualizar Productos</h3>
                            <p class="text-muted m-b-30"> Verifique que la informacion sea la correcta.</p>
                            <form data-toggle="validator" action="update_product_db.go" method="POST">
                                <div class="form-group">
									<div class="row">
										<div class="form-group col-sm-6">
										<label for="product_code" class="control-label">Codigo</label>
											<input type="hidden" name="id_product" value="<?php echo $id;?>">
											<input type="text" class="form-control" id="product_code" name="product_code" value="<?php echo $product["product_code"]; ?>" placeholder="Ingrese el codigo del producto" required><div class="help-block with-errors"></div>
										</div>									
										<div class="form-group col-sm-6">
										<label for="product_code" class="control-label">Nombre</label>
											<input type="text" class="form-control" id="name_product" name="name_product" value="<?php echo $product["name_product"]; ?>" placeholder="Ingrese el nombre del producto" required><div class="help-block with-errors"></div>
										</div>
                                    </div>
                                </div>
                                <div class="form-group">
									<div class="row">
										<div class="form-group col-sm-6">
										<label class="control-label">Editado por</label>
                                                        <input type="text" class="form-control" value="<?php echo $user["name"]; ?>" readonly> 
                                                        <input type="hidden" value="<?php echo $user_id["id_user"];?>" name="usuario" id="usuario">
										</div>
										<div class="form-group col-sm-6">
										<label for="user_email" class="control-label">Cliente</label>
											<select class="form-control" name="id_customer" id="id_customer" required><div class="help-block with-errors"></div>
											<?php
												while($res1 = mysqli_fetch_assoc($result_QueryGetCustomers)){
													if($product["id_customer"]==$res1["id_customer"]){
														echo '<option selected="selected" value='.$res1["id_customer"].'>'.$res1["customer_name"].'</option>';
													}else{
														echo '<option value='.$res1["id_customer"].'>'.$res1["customer_name"].'</option>';
													}
												}
											?>
											</select>
										</div>
									</div>
                                </div>
                                <div class="form-group">
                                    <label for="textarea" class="control-label">Notas</label>
                                    <textarea id="notes" name="notes" class="form-control"><?php echo $product["notes"];?></textarea>
								</div>
                                <div class="form-group">
                                    <div class="checkbox">
                                        <input type="checkbox" id="terms" data-error="Por favor seleccione que esta de acuerdo con el registro que creara." required>
                                        <label for="terms"> Confirme que reviso toda la informacion </label>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Crear Producto</button>
                                </div>
                            </form>
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
	<script src="js/validator.js"></script>
    <script src="../plugins/bower_components/datatables/jquery.dataTables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
            $(document).ready(function () {
                var table = $('#example').DataTable({
                    "columnDefs": [
                        {
                            "visible": false
                            , "targets": 2
                        }
          ]
                    , "order": [[2, 'asc']]
                    , "displayLength": 25
                    , "drawCallback": function (settings) {
                        var api = this.api();
                        var rows = api.rows({
                            page: 'current'
                        }).nodes();
                        var last = null;
                        api.column(2, {
                            page: 'current'
                        }).data().each(function (group, i) {
                            if (last !== group) {
                                $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                                last = group;
                            }
                        });
                    }
                });
                // Order by the grouping
                $('#example tbody').on('click', 'tr.group', function () {
                    var currentOrder = table.order()[0];
                    if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                        table.order([2, 'desc']).draw();
                    }
                    else {
                        table.order([2, 'asc']).draw();
                    }
                });
            });
        });
        $('#example23').DataTable({
            dom: 'Bfrtip'
            , buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
        });
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
	<script>    
		function confirmDelete(url) {
			if (confirm("Esta seguro que desea borrar el registro? Notese que solo lo podra borrar si no existe ninguna actividad del cliente en el sistema.")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>
	<script>    
		function confirmEdit(url) {
			if (confirm("Desea editar al cliente?")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>
	<script>    
		function confirmAddProcess(url) {
			if (confirm("Desea agregar un nuevo proceso para este producto?")) {
				location.href = url;
			} else {
				false;
			}       
		}
	</script>
</body>

</html>