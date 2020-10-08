<?php 
include('requirelanguage.php');
 ?>
<div>
  <script src="jq/jquery-3.5.1.js"></script>
  
  <link rel="canonical" href="https://www.wrappixel.com/templates/ampleadmin/" />
    <link href="../assets/libs/magnific-popup/dist/magnific-popup.css" rel="stylesheet">
    <!-- Popup CSS -->
    <link href="../plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">


    <!-- Page plugins css -->
    <link href="../plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="../plugins/bower_components/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="../plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="../plugins/bower_components/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="../plugins/bower_components/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">



	
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href=""></a>
  <img src="https://vinilosparedes.es/332-large_default/vinilo-infantil-avion-papel.jpg" alt="colegio" width="`40" height="40">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="indexCriente.php"><?php echo $home ; ?><span class="sr-only">(current)</span></a>
      </li>
      <li>
                   <a  type="button" class="nav-link" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><?php echo $voleto; ?></a>
                 </li> 
      <li class="nav-item">
        <div class="col-md-4">
          <div class="white-box">
              
              <div class="modal fade bs-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                  <div class="modal-dialog modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                            </button>
                              
                          <div class="modal-body">
                              <form method="POST" action="busqueda.php">
                                  <div class="form-group">
                                      <label style="width: 125px;"><input type="radio" width="100" value="radio1" name="radio" onclick="menu()" /><?php echo $ida_vuelta; ?></label>
                                      <label style="width: 400px;"><input type="radio"  name="radio" value="radio2" onclick="menu()" /><?php echo $ida; ?></label>
                                      <label><?php echo $typeclass; ?><select name="clase" id="">
                                        <option value="0"></option>
                                        <option value="1"><?php echo $classeco; ?></option>
                                        <option value="2"><?php echo $claspre; ?></option>
                                        <option value="3"><?php echo $Ejecutiva; ?></option>
                                        <option value="4"><?php echo $premera; ?></option>
                                      </select></label>
                                  </div>
                                  <div id="ida_vuelta">
                                  <div class="form-group">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <label for="Input9"><?php echo $Origen; ?></label>
                                                    <input type="text" name="origen" id="Input9" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <label for="Input10"><?php echo $Destino; ?></label>
                                                    <input type="text" name="destino" id="Input10" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                </div>
                                  <div id="solo_ida">
                                  <div class="form-group">
                                    <div class="row">
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <label for="Input9"><?php echo $Origen; ?></label>
                                                    <input type="text" name="origen1"  id="Input9" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="fomr-group has-success m-b-40">
                                                    <label for="Input10"><?php echo $Destino; ?></label>
                                                    <input type="text" name="destino1" id="Input10" class="form-control input-lg" >
                                                    <span class="highlight"></span>
                                                    <span class="bar"></span>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                  </div>
                                </div>
                              
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $exit; ?></button>
                              <a href="busqueda.php"><input type="submit"class="btn btn-primary" href="busqueda.php"  value="<?php echo $buscar; ?>"></a>
                              
                          </div>
                      </div>
                    </form>
                  </div>
              </div>
          </div>
       </div>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="mireserva.php"><?php echo $reservas ; ?><span class="sr-only">(current)</span></a>
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php echo  $idioma; ?>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a href="menu/changelanguage.php?language=es">
            <button class="dropdown-item" type="button"><?php echo $spanish; ?></button>      
          </a>
          <a href="menu/changelanguage.php?language=en">
             <button class="dropdown-item" type="button"><?php echo $english; ?></button>
          </a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php"><?php echo $exit; ?></a>
      </li>
     
      
    </ul>
  </div>
  <script type="text/JavaScript">
    $("#ida_vuelta").hide();
    $("#solo_ida").hide();
    function menu(){
      var vuelo = $(event.target).val();
      if (vuelo == "radio1") {
         $("#ida_vuelta").show();
         $("#solo_ida").hide();
      }
      if (vuelo == "radio2") {
        $("#ida_vuelta").hide();
        $("#solo_ida").show();
      }

    }
  </script>
</nav>
</div>

 <!-- jQuery -->
    <script src="../plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="../plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <!--Counter js -->
    <script src="../plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="../plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <!--slimscroll JavaScript -->
    <script src="js/jquery.slimscroll.js"></script>
    
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!-- Vector map JavaScript -->
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-in-mill.js"></script>
    <script src="../plugins/bower_components/vectormap/jquery-jvectormap-us-aea-en.js"></script>
    <!-- chartist chart -->
    <script src="../plugins/bower_components/chartist-js/dist/chartist.min.js"></script>
    <script src="../plugins/bower_components/chartist-plugin-tooltip-master/dist/chartist-plugin-tooltip.min.js"></script>
    <!-- sparkline chart JavaScript -->
    <script src="../plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <script src="../plugins/bower_components/jquery-sparkline/jquery.charts-sparkline.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="js/custom.min.js"></script>
    <script src="js/dashboard3.js"></script>
    <!--Style Switcher -->
    <script src="../plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <script src="../dist/js/app.min.js"></script>
    <script src="../dist/js/app.init.material.js"></script>
    <script src="../dist/js/app-style-switcher.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="../assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="../assets/extra-libs/sparkline/sparkline.js"></script>
    <!-- This Page JS -->
    <script src="../assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js"></script>
    <script src="../assets/libs/magnific-popup/meg.init.js"></script>
    

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
    <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f7f28ee4704467e89f5c78f/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
  


