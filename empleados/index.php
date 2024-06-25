<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "empleados";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM empleados WHERE id=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlEmpleaados) > 0){
        $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
        echo json_encode($empleaados);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM empleados WHERE id=".$_GET["borrar"]);
    if($sqlEmpleaados){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_GET["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    // $nombre = $data->nombre;
    // $precio = $data->precio;
    // $cupo = $data->cupo;
    // $contacto = $data->contacto;
    // $descripcion = $data->descripcion;
    // $destino = $data->destino;
    // $duracion = $data->duracion;

    $codigo_camara = $data->codigo_camara;
    $modelo = $data->modelo;
    $marca = $data->marca;
    $preccio = $data->preccio;
    $resolucion = $data->resolucion;
    $tipo = $data->tipo;
    $proveedor = $data->proveedor;
    $garantia = $data->garantia;
    $peso = $data->peso;
    $dimensiones = $data->dimensiones;
    $tipo_sensor = $data->tipo_sensor;
    $lente_incluido = $data->lente_incluido;
    $tipo_almacenamiento = $data->tipo_almacenamiento;
    $bateria = $data->bateria;
    $observaciones = $data->observaciones;
    

    if(($codigo_camara != "")
    &&($modelo != "")
    &&($marca  != "")
    &&($preccio != "")
    &&($resolucion != "")
    &&($tipo != "")
    &&($proveedor != "")
    &&($garantia != "")
    &&($peso != "")
    &&($dimensiones != "")
    &&($tipo_sensor != "")
    &&($lente_incluido != "")
    &&($tipo_almacenamiento != "")
    &&($bateria != "")
    &&($observaciones != "")

     ){
        $sqlEmpleados = mysqli_query($conexionBD, "INSERT INTO empleados(
         codigo_camara,
         modelo,
         marca ,
         preccio,
         resolucion,
         tipo,
         proveedor,
         garantia,
         peso,
         dimensiones,
         tipo_sensor,
         lente_incluido,
         tipo_almacenamiento,
         bateria,
         observaciones
        ) VALUES (' $codigo_camara'
    ,'$modelo'
    ,'$marca '
    ,'$preccio'
   ,' $resolucion'
    ,'$tipo'
   ,' $proveedor'
   ,' $garantia'
   ,' $peso'
   ,' $dimensiones'
   ,' $tipo_sensor'
   ,' $lente_incluido'
    ,'$tipo_almacenamiento'
   ,' $bateria'
    ,'$observaciones'
        )");
        echo json_encode(["success" => 1]);
    } else {
        echo json_encode(["success" => 0, "error" => "Datos incompletos"]);
    }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_GET["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
    // $nombre=$data->nombre;
    // $precio=$data->precio;
    // /////agregamos esta linea 06 ///////////////
    // $cupo=$data->cupo;
    // $contacto=$data->contacto;
    // $descripcion=$data->descripcion;
    // $destino=$data->destino;
    // $duracion=$data->duracion;


    $codigo_camara = $data->codigo_camara;
    $modelo = $data->modelo;
    $marca = $data->marca;
    $preccio = $data->preccio;
    $resolucion = $data->resolucion;
    $tipo = $data->tipo;
    $proveedor = $data->proveedor;
    $garantia = $data->garantia;
    $peso = $data->peso;
    $dimensiones = $data->dimensiones;
    $tipo_sensor = $data->tipo_sensor;
    $lente_incluido = $data->lente_incluido;
    $tipo_almacenamiento = $data->tipo_almacenamiento;
    $bateria = $data->bateria;
    $observaciones = $data->observaciones;
  
    
    $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE empleados SET 
    
    codigo_camara='$codigo_camara'
    ,modelo='$modelo'
    ,marca='$marca '
    ,preccio='$preccio'
   ,resolucion='$resolucion'
    ,tipo='$tipo'
   ,proveedor='$proveedor'
   ,garantia='$garantia'
   ,peso='$peso'
   ,dimensiones='$dimensiones'
   ,tipo_sensor='$tipo_sensor'
   ,lente_incluido='$lente_incluido'
    ,tipo_almacenamiento='$tipo_almacenamiento'
   ,bateria='$bateria'
    ,observaciones='$observaciones'

     WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM empleados ");
if(mysqli_num_rows($sqlEmpleaados) > 0){
    $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
    echo json_encode($empleaados);
}
else{ echo json_encode([["success"=>0]]); }


// header("Access-Control-Allow-Origin: *");
// header("Access-Control-Allow-Headers: access");
// header("Access-Control-Allow-Methods: GET,POST");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// // Conecta a la base de datos  con usuario, contraseña y nombre de la BD
// $servidor = "localhost"; $usuario = "root"; $contrasenia = ""; $nombreBaseDatos = "empleados";
// $conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// // Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
// if (isset($_GET["consultar"])){
//     $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM empleados WHERE id=".$_GET["consultar"]);
//     if(mysqli_num_rows($sqlEmpleaados) > 0){
//         $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
//         echo json_encode($empleaados);
//         exit();
//     }
//     else{  echo json_encode(["success"=>0]); }
// }
// //borrar pero se le debe de enviar una clave ( para borrado )
// if (isset($_GET["borrar"])){
//     $sqlEmpleaados = mysqli_query($conexionBD,"DELETE FROM empleados WHERE id=".$_GET["borrar"]);
//     if($sqlEmpleaados){
//         echo json_encode(["success"=>1]);
//         exit();
//     }
//     else{  echo json_encode(["success"=>0]); }
// }
// //Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
// if(isset($_GET["insertar"])){
//     $data = json_decode(file_get_contents("php://input"));
//     $nombre=$data->nombre;
//     $correo=$data->correo;
//         if(($correo!="")&&($nombre!="")){
            
//     $sqlEmpleaados = mysqli_query($conexionBD,"INSERT INTO empleados(nombre,correo) VALUES('$nombre','$correo') ");
//     echo json_encode(["success"=>1]);
//         }
//     exit();
// }
// // Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
// if(isset($_GET["actualizar"])){
    
//     $data = json_decode(file_get_contents("php://input"));

//     $id=(isset($data->id))?$data->id:$_GET["actualizar"];
//     $nombre=$data->nombre;
//     $correo=$data->correo;
    
//     $sqlEmpleaados = mysqli_query($conexionBD,"UPDATE empleados SET nombre='$nombre',correo='$correo' WHERE id='$id'");
//     echo json_encode(["success"=>1]);
//     exit();
// }
// // Consulta todos los registros de la tabla empleados
// $sqlEmpleaados = mysqli_query($conexionBD,"SELECT * FROM empleados ");
// if(mysqli_num_rows($sqlEmpleaados) > 0){
//     $empleaados = mysqli_fetch_all($sqlEmpleaados,MYSQLI_ASSOC);
//     echo json_encode($empleaados);
// }
// else{ echo json_encode([["success"=>0]]); }


////practicando 01
// $sql="SELECT *FROM empleados";
// $resultado=$conexionBD->query($sql);
// if($resultado->num_rows > 0){
//     $response=array();
//     while($row =$resultado->fetch_assoc()){
//         $response[]=$row;
//     }
//     echo json_encode($response);
// }

?>
