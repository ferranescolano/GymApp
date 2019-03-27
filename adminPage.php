<?php
session_start();
   require_once 'BBDD.php';


if(isset($_SESSION['codigo'])){
 
    $valuecodigo = $_SESSION['codigo'];
    
            
$listado = listadoSocios();


echo "<h1>Listado de Socios</h1>";
echo "<table border='1'>";
        echo "<tr bgcolor='#00C1FF'>";
        echo "<th>ID</th><th>Nombre</th><th>Edad</th>";
        echo "</tr><br>";   
        // Lo vamos mostrando mientras haya filas en el resultado
        while ($fila = mysqli_fetch_assoc($listado)) {
            echo "<tr>";
            // Mostramos los datos del alumno actual ($fila)
            foreach ($fila as $dato) {
                echo "<td align='center' bgcolor='#FFD100   '>$dato</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    
}else{


        echo "No hay ningún usuario logueado";


}

 

 ?>       
        