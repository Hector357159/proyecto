<?php 
session_start();
include('conexion.php');
if (isset($_POST['login'])) {
	$user1=$_POST['txt1'];
	$pas=$_POST['pass'];
	$pas=hash('sha512', $pas);
	$query="SELECT * FROM user where user='".$user1."' AND password='".$pas."'";
	$resultado = mysqli_query($conxi, $query);
	if ($f=mysqli_fetch_array($resultado)){
		if ($pass == $f['Password']){
			$_SESSION['tipo_session'] = $f['type'];
		    $queryid = "SELECT * FROM user WHERE password = '{$f['password']}'";
				$resultid = mysqli_query($conxi, $queryid);
				while ($row = mysqli_fetch_array($resultid)) {
					$_SESSION['user'] = $row[0];
					$_SESSION['password'] = $row[1];

				}


			  if($_SESSION['tipo_session'] == 0){
			  header("location: indexAdmin.php");

		       }elseif($_SESSION['tipo_session'] == 1){
			   header("location: indexCriente.php ");
			   }
			  }else{

				echo "<script> alert('Contraseña Incorrecta'); </script>";
				header("location: Login.php");

			}

		    }else{
		    	echo "<script>
                alert('No existe el usuario');
                window.location= 'Login.php'
                </script>";
		}
		    

	}else{
		echo "<script>
                alert('No existe el usuario');
                window.location= 'Login.php'
                </script>";
	}
	

	

 ?>