<?php
class Database
{
    //Esta función permite la conexión al SGBD: MariaDB.
    //host = tipo de conexión local - 'localhost'.
    //dbname = nombre de la base de datos.
    //charset = utf8, indica la codificación de caracteres utilizada.
    //root = nombre de usuario (solo para fines académicos=root).
    //'' = contraseña del root (solo para fines académicos). u838621046_neurona_2

    public static function Conectar()
    {
       
     // $pdo = new PDO('mysql:host=193.203.175.91; dbname=u838621046_sis_neurona;charset=utf8', 'u838621046_admin', 'dellFX007');    //Filtrando posibles errores de conexión.
      
      
      $pdo = new PDO('mysql:host=193.203.175.91; dbname=u838621046_neurona_2;charset=utf8', 'u838621046_neurona_2', 'dellFX007');    //Filtrando posibles errores de conexión.
        
      //  $pdo = new PDO('mysql:host=193.203.175.91; dbname=u838621046_sis_neurona;charset=utf8', 'u838621046_admin', 'dellFX007');    //Filtrando posibles errores de conexión.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
