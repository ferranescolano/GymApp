<!DOCTYPE html>
<!--
Página que permite registrar un proyecto
-->
<html>
    <head>
        <meta charset="UTF-8">
        
    </head>
    <body>
        <?php
        session_start();
        require_once 'BBDD.php';
             if(isset($_SESSION['codigo'])){
                 $codevalue = $_SESSION['codigo'];
                 $namevalue = searchNameById($codevalue);
                 $valorCuota = calculateFee($codevalue);
                 
               
                 
        ?>
        
        <h1>Bienvenid@ <?php print_r($namevalue[0]); ?></h1>
        <form method="POST"> 
            <p>Escoge la actividad a la que te quieras inscribir: 
                <select name="actividad">
                    <?php
                    $actividad = actividadesDisponiblesParaUser($codevalue);
                    while ($fila = mysqli_fetch_assoc($actividad)) {
                        echo "<option>";
                        echo $fila["name"];
                        echo "</option>";
                    }
                    ?>
                </select>
            </p>
            <input type="submit" name="inscribirse" value="Inscribirse">        
        </form>
        <?php

        if (isset($_POST["inscribirse"])) {
           
            $activity = $_POST['actividad'];
            
            
            inscribirse($codevalue, $activity);
             $valorCuota = calculateFee($codevalue);
              echo "Valor actual de tu cuota: ";
              echo "$valorCuota[0] €";
           
        }
      }
        ?>
    </body>
</html>
