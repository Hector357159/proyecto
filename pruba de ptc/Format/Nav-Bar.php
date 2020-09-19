<nav class="navbar navbar-default navbar-static-top m-b-0">
	<div class="navbar-header">
		<a class="logo" href="index.php">
		    <b>
		    	<img src="../plugins/images/admin-logo-dark.png" alt="home" class="light-logo" />
		        <span class="hidden-xs">
			    </span> 
		    </b>
		</a>
		<ul class="nav navbar-top-links navbar-left">
            <li>
            	<a href="javascript:void(0)" class="open-close waves-effect waves-light visible-xs">
            		<i class="ti-close ti-menu"></i>
            	</a>
            </li>
        </ul>
        <ul class="nav navbar-top-links navbar-right pull-right active">
            <li class="dropdown">
                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#">
                	<b class="hidden-xs"><?php echo $_SESSION['nombre']; ?></b>
                	<span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-user animated flipInY">
                    <li>
                        <div class="dw-user-box">
                            <div class="u-text">
                            	<h4><?php echo $_SESSION['nombre']; ?></h4>
                            	<p class="text-muted"><?php echo $_SESSION['Correo']; ?></p>
                            	<a href="PerfilCliente.php" class="btn btn-rounded btn-danger btn-sm">Ver Perfil</a>
                            </div>
                        </div>
                    </li>
                    <li role="separator" class="divider"></li>
                    <li><a href="PHP/Destroy.php"><i class="fa fa-power-off"></i> Cerrar Sesion</a></li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            
            <!-- /.dropdown -->
        </ul>
	</div>
</nav>