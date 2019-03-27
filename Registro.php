<?php

if (isset($_POST["enviar"])){

    require_once 'BBDD.php';

    
    $pass = $_POST["password"];
    $name = $_POST["nombre"];
    $age = $_POST["edad"];
    

	$hash = password_hash($pass, PASSWORD_DEFAULT);
        
        
	
    insertarSocio($hash, $name, $age);

}else{

    echo ' 
        <form action = "" method = "POST">
        Nombre: <input type = "text" name = "nombre"><br>
        Password: <input type = "password" name = "password"><br>
        Edad: <input type = "number" name = "edad"><br>
        
        <input type = "submit" name = "enviar" value = "Alta">
        </form>';



}

?>