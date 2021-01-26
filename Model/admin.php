<?php
class admin
{
	private $pdo;
    public $con_id;
    public $cat_id;
    public $pru_tiempo;
    public $pru_num;
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
	public function Listar($idcat) //me indica los estudiantes
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM t_estudiante
WHERE
  t_estudiante.CAT_ID = ?");
			$stm->execute(array($idcat));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function Resul($idcat) //me indica el puntaje de los estudiantes
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("CALL SP_SELECTESTUDIANTEPUNTAJE(?)");
			$stm->execute(array($idcat));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function ListarTemas($idcat)  //los temas pertenecientes a la categoria
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT 
  t_tema.TEM_TEMA
FROM
  t_categoriatema
  INNER JOIN t_tema ON (t_categoriatema.TEM_ID = t_tema.TEM_ID)
WHERE
  t_categoriatema.CATTEM_ESTADO = 1 AND 
  t_categoriatema.CAT_ID = ?");
			$stm->execute(array($idcat));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
		public function ListarPruebas($idcat) //me indica todas las pruenbas
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("CALL SP_SELECTPRUEBAS(?)");
			$stm->execute(array($idcat));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function VerCategoria($idcat) //me indica la categoria del administgrador
	{
		try
		{
			$stm = $this->pdo
			            ->prepare("SELECT * FROM t_categoria Where CAT_ID=$idcat");
			$stm->execute(array($idcat));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	
	public function Registrar(admin $data) //me guarda la prueba con los datos asignados
	{
		try
		{
		$sql = "CALL SP_INSERTPRUEBA (?, ?, ?)";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->con_id,
                    $data->cat_id,
                    $data->pru_tiempo
                    
               
                )
			);
	
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function RegistrarTema(admin $data) //me guarda los temas asignados a la prueba
	{
		try
		{
		$sql = "CALL SP_INSERTTEMAASIGNADO (?,?)";
		$this->pdo->prepare($sql)
		     ->execute(
				array(
                    $data->con_id,
                    $data->cat_id
                )
			);
	
		} catch (Exception $e)
		{
			die($e->getMessage());
		}
	}
}