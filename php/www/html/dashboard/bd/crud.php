<?php
include_once '../bd/conexion.php';
$objeto = new Conexion();
$conexion = $objeto->Conectar();
// Recepción de los datos enviados mediante POST desde el JS   


$node_id = (isset($_POST['node_id'])) ? $_POST['node_id'] : '';
$alias = (isset($_POST['alias'])) ? $_POST['alias'] : '';
$min_light_needed = (isset($_POST['min_light_needed'])) ? $_POST['min_light_needed'] : '';
$water_needed = (isset($_POST['water_needed'])) ? $_POST['water_needed'] : '';
$max_temperature = (isset($_POST['max_temperature'])) ? $_POST['max_temperature'] : '';
$min_temperature = (isset($_POST['min_temperature'])) ? $_POST['min_temperature'] : '';
$id = (isset($_POST['id'])) ? $_POST['id'] : '';

switch($opcion){
    case 1: //alta
        $consulta = "INSERT INTO node (node_id, alias, min_light_needed, water_needed, max_temperature, min_temperature) VALUES('$node_id', '$alias', '$min_light_needed', '$water_needed' , '$max_temperature', '$min_temperature') ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute(); 

        $consulta = "SELECT id, node_id, alias, min_light_needed, water_needed, max_temperature, min_temperature FROM node ORDER BY id DESC LIMIT 1";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;
    case 2: //modificación
        $consulta = "UPDATE node SET node_id='$node_id', alias='$alias', min_light_needed='$min_light_needed', water_needed='$water_needed', max_temperature='$max_temperature',min_temperature='$min_temperature'  WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();        
        
        $consulta = "SELECT id, node_id, alias, min_light_needed, water_needed, max_temperature, min_temperature FROM node WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();
        $data=$resultado->fetchAll(PDO::FETCH_ASSOC);
        break;        
    case 3://baja
        $consulta = "DELETE FROM node WHERE id='$id' ";
        $resultado = $conexion->prepare($consulta);
        $resultado->execute();                           
        break;        
}

print json_encode($data, JSON_UNESCAPED_UNICODE); //enviar el array final en formato json a JS
$conexion = NULL;
