<?php
class login
{
	private $pdo;
    public $username;
    public $password;
   
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
	
	
	public function BuscarUsuario(login $data)
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT * FROM t_usuario WHERE USU_USUARIO = ? AND USU_PASSWORD = ?");
			$stm->execute(array($data->username,
                    $data->password));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}
	public function BuscarEstudiante(login $data)
	{
		try
		{
			$result = array();
			$stm = $this->pdo->prepare("SELECT 
  t_prueba.PRU_ID,
  t_convocatoria.CON_FECHA,
  t_categoria.CAT_ID,
  t_estudiante.EST_ID
FROM
  t_prueba
  INNER JOIN t_categoria ON (t_prueba.CAT_ID = t_categoria.CAT_ID)
  INNER JOIN t_estudiante ON (t_estudiante.CAT_ID = t_categoria.CAT_ID)
  INNER JOIN t_convocatoria ON (t_prueba.CON_ID = t_convocatoria.CON_ID)
  AND (t_estudiante.CON_ID = t_convocatoria.CON_ID)

  WHERE t_estudiante.EST_ESTUDIANTE = ? AND t_estudiante.EST_PASSWORD = ?");
			$stm->execute(array($data->username,
                    $data->password));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
		
	}

}