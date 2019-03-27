<?php
session_start();
if (isset($_POST["enviar"])){
    
    require_once 'BBDD.php';
    //Pasar codigo con el session
    $password = $_POST["password"];
    $codigo = $_POST["codigo"];
    $_SESSION["codigo"] = $codigo;
    if($codigo == "0" && $password =="admin"){
        header("Location: adminPage.php");
    }
else  if(login($password, $codigo)){
    
    
 }

}else{
    
    echo ' 
        <form action = "" method = "POST">
        Código: <input type = "text" name = "codigo"><br>
        Password: <input type = "password" name = "password"><br>
        
        
        <input type = "submit" name = "enviar" value = "Iniciar Sesión">
        </form>';
    
}


?>