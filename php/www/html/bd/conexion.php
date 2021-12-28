<?php
 class Conexion{
     public static function Conectar(){
         define('dsn','mysql:host=localhost;dbname=web_estacion_central;unix_socket=/var/run/mysqld/mysqld.sock');
         define('host','localhost');
         define('dbname','web_estacion_central');
         define('unix_socket','localhost');
         define('usuario','root');
         define('password','root');
         $opciones = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',);

         try{
         $conexion = new mysqli(host, usuario, password,dbname);
            if ($mysqli->connect_errno) {
               die("error de conexión: " . $mysqli->connect_error);
            }
//             $conexion = new PDO('mysql:host=' . host . ';dbname='. dbname .';charset=UTF8;unix_socket=' . unix_socket, usuario, password);
            return $conexion;
         }catch (Exception $e){
             die("El error de Conexión es :".$e->getMessage());
         }
     }
     
 }
?>