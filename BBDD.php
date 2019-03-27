<?php

function conectar($database) {
    $con = mysqli_connect("localhost", "root", "", $database)
            or die("No se ha podido conectar con la BBDD.");
    return $con;
}

function desconectar($conexion) {
    mysqli_close($conexion);
}
/*

function listadoActividades() {
    $con = conectar("gym");
    $select = 'select * from activity';
    $resultado = mysqli_query($con, $select);
    desconectar($con);
    return $resultado;
}*/

function listadoActividades($contador, $paginacion){
    $con = conectar("gym");
    $select = "select * from activity limit $contador, $paginacion";
    $result = mysqli_query($con, $select);
    desconectar($con);
    return $result;
}

function insertarSocio($hash, $name, $age) {
    $con = conectar("gym");
    $insert = "insert into member values ('0', '$hash', '$name', '$age')";

    if (mysqli_query($con, $insert)) {
        echo "Socio dado de alta.<br>";
        echo "<a href='Main.php'>Volver a la Pàgina Principal</a><br><br>";
    } else {
        echo mysqli_error($con);
    }

    desconectar($con);
}

function login($password, $codigo) {
    $con = conectar("gym");
    $select = "select pass from member where idmember = '" . $codigo . "'";

    $resultado = mysqli_query($con, $select);

    if (mysqli_num_rows($resultado) > 0) {
        $fila = mysqli_fetch_assoc($resultado);
        $hash = $fila["pass"];
        $login = password_verify($password, $hash);

        if ($login == true) {

            header("Location: userPage.php");
        } else {
            echo "Usuario o contraseña incorrecto<br><a href='Main.php'>Volver a la Pàgina Principal</a><br><br>";
        }
    }else{
        echo "El usuario no existe encontrado en la BBDD";
    }
    desconectar($con);
    return $codigo;
}
function countActivity(){
    $con = conectar("gym");
    $select = "select count(*) as cantidad from activity";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_array($result);
    desconectar($con);
    return $row;
}

function searchNameById($codevalue) {

    $con = conectar("gym");
    $select = "select name from member where idmember = '$codevalue'";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_array($result);
    desconectar($con);
    return $row;
}

function actividadesDisponiblesParaUser($codevalue) {

    $con = conectar("gym");
    $select = "select name from activity where name not in (select activity from enroll where member = '$codevalue') and capacity > 0";
    $result = mysqli_query($con, $select);
    desconectar($con);
    return $result;
}

/*
function calcularCuota($codevalue){
    $con = conectar("gym");
    $select = "select SUM from activity where name = (select activity from enroll where member = $codevalue)";
}*/

function inscribirse($codevalue, $activity) {
    $con = conectar("gym");
    $insert = "insert into enroll values('$codevalue','$activity', NOW())";
    $result = mysqli_query($con, $insert);
    echo "<br><br>Te has inscrito a :<h4>$activity</h4>";
    
    desconectar($con);

}
function calculateFee($codevalue){
    $con = conectar("gym");
    $select = "select sum(price) from activity where name in (select activity from enroll where member = $codevalue)";
    $result = mysqli_query($con, $select);
    $row = mysqli_fetch_array($result);
    desconectar($con);
    return $row;
}

/*
function cuota($activity, $valorActualcuota){
    $con = conectar("gym");
    $select = "select price from activity where name = $activity";
    $result = mysqli_query($con, $select);
    $valorActualcuota += $result;
    return $valorActualcuota;
}*/

function listadoSocios() {
    $con = conectar("gym");
    $select = 'select idmember, name, age from member';
    $resultado = mysqli_query($con, $select);
    
    desconectar($con);
    return $resultado;
}

?>