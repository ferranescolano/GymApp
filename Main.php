<?php


require_once 'BBDD.php';
$paginacion = 5;

echo "<html>
    <head>
    <style>
    div { width:100px; margin-left: 50; text-align:center; }
    </style>
        <meta charset=\"UTF-8\">
        <title></title>
    </head>
    <body>
    <div style='background-color:#00C1FF';width: 100px;>
        <a href=\"Login.php\">Login</a><br>
        <a href=\"Registro.php\">Registro</a><br><br>
       
        </div>
    </body> 
</html>
";


 if (isset($_GET["contador"])) {
                $contador = $_GET["contador"];
            } else {
                $contador = 0;
            }
            $total = countActivity();

$listado = listadoActividades($contador, $paginacion);

echo 
"<table border='1'>";
        echo "<tr bgcolor='#00C1FF'>";
        echo "<th>Nombre</th><th>Precio</th><th>Capacidad</th>";
        echo "</tr><br>";
        // Lo vamos mostrando mientras haya filas en el resultado
        while ($fila = mysqli_fetch_assoc($listado)) {
            echo "<tr>";
            // Mostramos los datos del alumno actual ($fila)
            foreach ($fila as $dato) {
                echo "<td align='center' bgcolor='#FFD100'>$dato</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        
        // Mostrando el anterior (en caso de que lo haya)
       
        // Mostrando mensaje de los resultados actuales
       
        
         if ($contador > 0) {
            echo "<a href='Main.php?contador=" . ($contador - $paginacion) . "'>Anterior <········></a>";
        }
        // Mostrar el siguiente (en cado de que lo haya)
        if (($contador + $paginacion) < $total) {
            echo "<a href='Main.php?contador=" . ($contador + $paginacion) . "'> Siguiente</a>";
        }
       
        
        
?>