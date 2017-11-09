<?php
Consultar();




if (isset($_POST['enviar'])) {
  insertar();

}

function Consultar()
{
  $servidor="localhost";
  $userdb="root";
  $passdb="";
  $db="usuarios";



    $conn= new PDO("mysql:host=$servidor;dbname=$db",$userdb,$passdb);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //Alistar el query
    //statement=declaracion
    $dcla=$conn->prepare("SELECT * FROM usuario");
    $dcla->execute();
    if($dcla->rowCount()>0){
      echo '<table><tr><th>Nombre</th><th>Apellido</th><th>Correo</th></tr>';
      while($fila= $dcla->fetch(PDO::FETCH_ASSOC)){
        echo "
                <tr><td>",$fila['nombre'],"</td>
                    <td>",$fila['apellido'],"</td>
                    <td>",$fila['correo'],"</td>
                    <td><a href='eliminar.php?nombre=".$fila['nombre']."'>Eliminar</td></tr>
          ";


      }
      echo '</table>';
    }else {
      echo "No hay Registros";
    }


}
 function insertar()
{
  $servidor="localhost";
  $userdb="root";
  $passdb="";
  $db="usuarios";
  $nombre= $_POST['nombre'];
  $apellido= $_POST['apellido'];
  $correo= $_POST['correo'];

  try {
    $conn= new PDO("mysql:host=$servidor;dbname=$db",$userdb,$passdb);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    //Alistar el query
    //statement=declaracion
    $dcla=$conn->prepare("INSERT INTO usuario(nombre,apellido,correo) VALUES (:nombre,:apellido,:email)");
    $dcla->bindParam(':nombre',$nombre);
    $dcla->bindParam(':apellido',$apellido);
    $dcla->bindParam(':email',$correo);
    $dcla->execute();

    echo '<!DOCTYPE html>
  		<html>
  			<head>
  				<meta charset="UTF-8">
  				<title></title>
  				<meta http-equiv="REFRESH" content="0;url=form.php">
  			</head>
  		</html>
  ';


  } catch (PDOException $e) {
    echo "Error: ",$e->getMessage();
  }
  $conn=null;
}





 ?>
