<?php
class estudiante
{
	private $pdo;
	public $est_id;
	public $pre_id;
	public $ta_id;
	public $hora_est;
	public $res;
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
	public function VerIndicaciones($est)  //tomo datos de la prueba y el estudiante
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT 
  t_convocatoria.CON_FECHA,
  t_categoria.CAT_CATEGORIA,
  t_prueba.PRU_TIEMPO,
  t_estudiante.EST_ESTUDIANTE
FROM
  t_prueba
  INNER JOIN t_convocatoria ON (t_prueba.CON_ID = t_convocatoria.CON_ID)
  INNER JOIN t_categoria ON (t_prueba.CAT_ID = t_categoria.CAT_ID)
  INNER JOIN t_estudiante ON (t_convocatoria.CON_ID = t_estudiante.CON_ID)
  AND (t_estudiante.CAT_ID = t_categoria.CAT_ID)
WHERE
  t_estudiante.EST_ID = ?");
			$stm->execute(array($est));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function SeleccionarEstudiante($est) //tomo los datos del estudiante
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM t_estudiante WHERE t_estudiante.EST_ID= ?");
			$stm->execute(array($est));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	} 
		public function RegistrarRespuesta(estudiante $data)  //asigno la regunta al estudiante
	
		{
	
		try
		{
			
		$sql = "UPDATE 
  t_preguntaasignada  
SET 
  t_preguntaasignada.PREA_RESPUESTA = ?,   
  t_preguntaasignada.PREA_ESTADO='1'
 
WHERE 
  t_preguntaasignada.PREA_ID = ?";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
					 $data->res,
					$data->ta_id
			
                )
			);
	
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	
		

	   }
	public function ActualizarPendiente(estudiante $data)  //asigno la regunta al estudiante
	
		{
	
		try
		{
			
		$sql = "UPDATE 
  t_preguntaasignada  
SET  
  t_preguntaasignada.PREA_PENDIENTE=?
 
WHERE 
  t_preguntaasignada.PREA_ID = ?";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
					 $data->res,
					$data->ta_id
			
                )
			);
	
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	
		

	   }
	
	public function SeleccionarPrueba($pru) //select a la prueba
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT 
  t_temaasignado.TEM_ID,
  t_temaasignado.TA_NUMPREG
FROM
  t_temaasignado
  INNER JOIN t_prueba ON (t_temaasignado.PRU_ID = t_prueba.PRU_ID)
  INNER JOIN t_tema ON (t_temaasignado.TEM_ID = t_tema.TEM_ID)
WHERE
  t_prueba.PRU_ID = ?
GROUP BY
  t_temaasignado.TEM_ID");
			$stm->execute(array($pru));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function SeleccionarPruebaTiempo($pru) //select a la prueba
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM t_prueba WHERE
  			t_prueba.PRU_ID = ?");
			$stm->execute(array($pru));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function existePre($est) //select para ver si existe preguntas asignadas
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT count(*) AS FIL
FROM
  t_prueba
  INNER JOIN t_estudiante ON (t_prueba.CON_ID = t_estudiante.CON_ID)
  AND (t_prueba.CAT_ID = t_estudiante.CAT_ID)
  INNER JOIN t_temaasignado ON (t_prueba.PRU_ID = t_temaasignado.PRU_ID)
  INNER JOIN t_preguntaasignada ON (t_temaasignado.TA_ID = t_preguntaasignada.TA_ID)
  AND (t_preguntaasignada.EST_ID = t_estudiante.EST_ID)
  INNER JOIN t_preguntas ON (t_preguntaasignada.PRE_ID = t_preguntas.PRE_ID)
WHERE
  t_estudiante.EST_ID = ?");
			$stm->execute(array($est));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function SeleccionarPreguntas($est) //selecciono la pregunta asignada al estudiante
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("CALL SP_SELECTPREGUNTAASIGNADA (?)");
			$stm->execute(array($est));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function verTiempo($est){ //tomo el tiempo dle estudiante, si no existe lo creo
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT 
  t_estudiante.EST_ESTUDIANTE,
  t_estudiante.EST_TIEMPO
FROM
  t_estudiante
WHERE
t_estudiante.EST_ID = ? AND   t_estudiante.EST_TIEMPO IS  NOT NULL");
			$stm->execute(array($est));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
		
	}
	public function SeleccionarPregunta($est) //selecciono las preguntas asignadas
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("CALL SP_SELECTPREGUNTASASIGNADAS (?)");
			$stm->execute(array($est));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function SeleccionarTemasPreguntas($est,$temaasignado)  //selecciono las preguntas pertenecientes a los temas de la prueba
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("CALL SP_SELECTPREGUNTASTEMA (?,?)");
			$stm->execute(array($est,$temaasignado));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
		public function AsignarPregunta(estudiante $data)  //asigno la regunta al estudiante
	
		{
	
		try
		{
			
		$sql = "INSERT INTO 
  t_preguntaasignada
(
  t_preguntaasignada.TA_ID,
  t_preguntaasignada.PRE_ID,
  t_preguntaasignada.EST_ID,
  t_preguntaasignada.PREA_ESTADO
) 
VALUE (
  ?,?,?,'0'
);";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
					 $data->ta_id,
					$data->pre_id,
					$data->est_id
                   
                )
			);
	
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	
		

	   }
	
	
	
	public function RegistrarHora(estudiante $data) //registro la hora que empezo a realizarse la prueba
	{
		try
		{
		$sql = "UPDATE 
  t_estudiante  
SET 
  t_estudiante.EST_TIEMPO = ?
 
WHERE 
  t_estudiante.EST_ID = ?
;";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
					 $data->hora_est,
					$data->est_id
                   
                )
			);
	
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function actualizarEstado($est) //actualizo el estado a 1 para indicar que el estudiante ya rindio su prueba
	{
		try
		{
		$sql = "UPDATE 
  t_estudiante  
SET 
  t_estudiante.EST_ESTADO ='1'


WHERE 
  t_estudiante.EST_ID = ?
;";
		$this->pdo->prepare($sql)
		     ->execute(
				array($est)
			);
			
	
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	
	
	
}