<?php 
 //Incluir la conexion para consultar la base de datos

        include('Conexion.php');
        



        //Inicio de session

        session_start();



        //resireccionar si no es admin a indexCriente

         if ($_SESSION['tipo_session'] != 0 ) {
            
        header("location: indexCriente.php");

        }
       //Validacion para que solo se pueda iniciar session por el login y no por url
        if(isset($_SESSION['user'])){



        }else{

            header("location: login.php");

        }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <?php
    include 'menu/menuadmin.php';
     ?>
    
    <!--alerts CSS -->
    <link href="../plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
    <!-- Menu CSS -->
    <link href="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <!-- Wizard CSS -->
    <link href="../plugins/bower_components/jquery-wizard-master/css/wizard.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="css/animate.css" rel="stylesheet">
   
    
    <!-- Page plugins css -->
    <link href="../plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="../plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="../plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
</head>
<body>
	      
        <form class="floating-labels" method="POST" Action="PHP/insertar_voleto.php">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box p-l-20 p-r-20">
                                <h1 class="box-title m-b-0">
                                   <?php echo $regisv ;?>
                                </h1>
                                <p class="text-muted m-b-30 font-13">
                                    <?php echo $campos; ?>
                                </p><div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="text" placeholder="<?php echo $entry ; ?>" id="txtFechaStart" class="form-control" name="Dsalida">
                                                            <span>.  .</span>
                                                            <input type="text" id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada">
                                                        </div>
                                                    </div>
                                                </div>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Psalida" id="Psalida" class="form-control input-lg"  required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Pentrada" id="Pentrada" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="time" name="Hsalida" id="Hsalida" class="form-control input-lg"  required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="time" name="Hentrada" id="Hentrada" class="form-control input-lg"  required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?> </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">,
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Ttotal" id="Ttotal" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="presio" id="presio" data-mask="$999.99" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input7"><?php echo $presio; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="aerolinea" id="aerolinea" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto" data-mask="9999" id="Nvoleto2" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <h1 class="text-muted m-b-30 font-13">
                                            <?php echo $Nescalas; ?>
                                        </h1>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group m-b-40 has-success">
                                                    <input type="radio" name="escala1" value="escala_11" id="radio1" onclick="hola()" class="form-control input-lg" >
                                                    <label for="txtDescripcion"><?php echo $escala1; ?></label>
                                                   

                                                </div>
                                            </div>
                                            <?php  /*
                                            <div class="col-md-2">
                                                <div class="form-group m-b-40 has-success">
                                                    <input type="radio" name="escala1" value="escala_22" onclick="hola()"id="Input7" class="form-control input-lg" >
                                                    
                                                    <label for="txtDescripcion"><?php echo $escala2; ?></label>

                                                </div>
                                            </div>
                                             <div class="col-md-2">
                                                <div class="form-group m-b-40 has-success">
                                                    <input type="radio" name="escala1" value="escala_33" onclick="hola()" id="Input7" class="form-control input-lg" >
                                                    
                                                    <label for="txtDescripcion"><?php echo $escala3; ?></label>

                                                </div>
                                            </div>
                                        </div>
                                        ?>
                                        */?>
                                    <div id="escala_1">
                                       <h1><?php echo $escala1 ?></h1>
                                        <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="date" placeholder="<?php echo $entry ; ?>" id="txtFechaStart" class="form-control" name="Dsalida1">
                                                            <span>.  .</span>
                                                            <input type="date" id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada1">
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Psalida1" id="Psalida1" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text"name="Pentrada1" id="Pentrada1" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="time" name="Hsalida1" id="Hsalida1" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="time" name="Hentrada1" id="Hentrada1" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Ttotal1" id="Ttotal1" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="aerolinea1" id="aerolinea1" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto1" data-mask="9999" id="Nvoleto1" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        
                                     <?php  /*
                                    <div id="escala_2">
                                        <h1>escala 1</h1>
                                        <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="date" placeholder="<?php echo $entry ; ?>" id="txtFechaStart" class="form-control" name="Dsalida2">
                                                            <span>.  .</span>
                                                            <input type="date" id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada2">
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Psalida2" id="Psalida2" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Pentrada2" id="Pentrada2" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="time" name="Hsalida2" id="Hsalida2" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="time" name="Hentrada2" id="Hentrada2" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Ttotal2" id="Ttotal2" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="presio2" id="presio2" data-mask="$999.99" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input7"><?php echo $presio; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="aerolinea2" id="aerolinea2" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto2" data-mask="9999" id="Nvoleto2" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <h1>èscara 2</h1>
                                        <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="date" placeholder="<?php echo $entry ; ?>" id="txtFechaStart" class="form-control" name="Dsalida22">
                                                            <span>.  .</span>
                                                            <input type="date" id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada22">
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Psalida22" id="Psalida22" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Pentrada22" id="Pentrada22" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="time" name="Hsalida22" id="Hsalida22" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="time" name="Hentrada22" id="Hentrada22" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Ttotal22" id="Ttotal22" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="presio22" id="presio22" data-mask="$999.99" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input7"><?php echo $presio; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="aerolinea22" id="aerolinea22" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto22" data-mask="9999" id="Nvoleto22" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                            
                                    </div>
                                    <div id="escala_3">
                                        <h1>escala 1</h1>
                                           <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="text" placeholder="<?php echo $entry ; ?>" id="txtFechaStart" class="form-control" name="Dsalida3">
                                                            <span>.  .</span>
                                                            <input type="text" id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada3">
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Psalida3" id="Psalida3" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Pentrada3" id="Pentrada3" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="time" name="Hsalida3" id="Hsalida3" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="time" name="Hentrada3" id="Hentrada3" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Ttotal3" id="Ttotal3" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="presio3" id="presio3" data-mask="$999.99" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input7"><?php echo $presio; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="aerolinea3" id="aerolinea3" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto3"  data-mask="9999"id="Nvoleto3" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <h1>escala 2</h1>
                                         <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="text" placeholder="<?php echo $entry ; ?>" id="txtFechaStart" class="form-control" name="Dsalida32">
                                                            <span>.  .</span>
                                                            <input type="text" id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada32">
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Psalida32" id="Psalida32" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Pentrada32" id="Pentrada32" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="time" name="Hsalida32" id="Hsalida32" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="time" name="Hentrada32" id="Hentrada32" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Ttotal32" id="Ttotal32" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="presio32" id="presio32" data-mask="$999.99" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input7"><?php echo $presio; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="aerolinea32" id="aerolinea32" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto32" data-mask="9999" id="Nvoleto32" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <h1>escala 3</h1>
                                        <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="text" placeholder="<?php echo $entry ; ?>" id="txtFechaStart" class="form-control" name="Dsalida33">
                                                            <span>.  .</span>
                                                            <input type="text" id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada33">
                                                        </div>
                                                    </div>
                                                </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Psalida33" id="Psalida33" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Pentrada33" id="Pentrada33" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="time" name="Hsalida33" id="Hsalida33" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="time" name="Hentrada33" id="Hentrada33" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="Ttotal33" id="Ttotal33" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="presio33" id="presio33" data-mask="$999.99" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input7"><?php echo $presio; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" name="aerolinea33" id="aerolinea33" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto33" data-mask="9999" id="Nvoleto33" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    */?>
                                        
                                    </div>
                                    <div class="row">
                                            <div class="col-md-6">
                                                
                                            </div>
                                            <div class="col-md-6">
                                                <input type="submit" name="btnEnviar" value="<?php echo $enviar ;?>" class="btn btn-success">
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
                <script type="text/javascript">
                    jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true
            , todayHighlight: true
        });
                                                   $('#datepicker').datepicker({ minDate: 0 });

                                                    
                                                    
                                                </script>
                
                    <script type="text/javascript">
                    $("#escala_1").hide();
                    $("#escala_2").hide();
                    $("#escala_3").hide();
                        function hola(){
                             var valor = $(event.target).val();

          
                           if(valor == "escala_11"){
                             $("#escala_1").show();
                             $("#escala_2").hide();
                             $("#escala_3").hide();
                             
                             
                             $('#Psalida1').attr('required', 'required');
                             $('#Pentrada1').attr('required', 'required');
                             $('#Hsalida1').attr('required', 'required');
                             $('#Hentrada1').attr('required', 'required');
                             $('#Ttotal1').attr('required', 'required');
                             $('#presio1').attr('required', 'required');
                             $('#aerolinea1').attr('required', 'required');
                             $('#Nvoleto1').attr('required', 'required');
                               
                           }else 
                           if(valor == "escala_22"){
                            $("#escala_1").hide();
                            $("#escala_2").show();
                            $("#escala_3").hide();
                             
                             
                             $('#Psalida2').attr('required', 'required');
                             $('#Pentrada2').attr('required', 'required');
                             $('#Hsalida2').attr('required', 'required');
                             $('#Hentrada2').attr('required', 'required');
                             $('#Ttotal2').attr('required', 'required');
                             $('#presio2').attr('required', 'required');
                             $('#aerolinea2').attr('required', 'required');
                             $('#Nvoleto2').attr('required', 'required');

                             $('#Psalida22').attr('required', 'required');
                             $('#Pentrada22').attr('required', 'required');
                             $('#Hsalida22').attr('required', 'required');
                             $('#Hentrada22').attr('required', 'required');
                             $('#Ttotal22').attr('required', 'required');
                             $('#presio22').attr('required', 'required');
                             $('#aerolinea22').attr('required', 'required');
                             $('#Nvoleto22').attr('required', 'required');
                               

                           }else 
                           if(valor == "escala_33"){
                             $("#escala_1").hide();
                            $("#escala_2").hide();
                            $("#escala_3").show();
                                    
                             
                             $('#Psalida3').attr('required', 'required');
                             $('#Pentrada3').attr('required', 'required');
                             $('#Hsalida3').attr('required', 'required');
                             $('#Hentrada3').attr('required', 'required');
                             $('#Ttotal3').attr('required', 'required');
                             $('#presio3').attr('required', 'required');
                             $('#aerolinea3').attr('required', 'required');
                             $('#Nvoleto3').attr('required', 'required');

                             $('#Psalida32').attr('required', 'required');
                             $('#Pentrada32').attr('required', 'required');
                             $('#Hsalida32').attr('required', 'required');
                             $('#Hentrada32').attr('required', 'required');
                             $('#Ttotal32').attr('required', 'required');
                             $('#presio32').attr('required', 'required');
                             $('#aerolinea32').attr('required', 'required');
                             $('#Nvoleto32').attr('required', 'required');
                               
                             $('#Psalida33').attr('required', 'required');
                             $('#Pentrada33').attr('required', 'required');
                             $('#Hsalida33').attr('required', 'required');
                             $('#Hentrada33').attr('required', 'required');
                             $('#Ttotal33').attr('required', 'required');
                             $('#presio33').attr('required', 'required');
                             $('#aerolinea33').attr('required', 'required');
                             $('#Nvoleto33').attr('required', 'required');
                           } 
                        
                        }


                    
                </script>
                 <script type="text/javascript">
                                                    document.getElementById("txtFechaEnd").addEventListener("blur", dias);
                                                    document.getElementById("txtFechaStart").addEventListener("blur", fechasValidation);

                                                    function fechasValidation(){

                                                        var inicio = document.getElementById("txtFechaStart").value;
                                                        var FechaInicio = new Date('"' + inicio + '"');
                                                        var FechaActual = new Date();

                                                        if(FechaInicio < FechaActual){

                                                            alert("no puede seleccionar una fecha menor a la actual");
                                                            document.getElementById("txtFechaStart").value = "";
                                                            document.getElementById("txtFechaEnd").value = "";

                                                        }else{

                                                            console.log("Fecha Mayor");

                                                        }

                                                    }

                                                    function dias(){

                                                        var inicio = document.getElementById("txtFechaStart").value;
                                                        var fin = document.getElementById("txtFechaEnd").value;
                                                        var FechaInicio = new Date('"' + inicio + '"');
                                                        var FechaFin = new Date('"' + fin + '"');
                                                        var FechaActual = new Date();

                                                        if(FechaFin< FechaActual){

                                                            alert("no puede seleccionar una fecha menor a la actual");
                                                            document.getElementById("txtFechaStart").value = "";
                                                            document.getElementById("txtFechaEnd").value = "";

                                                        }else{

                                                            console.log("Fecha Mayor");

                                                        }

                                                        var valorDia = new Array(12);
                                                        valorDia = [0,31,59,90,120,151,181,212,243,273,304,334];
                                                        var mesFinicio = FechaInicio.getMonth();
                                                        var mesFentrega = FechaFin.getMonth();
                                                        var diaFinicio = FechaInicio.getDate();
                                                        var diaFentrega = FechaFin.getDate();
                                                        var valorDiaInicio = diaFinicio + valorDia[mesFinicio];  
                                                        var valorDiaFin = diaFentrega + valorDia[mesFentrega];
                                                        var DiasTotales = valorDiaFin - valorDiaInicio + 1;

                                                        document.getElementById("txtDiasRentados").value = DiasTotales;

                                                        console.log("mes fecha inicio: " + mesFinicio + "\n" + "mesFentrega: " + mesFentrega + "\n" + "diaFinicio: " + diaFinicio + "\n" + "dia Fecha Entrega: " + diaFentrega + "\n" + "Valor del año dia entrega: " + valorDiaInicio + "\n" + "Valor del año dia de entrega: " + valorDiaFin);

                                                    }
                                                </script>
                <!--script</script>
                <script type="text/javascript">
                    $("#escala1").hide();
                        function ShowHideElement(){
                            let text = "";
                            if ($("#radio").text()=== "show form"){
                                $("#escala1".show());
                                text = "hide form";

                            }else{
                                $("#escala1").hide();
                                text = "show form ";
                            }
                            $("#mybutton").html(text)


                        }
                        <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input type="date" placeholder="Inicio" id="datepicker" class="form-control" name="start">
                                                            <span class="input-group-addon bg-info b-0 text-white">to</span>
                                                            <input type="date" id="datepicker" placeholder="fin" onclick="hola()" class="form-control" name="datepicker       ">
                                                        </div>
                                                    </div>
                                                </div>
                                              

                                                <script type="text/javascript">
                                                   $('#datepicker').datepicker({ minDate: 0 });

                                                   esto es para eliminar elementos de un input 

                                                    $('#Pentrada').removeAttr('required');

                                                    este es para ingresar algun elemento a un input

                                                    $('#Nvoleto1').attr('required', 'required');
                                                    
                                                </script>-->

                                            
                                
                                
                    
                
	   
