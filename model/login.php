<?php

session_start();
class login
{

public $CorreoElectronico;
public $Contrasena;
private $pdo;
	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    public function Login($CorreoElectronico, $Contrasena)
	{
        try
        {
            $stm = $this->pdo->prepare("SELECT * FROM usuario WHERE User_Email = ? AND User_Pass = ?");
            $stm->execute(array($CorreoElectronico,$Contrasena));
            $usuario = $stm->fetch(PDO::FETCH_OBJ);

           if ($usuario) {
            // Verifica el tipo de usuario y almacénalo en la sesión
            
            $_SESSION["logged_in"] = true;
            $_SESSION["session_type"] = $usuario->Usuario_Tipo;
            $_SESSION["session_email"] = $usuario->User_Email;
      
            // Llama a la función ObtenerSecion() para realizar cualquier otra acción deseada
           // $this->ObtenerSecion($CorreoElectronico);

            return $usuario;
        } else {
            $_SESSION["logged_in"] = false;
         
            return $usuario; // Las credenciales son incorrectas
        }
        }
        catch (Exception $e)
        {
            die($e->getMessage());
        }



	}

  public function ObtenerSecion($CorreoElectronico)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT Usuario_Tipo FROM usuario WHERE User_Email = ?");
			$stm->execute(array($CorreoElectronico));
		
      $resultado = $stm->fetch(PDO::FETCH_OBJ);
      if ($resultado) {
      $_SESSION["logged_in"] = true;
      $_SESSION["user_type"] = $usuario->Usuario_Tipo;
    
    }
      return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	
}
/*
$alert = '';
session_start();
if (!empty($_SESSION['active'])) {
  header('location: sistema/');
} else {
  if (!empty($_POST)) {
    if (empty($_POST['usuario']) || empty($_POST['clave'])) {
      $alert = '<div class="alert alert-danger" role="alert">
  Ingrese su usuario y su clave
</div>';
    } else {
      require_once "conexion.php";
      $user = mysqli_real_escape_string($conexion, $_POST['usuario']);
      $clave = mysqli_real_escape_string($conexion, $_POST['clave']);
      $query = mysqli_query($conexion, "SELECT u.IDUsuario, u.Nombres, u.Apellidos, u.CorreoElectronico,r.IDRol,r.Rol 
      
      FROM usuario u INNER JOIN roles r ON u.IDRol = r.IDRol WHERE u.CorreoElectronico = '$user' AND u.Contrasena = '$clave' AND u.Estado=1");
      mysqli_close($conexion);
      $resultado = mysqli_num_rows($query);
      if ($resultado > 0) {
        $dato = mysqli_fetch_array($query);
        $_SESSION['active'] = true;
        $_SESSION['IdUser'] = $dato['IDUsuario'];
        $_SESSION['Nombres'] = $dato['Nombres'];
        $_SESSION['Apellidos'] = $dato['Apellidos'];
        $_SESSION['Correo'] = $dato['CorreoElectronico'];


        $_SESSION['CarnetIdentidad'] = $dato['CarnetIdentidad'];
        $_SESSION['rol'] = $dato['IDRol'];
        $_SESSION['rol_name'] = $dato['Rol'];
        header('location: sistema/');
      } else {
        $alert = '<div class="alert alert-danger" role="alert">
              Usuario o Contraseña Incorrecta
            </div>';
        session_destroy();
      }
    }
  }
}*/
?>
