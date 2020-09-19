<?php
 include('menu/requirelanguage.php');
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
<title>RCAR</title>
<!-- Bootstrap Core CSS -->
<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- animation CSS -->
<link href="css/animate.css" rel="stylesheet">
<!-- Wizard CSS -->
<link href="../plugins/bower_components/register-steps/steps.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="css/style.css" rel="stylesheet">
<!-- color CSS -->
<link href="css/colors/default.css" id="theme"  rel="stylesheet">
<!-- Date picker plugins css -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="../plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
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
<section id="wrapper" class="step-register">
  <div class="register-box">
    <div class="">
        <a href="javascript:void(0)" class="text-center db m-b-40">
            <h1>flyline</h1>
        </a>
      <!-- multistep form -->
        <form id="msform" method="POST" action="registro.php">
        <!-- progressbar -->
            <ul id="eliteregister">
                <li class="active"><?php echo $registrouser ; ?></li>

            </ul>
            <p class="text-center">
                <?php echo $tienecuenta; ?> <a href="Login.php"><?php echo $iniciarSesion ?></a>
            </p><br>
            <!-- fieldsets -->
           
            <fieldset>
                <h2 class="fs-title"><?php echo $registrouser ; ?></h2>
                <h3 class="fs-subtitle"><?php echo $datosdeuser; ?></h3>
                <input type="text" name="txtuser" required="" data-mask="" placeholder="<?php echo $user; ?>">
                <input type="password" name="pasword" required="" data-mask="" placeholder="<?php echo $pasword; ?>" />
                <input type="password" name="pasword1" required="" data-mask="" placeholder="<?php echo $paswordr; ?>" />
                 <input type="email" name="gmail" required="" data-mask="" placeholder="Gmail" />
                <input type="submit" name="" value="<?php echo $enviar; ?>">
                
            </fieldset>
        </form>

        <script type="text/javascript">
            
            function inseruser(){

                document.form_user.submit();

            }

        </script>
        <div class="clear"></div>
    </div>
  </div>
</section>
<!-- jQuery -->
<script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Menu Plugin JavaScript -->
<script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
<script src="../plugins/bower_components/register-steps/jquery.easing.min.js"></script>
<script src="../plugins/bower_components/register-steps/register-init.js"></script>
<!--slimscroll JavaScript -->
<script src="js/jquery.slimscroll.js"></script>
<!--Wave Effects -->
<script src="js/waves.js"></script>
<!-- Custom Theme JavaScript -->
<script src="js/custom.min.js"></script>
<!--Style Switcher -->
<script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
<!-- Page plugins css -->
    <link href="../plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="../plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="../plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
</body>
</html>
