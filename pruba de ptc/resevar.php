<?php 



        //Incluir la conexion para consultar la base de datos

        include('Conexion.php');
        



        //Inicio de session

        session_start();



        //Validacion para que solo se pueda iniciar session por el login y no por url

        if(isset($_SESSION['user'])){



        }else{

            header("location: /login.php");

        }
        




     ?>
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <title>Document</title>
         <?php
     include 'menu/menu.php'; 

     ?> 
     
            

     </head>
     <body>
        <?php
        $boleto="SELECT tbboleto.ID_boleto,tbboleto.DsalidaV,tbboleto.DllegadaV,tbboleto.Psalida,tbboleto.Pentrada,tbboleto.Hsalida,tbboleto.Hentrada,tbboleto.Tiempo,tbboleto.Presio,tbboleto.Aerolinia,tbboleto.Nvuelo,tbboleto.reserva,tbescala.ID_boleto,tbescala.DsalidaV,tbescala.DllegadaV,tbescala.Lsalida,tbescala.Lentrada,tbescala.Hsalida,tbescala.Hentrada,tbescala.Tiempo,tbescala.precio,tbescala.Aerolinia,tbescala.Nbuelo,tbescala.reserva FROM tbboleto INNER JOIN tbescala on tbboleto.ID_boleto = '{$_SESSION['id']}'" or die(mysql_error());//consulta a mysql los datos que se riquieren
                                              $resultadoboleto = mysqli_query($conxi,$boleto); //consulta a la vase de datos si funciona 
                                              if($rowp = mysqli_fetch_array($resultadoboleto)){//conviete los datos de la base de datos a  en booleano(comiensa con 0 despues el 1,2,3) para que se mas facil imprimir la informacion


         ?>
                        
                    <div class="col-sm-12">
                        <div class="white-box">
                            
                            <div id="exampleBasic2" class="wizard">
                                <ul class="wizard-steps" role="tablist">
                                    
                                    <li role="tab">
                                        
                                </ul>
                                    <div class="wizard-pane active" role="tabpanel">
                                        <div class="white-box  printableArea">
                                           
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="pull-left">
                                                        <address>
                                                            <h3> &nbsp;<b class="text-danger"></b></h3>
                                                            <p class="text-muted m-l-5"><br/>
                                                                <?php echo $diasalida; ?> <br/>
                                                                <?php echo $diaentrada; ?> <br/>
                                                                <?php echo $Pais_salida; ?> <br>
                                                                <?php echo $Pais_entrada; ?> <br>
                                                                <?php echo $aerolinea ?> <br>
                                                                <?php echo $presio ?> <br>
                                                                <?php echo $voleto ?> 

                                                            </p>
                                                        </address>
                                                    </div>
                                                    <div class="pull-right text-right">
                                                        <address>
                                                            <h3>De,</h3>
                                                            <h4 class="font-bold">Nombre Propietario,</h4>
                                                            <p class="text-muted m-l-30">
                                                                <?php echo $rowp['1']; ?> <br/>
                                                                <?php echo $rowp['2']; ?> <br/>
                                                                <?php echo $rowp['4']; ?> <br>
                                                                <?php echo $rowp['16']; ?> <br>
                                                                <?php echo $rowp['9']; ?> <br>
                                                                <?php echo $rowp['8']; ?> <br>
                                                                <?php echo $rowp['10']; ?> 
                                                                
                                                            </p>
                                                            
                                                        </address> 
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12">
                                                    <div class="pull-right m-t-30 text-right">
                                                        
                                                        <p> <?php echo $rowp[8]; ?> </p>
                                                        <hr>
                                                        <h3><b><?php echo $Total1; ?></b> <?php echo $rowp[8]; ?></h3> </div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <a class="btn btn-danger" href="PHP/reserva_usuario.php?is=<?php echo $rowp[0];?>" data-wizard="finish" role="button"> <?php echo $dinalisar; ?></a>
                                                        
                                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> <?php echo $Imprimi; ?>r</span> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                

           </div> 
        </div>
    </div>
<?php } ?>


     <!-- Bootstrap Core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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




                                
     </body>
     </html>
     <?php 