</body>


    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Form Wizard JavaScript -->
    <script src="../plugins/bower_components/jquery-wizard-master/dist/jquery-wizard.min.js"></script>
    <!-- FormValidation -->
    <link rel="stylesheet" href="../plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.css">
    <!-- FormValidation plugin and the class supports validating Bootstrap form -->
    <script src="../plugins/bower_components/jquery-wizard-master/libs/formvalidation/formValidation.min.js"></script>
    <script src="../plugins/bower_components/jquery-wizard-master/libs/formvalidation/bootstrap.min.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <!-- Sweet-Alert  -->
    <script src="../plugins/bower_components/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript">
        (function () {
            $('#exampleBasic').wizard({
                onFinish: function () {
                    swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
                }
            });
            $('#btnFinish').click(function(){
                swal({   
                    title: "¿Desea alquilar este auto?",
                    text: "¡Por favor acepte los terminos y condiciones dando click en aceptar!",
                    type: "success",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",   
                    confirmButtonText: "Aceptar",
                    closeOnConfirm: false 
                }, function(){   
                    //swal("Alquilado", "Usted a alquilado el carro con exito", "success");
                    window.location = "indexPropietario.php";
                });
            });
            $('#exampleBasic2').wizard({
                onFinish: function () {
                    if(swal("Renta de auto terminada ya puedes ir a recoger tu auto")){
                        
                    }
                }
            });
            $('#exampleValidator').wizard({
                onInit: function () {
                    $('#validation').formValidation({
                        framework: 'bootstrap'
                        , fields: {
                            username: {
                                validators: {
                                    notEmpty: {
                                        message: 'The username is required'
                                    }
                                    , stringLength: {
                                        min: 6
                                        , max: 30
                                        , message: 'The username must be more than 6 and less than 30 characters long'
                                    }
                                    , regexp: {
                                        regexp: /^[a-zA-Z0-9_\.]+$/
                                        , message: 'The username can only consist of alphabetical, number, dot and underscore'
                                    }
                                }
                            }
                            , email: {
                                validators: {
                                    notEmpty: {
                                        message: 'The email address is required'
                                    }
                                    , emailAddress: {
                                        message: 'The input is not a valid email address'
                                    }
                                }
                            }
                            , password: {
                                validators: {
                                    notEmpty: {
                                        message: 'The password is required'
                                    }
                                    , different: {
                                        field: 'username'
                                        , message: 'The password cannot be the same as username'
                                    }
                                }
                            }
                        }
                    });
                }
                , validator: function () {
                    var fv = $('#validation').data('formValidation');
                    var $this = $(this);
                    // Validate the container
                    fv.validateContainer($this);
                    var isValidStep = fv.isValidContainer($this);
                    if (isValidStep === false || isValidStep === null) {
                        return false;
                    }
                    return true;
                }
                , onFinish: function () {
                    $('#validation').submit();
                    swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
                }
            });
            $('#accordion').wizard({
                step: '[data-toggle="collapse"]'
                , buttonsAppendTo: '.panel-collapse'
                , templates: {
                    buttons: function () {
                        var options = this.options;
                        return '<div class="panel-footer"><ul class="pager">' + '<li class="previous">' + '<a href="#' + this.id + '" data-wizard="back" role="button">' + options.buttonLabels.back + '</a>' + '</li>' + '<li class="next">' + '<a href="#' + this.id + '" data-wizard="next" role="button">' + options.buttonLabels.next + '</a>' + '<a href="#' + this.id + '" data-wizard="finish" role="button">' + options.buttonLabels.finish + '</a>' + '</li>' + '</ul></div>';
                    }
                }
                , onBeforeShow: function (step) {
                    step.$pane.collapse('show');
                }
                , onBeforeHide: function (step) {
                    step.$pane.collapse('hide');
                }
                , onFinish: function () {
                    swal("Message Finish!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.");
                }
            });
        })();
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>
     <!-- Plugin JavaScript -->
    <script src="../plugins/bower_components/moment/moment.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="../plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="../plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="../plugins/bower_components/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="../plugins/bower_components/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="../plugins/bower_components/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="../plugins/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script>
        // Clock pickers
        $('#single-input').clockpicker({
            placement: 'bottom'
            , align: 'left'
            , autoclose: true
            , 'default': 'now'
        });
        $('.clockpicker').clockpicker({
            donetext: 'Done'
        , }).find('input').change(function () {
            console.log(this.value);
        });
        $('#check-minutes').click(function (e) {
            // Have to stop propagation here
            e.stopPropagation();
            input.clockpicker('show').clockpicker('toggleView', 'minutes');
        });
        if (/mobile/i.test(navigator.userAgent)) {
            $('input').prop('readOnly', true);
        }
        // Colorpicker
        $(".colorpicker").asColorPicker();
        $(".complex-colorpicker").asColorPicker({
            mode: 'complex'
        });
        $(".gradient-colorpicker").asColorPicker({
            mode: 'gradient'
        });
        // Date Picker
        jQuery('.mydatepicker, #datepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true
            , todayHighlight: true
        });
        jQuery('#date-range').datepicker({
            toggleActive: true
        });
        jQuery('#datepicker-inline').datepicker({
            todayHighlight: true
        });
        // Daterange picker
        $('.input-daterange-datepicker').daterangepicker({
            buttonClasses: ['btn', 'btn-sm']
            , applyClass: 'btn-danger'
            , cancelClass: 'btn-inverse'
        });
        $('.input-daterange-timepicker').daterangepicker({
            timePicker: true
            , format: 'MM/DD/YYYY h:mm A'
            , timePickerIncrement: 30
            , timePicker12Hour: true
            , timePickerSeconds: false
            , buttonClasses: ['btn', 'btn-sm']
            , applyClass: 'btn-danger'
            , cancelClass: 'btn-inverse'
        });
        $('.input-limit-datepicker').daterangepicker({
            format: 'MM/DD/YYYY'
            , minDate: '06/01/2015'
            , maxDate: '06/30/2015'
            , buttonClasses: ['btn', 'btn-sm']
            , applyClass: 'btn-danger'
            , cancelClass: 'btn-inverse'
            , dateLimit: {
                days: 6
            }
        });
    </script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

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
    <script src="js/jquery.PrintArea.js" type="text/JavaScript"></script>
    <script>
        $(document).ready(function () {
            $("#print").click(function () {
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode
                    , popClose: close
                };
                $("div.printableArea").printArea(options);
            });
        });
    </script>
</html>
  <!-- /#wrapper -->
    <!-- jQuery -->
  
    <script src="js/mask.js"></script>
   