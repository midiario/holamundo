<?php



require_once 'model/database.php';

$model = new inicio();



class inicio
{

	private $pdo;

   
	

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = database::Conectar();
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function CorreoExiste($valor){
        try {
            $stmt = $this->pdo->prepare("SELECT Cliente_Id, Cliente_Email FROM clientes WHERE Cliente_Email = ?");
			$stmt->execute(array($valor));
           // return $stmt->fetch() !== false;
			return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
	public function MenuLista()
	{
		try
		{

			$result = array();
			$stm = $this->pdo->prepare("SELECT a.Recomendacion_id as ID, a.Recomendacion_titulo AS TITULO,
			 b.Categoria_nombre AS categorias, a.Recomendacion_costo  AS COSTO ,
			 a.Recomendacion_estado AS ESTADO, a.Recomendacion_descripcion as DESCRIPCION, 
			 a.Recomendacion_ruta_carga AS CARGA,
			 a.Recomendacion_fecha_creacion AS FECHA
			FROM recomendacion a
			INNER JOIN categoria b ON a.Recomendacion_categoria = b.Categoria_id;");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function MenuTipo()
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM categoria");
			$stm->execute();
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM recomendacion");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function ListarEntrenamiento()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM pesos");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	

	public function ObtenerX($idX)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT a.Recomendacion_id as ID,
			 a.Recomendacion_titulo AS TITULO, b.Categoria_id AS IDCAT, 
			 b.Categoria_nombre AS categorias,
			 a.Recomendacion_estado AS ESTADO, a.Recomendacion_fecha_creacion AS FECHA,
			 a.Recomendacion_ubicacion_tour AS ubicacion,
			  a.Recomendacion_costo  AS COSTO ,
			 a.Recomendacion_descripcion as descr
			 FROM recomendacion a INNER JOIN categoria b ON a.Recomendacion_categoria = b.Categoria_id 
			 where a.Recomendacion_id = ?");
			$stm->execute(array($idX));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function ObtenerCel($celular)
	{
		try
		{
			$stm = $this->pdo->prepare("SELECT Cliente_Id	
            FROM clientes where Cliente_Celular=?");
			$stm->execute(array($celular));
            $resultado = $stm->fetch(PDO::FETCH_OBJ);

            if ($resultado !== false) {
                return $resultado->Cliente_Id;
            } else {
                return false;
            }

		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($data)
	{
		try
		{
			$stm = $this->pdo
        ->prepare("UPDATE recomendacion SET Recomendacion_estado = 0 WHERE recomendacion.Recomendacion_id = ?");

			$stm->execute(array($data));
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try
		{
			$sql = "UPDATE recomendacion SET
			Recomendacion_titulo           = ?,
			Recomendacion_ubicacion_tour   = ?,	
			Recomendacion_categoria        = ?,
			Recomendacion_costo            = ?,
			Recomendacion_descripcion      = ?,	
			Recomendacion_ruta_carga       = ?,
			Recomendacion_estado           = ?
			WHERE Recomendacion_id          = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array( 
                   		$data->valor_1,
						$data->valor_2,
						$data->valor_3,
						$data->valor_4,
						$data->valor_5,
						$data->valor_6,
						$data->valor_7,
						$data->valor_id
					)
				);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}




	}

	public function RegistrarpPago(inicio $data)
	{
		
		try
		{
			
			$sql = "INSERT INTO pagos_servicio (Pago_Cliente_Id,Pago_Meses, Pago_comprobante) VALUES (?, ?, ?)";
			$this->pdo->prepare($sql)
				->execute(
					array(
						$data->dato1,
						$data->dato2,
						$data->dato3              
					)
				);
			$idCliente = $this->pdo->lastInsertId();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
    public function Registrar_Interes(inicio $data)
    {
        try
        {
            // Define un array con todas las entradas
            $entradas = [
                $data->dato1_entrada,
                $data->dato2_entrada,
                $data->dato3_entrada,
                $data->dato4_entrada,
                $data->dato5_entrada,
                $data->dato6_entrada,
            ];
    
            // Recorre todas las entradas y las inserta en la base de datos si tienen datos
            foreach ($entradas as $entrada) {
                if (!empty($entrada)) {
                    $sql = "INSERT INTO interes_cliente 
                            (id_interes_atracciones, id_cliente)
                            VALUES (?, ?)";
    
                    $this->pdo->prepare($sql)
                        ->execute([$entrada, $data->dato_id]);
                }
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    
	public function Registrar(inicio $data)
	{
		try
		{

				$sql = "INSERT INTO clientes 
				(Cliente_Nombres,
				Cliente_Apellidos,
				Cliente_Pais,
				Cliente_Edad,
				Cliente_Celular,
				Cliente_Sexo,
                Cliente_Email,
                Cliente_Password,
                Cliente_Compania
                )
		        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

		$this->pdo->prepare($sql)
		     ->execute(
				array(
					$data->dato1_nombre,
                    $data->dato2_apellidos,
                    $data->dato3_pais,
                    $data->dato4_edad,
					$data->dato5_celular,
					$data->dato6_sexo,
                    $data->dato7_email,
					$data->dato8_pass2,
					$data->dato9_compania
                )
			);
            $idCliente = $this->pdo->lastInsertId();
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}

	
	

    public function ObtenerDatosUsuarioPorEmail($email) {
        try {
            // Preparar la consulta SQL para obtener los datos del usuario
            $sql = "SELECT Cliente_Id, Cliente_Edad, Cliente_Celular, Cliente_Sexo, Cliente_Email FROM clientes WHERE Cliente_Email = ?";
            $stmt = $this->pdo->prepare($sql);
            
            // Ejecutar la consulta con el correo electrónico como parámetro
            $stmt->execute([$email]);
            
            // Obtener el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si se encontró un resultado
            if ($resultado) {	
				echo "<script>
					sessionStorage.setItem('Cliente_Id', '" . $resultado['Cliente_Id'] . "');
					sessionStorage.setItem('Cliente_Edad', '" . $resultado['Cliente_Edad'] . "');
					sessionStorage.setItem('Cliente_Celular', '" . $resultado['Cliente_Celular'] . "');
					sessionStorage.setItem('Cliente_Sexo', '" . $resultado['Cliente_Sexo'] . "');
					sessionStorage.setItem('Cliente_Email', '" . $resultado['Cliente_Email'] . "');
					console.log('Datos guardados en sessionStorage');
				</script>";
				echo "<script>console.log(" . json_encode($resultado) . ");</script>";

                // Devolver los datos del usuario como un array asociativo
                return $resultado;
            } else {
				echo "<script>
				
				console.log(' no hay datos guardados en sessionStorage');
			</script>";
                // No se encontró un usuario con ese correo electrónico
                return false;
            }
		} catch (Exception $e) {
			echo "Error en la consulta: " . $e->getMessage();
			die();
		}
    }

    public function ObtenerHashPorEmail($email) {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT Cliente_Password FROM clientes WHERE Cliente_Email = ?";
            $stmt = $this->pdo->prepare($sql);
            
            // Ejecutar la consulta con el correo electrónico como parámetro
            $stmt->execute([$email]);
            
            // Obtener el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si se encontró un resultado
            if ($resultado) {
                // Devolver el hash de la contraseña
                return $resultado['Cliente_Password'];
            } else {
                // No se encontró un usuario con ese correo electrónico
                return false;
            }
        } catch (Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir durante la consulta
            die($e->getMessage());
        }
    }
    public function VerificarActivo($email) {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT Cliente_Estado FROM clientes WHERE Cliente_Email = ?";
            $stmt = $this->pdo->prepare($sql);
            
            // Ejecutar la consulta con el correo electrónico como parámetro
            $stmt->execute([$email]);
            
            // Obtener el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si se encontró un resultado
            if ($resultado) {
                // Devolver el hash de la contraseña
                return $resultado['Cliente_Estado'];
            } else {
                // No se encontró un usuario con ese correo electrónico
                return false;
            }
        } catch (Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir durante la consulta
            die($e->getMessage());
        }
    }

	public function VerificarActivoPago($email) {
        try {
            // Preparar la consulta SQL
            $sql = "SELECT A.Pago_Cliente_Id as Cliente_Estado FROM pagos_servicio A INNER JOIN clientes B ON B.Cliente_Id= A.Pago_Cliente_Id WHERE B.Cliente_Email=?";
			
            $stmt = $this->pdo->prepare($sql);
            
            // Ejecutar la consulta con el correo electrónico como parámetro
            $stmt->execute([$email]);
            
            // Obtener el resultado de la consulta
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            
            // Verificar si se encontró un resultado
            if ($resultado) {
                // Devolver el hash de la contraseña
                return $resultado['Cliente_Estado'];
            } else {
                // No se encontró un usuario con ese correo electrónico
                return false;
            }
        } catch (Exception $e) {
            // Manejar cualquier excepción que pueda ocurrir durante la consulta
            die($e->getMessage());
        }
    }

    public function IniciarLogeo(inicio $data)
    {
        try
        {
            $sql = "SELECT * FROM clientes WHERE Cliente_Email = ? AND Cliente_Password = ? AND Cliente_Estado = 1";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$data->dato1_email, $data->dato2_pass]);
            
            $resultado = $stmt->fetch(PDO::FETCH_OBJ);
    
            if ($resultado !== false) {
                return $resultado->Cliente_Id;
            } else {
                return false;
            }
        } catch (Exception $e)
        {
            die($e->getMessage());
        }
    }
    
    
}