/*
<?php
        $boleto="SELECT tbboleto.ID_boleto,tbboleto.DsalidaV,tbboleto.DllegadaV,tbboleto.Psalida,tbboleto.Pentrada,tbboleto.Hsalida,tbboleto.Hentrada,tbboleto.Tiempo,tbboleto.Presio,tbboleto.Aerolinia,tbboleto.Nvuelo,tbboleto.reserva,tbescala.ID_boleto,tbescala.DsalidaV,tbescala.DllegadaV,tbescala.Lsalida,tbescala.Lentrada,tbescala.Hsalida,tbescala.Hentrada,tbescala.Tiempo,tbescala.precio,tbescala.Aerolinia,tbescala.Nbuelo,tbescala.reserva FROM tbboleto INNER JOIN tbescala on tbboleto.ID_boleto = '{$_SESSION['id']}'" or die(mysql_error());
                                              $resultadoboleto = mysqli_query($conxi,$boleto); 
                                              if($row = mysqli_fetch_array($resultadoboleto)){


         ?>
           <div id="wrapper">
         <div id="page-wrapper">
           <div class="container-fluid">

                                           <div class="col-md-12">
                                                    <div class="fomr-group has-success m-b-40">
                                                        <div class="input-daterange input-group" id="date-range">
                                                            <input value='<?php echo $row['1'];  ?>' type="text" placeholder="<?php echo $entry ; ?>"  id="txtFechaStart" class="form-control" name="Dsalida">
                                                            <span>.  .</span>
                                                            <input type="text" value='<?php echo $row['2'];  ?>' id="txtFechaEnd" placeholder="<?php echo $departure ; ?>" class="form-control" name="Dentrada">
                                                        </div>
                                                    </div>
                                                </div>
                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" value='<?php echo $row['3'];  ?>' name="Psalida" id="Psalida" class="form-control input-lg"  required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtMarca"><?php echo $Pais_salida ;?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" value='<?php echo $row['4'];  ?>' name="Pentrada" id="Pentrada" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtModelo"><?php echo $Pais_entrada ;?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" value='<?php echo $row['5'];  ?>' name="Hsalida" id="Hsalida" class="form-control input-lg"  required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="txtYear"><?php echo $hora_salida; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                     <input type="text" value='<?php echo $row['6'];  ?>'name="Hentrada" id="Hentrada" class="form-control input-lg"  required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="slcMarcha"><?php echo $hora_entrada; ?> </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" value='<?php echo $row['7'];  ?>' name="Ttotal" id="Ttotal" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input6"><?php echo $total_time; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" value='<?php echo $row['8'];  ?>' name="presio" id="presio" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input7"><?php echo $presio; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="fomr-group has-success m-b-40">
                                                    <input type="text" value='<?php echo $row['9'];  ?>' name="aerolinea" id="aerolinea" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input8"><?php echo $aerolinea; ?></label>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="fomr-group has-success m-b-40">
                                                    <!--<input type="text" name="txtAire" id="Input9" class="form-control input-lg" required>-->
                                                     <input type="text" name="Nvoleto" value='<?php echo $row['10'];  ?>' id="Nvoleto2" class="form-control input-lg" required>
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    <label for="Input9"><?php echo $Nvoleto; ?></label>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-danger" href="#exampleBasic2" data-wizard="finish" role="button"> Finalizar Rentado </a>
                                         <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                                     </div>
                                 </div>
                             </div>
                             <div class="wizard-pane" role="tabpanel">
                                        <div class="white-box printableArea">
                                            <h3><b>Factura</b> <span class="pull-right">1</span></h3>
                                                <hr>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="pull-left">
                                                        <address>
                                                            <h3> &nbsp;<b class="text-danger">Usuario Rentador</b></h3>
                                                            <p class="text-muted m-l-5">Direccion <br/>
                                                                Direccion <br/>
                                                                Municipio <br/>
                                                                Departamento <br>
                                                                Dui <br>
                                                                Licencia <br>
                                                                Tipo Licencia
                                                            </p>
                                                        </address>
                                                    </div>
                                                    <div class="pull-right text-right">
                                                        <address>
                                                            <h3>De,</h3>
                                                            <h4 class="font-bold">Nombre Propietario,</h4>
                                                            <p class="text-muted m-l-30">Direccion <br/>
                                                                Direccion <br/>
                                                                Municipio <br/>
                                                                Departamento <br>
                                                                Dui <br>
                                                                Metodo de pago
                                                            </p>
                                                            <p class="m-t-30">
                                                                <b>Fecha de inicio de contrato : </b>
                                                                <i class="fa fa-calendar"></i>&nbsp;
                                                                23rd Jan 2016
                                                            </p>
                                                            <p>
                                                                <b>Fecha de Fin de Contrato : </b>
                                                                <i class="fa fa-calendar"></i>&nbsp;
                                                                25th Jan 2016
                                                            </p>
                                                            <p>
                                                                <b>Dias Totales de la renta : </b>
                                                                <i class="fa fa-calendar"></i>&nbsp;
                                                                29 Dias
                                                            </p>
                                                        </address> 
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="table-responsive m-t-40" style="clear: both;">
                                                        <table class="table table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th class="text-center">#</th>
                                                                    <th class="text-center">Matricula</th>
                                                                    <th class="text-center">Marca</th>
                                                                    <th class="text-center">Modelo</th>
                                                                    <th class="text-right">Dias</th>
                                                                    <th class="text-right">Costo por dia</th>
                                                                    <th class="text-right">Total</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class="text-center">1</td>
                                                                    <td class="text-center">001001001</td>
                                                                    <td class="text-center">Toyota</td>
                                                                    <td class="text-center">Supra</td>
                                                                    <td class="text-right">29</td>
                                                                    <td class="text-right">$25</td>
                                                                    <td class="text-right">$725</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="pull-right m-t-30 text-right">
                                                        <p>Sub - Total : $$725</p>
                                                        <p>Servicio RCAR (2.5%) : $181 </p>
                                                        <hr>
                                                        <h3><b>Total :</b> $906</h3> </div>
                                                    <div class="clearfix"></div>
                                                    <hr>
                                                    <div class="text-right">
                                                        <a class="btn btn-danger" href="#exampleBasic2" data-wizard="finish" role="button"> Finalizar Rentado </a>
                                                        
                                                        <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Imprimir</span> </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                            <?php 
                                        }
                                             ?>
*/
      ?>