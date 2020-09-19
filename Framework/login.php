<?php
 // Reportamos Errores 
 
session_start();

header('Content-Type: text/html; charset=utf-8');

// Verificamos la version de PHP del servidor
if (version_compare(phpversion(), '5.1.0', '<') == true) {
	exit('PHP5.1+ Required');
} 
	
// VAMOS A TRAER LA INFORMACION DE CONFIG UNA SOLA VEZ 'require_once'
if (file_exists('system/config.php')) {
	require_once('system/config.php');
}else{
	header("Location: 500.html");
}
if(isset($_SESSION["Us3rN4mE"])){
		header('Location: index.php');
}

// COMENZAMOS EL SISTEMA
require_once(DIR_DATABASE . 'db.php');
require_once(DIR_FUNCTIONS . 'functions.php');

	$mysqli = db_connect();
	
	$error = FALSE;
	$userEncontrado = FALSE;
	$userID = "";
	$user_type = "";
	
	if(($_SERVER['REQUEST_METHOD'] == 'POST')){
		$user = isset($_POST["username"]) ? $_POST["username"] : "";
		$pass = isset($_POST["password"]) ? $_POST["password"] : "";
		
		$query = "SELECT u.id_user AS id_user, u.user_email AS user_email, u.user_password AS user_password, utn.users_type_name AS user_type FROM users AS u, users_type AS utn WHERE u.f_User_type = utn.id_users_type;";
		$resultado = mysqli_query($mysqli, $query) or trigger_error("Query Failed! SQL: $query - Error: ". mysqli_error($mysqli), E_USER_ERROR);
		while($row = mysqli_fetch_assoc($resultado)){
			if(strcmp($user, $row["user_email"]) == 0 && strcmp($pass, $row["user_password"]) == 0){
				$userEncontrado = TRUE;
				$userID = $row["id_user"];
				$user_type = $row["user_type"];
				break;
			}
		}
		if($userEncontrado){
			$_SESSION["Us3rN4mE"] = $user;
			$_SESSION["Us3r1D"] = $userID;
			$_SESSION["Us3r_Typ3"] = $user_type;
			$ip_address = get_client_ip_server();

			$sql = "INSERT INTO logs_auth (fUserID, ip_address) VALUES ($userID, '$ip_address');";
			if(mysqli_query($mysqli, $sql)){
				echo "Login Added.";
			} else{
				echo "ERROR: Could not able to execute $sql. " . mysqli_error($mysqli);
			}

			$QueryGetLoginID = "Select MAX(idlog_auth) as idlog_auth from logs_auth where fUserID =$userID;";
			$result_QueryGetLoginID = mysqli_query($mysqli, $QueryGetLoginID) or trigger_error("Query Failed! SQL: $QueryGetLoginID - Error: ". mysqli_error($mysqli), E_USER_ERROR);
			$res1 = mysqli_fetch_assoc($result_QueryGetLoginID);
			$_SESSION["Us3r_L0g1D"] = $res1["idlog_auth"];
			
			$querySettings = "SELECT	v.view_location, us.language
					  		  FROM 		user_settings as us, views as v
					  		  WHERE		us.f_view = v.id_view AND
					  					us.f_user = $userID;";
		$res_settings = mysqli_query($mysqli, $querySettings) or trigger_error("Query Failed! SQL: $querySettings - Error: ". mysqli_error($mysqli), E_USER_ERROR);
		$res2 =mysqli_fetch_assoc($res_settings);

			// close connection
			mysqli_close($mysqli);

			
			header('Location: '.$res2["view_location"]);
				
		}
		else{
			$error = TRUE;
		}		
			}
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
<title>Sistema de Control de Producciones - Produses S.A. de C.V.</title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/blue.css" id="theme"  rel="stylesheet">
<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body>
<!-- Preloader -->
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>
<section id="wrapper" class="login">
  <div class="login-box">
    <div class="white-box">
      <form class="form-horizontal form-material" id="loginform" action="login.go" method="post">
        <a href="javascript:void(0)" class="text-center db"><img src="resources/produses-logo.png" alt="Home" /><br/></a>  
        
        <div class="form-group m-t-40">
          <div class="col-xs-12">
            <input id="username" name="username" class="form-control" type="text" required="" placeholder="Usuario">
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-12">
            <input id="password" name="password" class="form-control" type="password" required="" placeholder="Clave">
          </div>
        </div>
        <div class="form-group">
          <div class="col-md-12">
            <div class="checkbox checkbox-primary pull-left p-t-0">
              <input id="checkbox-signup" type="checkbox">
              <label for="checkbox-signup"> Recuerdame </label>
            </div>
            <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i class="fa fa-lock m-r-5"></i> Olvido su clave?</a> </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Ingresar</button>
          </div>
        </div>
        
      </form>
      <form class="form-horizontal" id="recoverform" action="index.html">
        <div class="form-group ">
          <div class="col-xs-12">
            <h3>Recupere su Clave</h3>
            <p class="text-muted">Ingrese su correo electronico y se le enviaran instrucciones.</p>
          </div>
        </div>
        <div class="form-group ">
          <div class="col-xs-12">
            <input class="form-control" type="text" required="" placeholder="Email">
          </div>
        </div>
        <div class="form-group text-center m-t-20">
          <div class="col-xs-12">
            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
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
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
</body>
</html>
