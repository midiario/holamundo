<?php
//Se incluye el modelo donde conectará el controlador.
require_once 'model/login.php';

class InicioController{

    private $model;

    //Creación del modelo
    public function __CONSTRUCT(){
        $this->model = new login();
    }

    //Llamado plantilla principal
    public function Index(){
        //require_once 'view/header.php';
        $login = new login();
        require_once 'view/inicio/login.php';
       // require_once 'view/footerx.php';
    }

    //Llamado a la vista proveedor-nuevo
    public function Login(){
        $login = new login();

        //Llamado de las vistas.
         require_once 'view/inicio/login.php';
       
    }
       //Llamado a la vista proveedor-nuevo
    public function LoginError(){
        $login = new login();

        //Llamado de las vistas.
         require_once 'view/inicio/login.php';
       
    }
        //Registrate

     public function Registrate(){
        $login = new login();
             //Llamado de las vistas.
        require_once 'view/Registro/nuevo_usuario.php';
          
    }
}
