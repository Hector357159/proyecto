    <?php 



        //Incluir la conexion para consultar la base de datos

        include('Conexion.php');
        



        //Inicio de session

        session_start();



        //Validacion para que solo se pueda iniciar session por el login y no por url

        if(isset($_SESSION['user'])){



        }else{

            header("location: login.php");

        }
//background="img/descarga.jpg"



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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<body >
    
	<div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="img/hola3.jpeg" width="100" height="600" class="d-block w-100" alt="avion ">
      <div class="carousel-caption d-none d-md-block">
        <h5><?php echo $descripcion ?></h5>
        <p><?php echo $descripcion2 ?></p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/hola1.jpeg" width="100" height="600"  class="d-block w-100" alt="avion ">
      <div class="carousel-caption d-none d-md-block">
        <h5><?php echo $descripcion ?></h5>
        <p><?php echo $descripcion2 ?> </p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="img/hola2.jpeg" width="100" height="600" class="d-block w-100" alt="avion ">
      <div class="carousel-caption d-none d-md-block">
        <h5><?php echo $descripcion ?></h5>
        <p><?php echo $descripcion2 ?> </p>
      </div>
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
	
</body>
</html>
