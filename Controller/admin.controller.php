<?php
require_once 'model/admin.php';
class AdminController{
    private $model;
    public function __CONSTRUCT(){
        $this->model = new admin();
		
    }
    //Llamado plantilla principal
    public function Index(){
session_start();  
 	if(isset($_SESSION["cat"]))  //verifica que este logeado
 	{  
	 $id=$_SESSION["cat"];
		require_once 'view/librerias.php';
	require_once 'view/admin/navbar.php';
    require_once 'view/admin/admin.php';//me muestra la pagiina de admin, es decir donde se encuentran las pruebas creadas
 
      
 	}  
 	else  
 	{  
      header("location:index.php");  
	}  
       
    }
	public function Crear(){
		 
		session_start();  
 	if(isset($_SESSION["cat"]))  //verifica que este logeado
 	{  
	 $id=$_SESSION["cat"];
	  	require_once 'view/head.php';
		require_once 'view/admin/navbar.php';
        require_once 'view/admin/crearprueba.php'; //me indica la pgina para crear pruebas
        require_once 'view/footer.php';
      
 	}  
 	else  
 	{  
      header("location:index.php");  
	}   
	
       
    }
	
	 public function Reporte(){
		 
		session_start();  
 	if(isset($_SESSION["cat"]))  //verifica que este logeado
 	{  
	 $id=$_SESSION["cat"];
		require_once 'view/librerias.php';
		require_once 'view/admin/navbar.php';
        require_once 'view/admin/reporte.php'; //me indica la pagina donde se encuentran las calificaciones de los estudiantes

      
 	}  
 	else  
 	{  
      header("location:index.php");  
	}   
       
		 
    }
   
    public function Guardar(){ //me guarda el examen
        $admin = new admin();
         $admin->con_id = $_REQUEST['con_id'];
         $admin->cat_id = $_REQUEST['cat_id'];
         $admin->pru_tiempo = $_REQUEST['pru_tiempo'];
         $this->model->Registrar($admin);//me registra la prueba
		$contador=0;
		foreach($_REQUEST['check_list'] as $check) {
		$vector[$contador]=$check; //recorre los temas asignados y los gurada
			$contador++;
    }
    for ($i=0;$i<$contador;$i++) 
	{
		$num=$_REQUEST['tem'.$vector[$i]];
		$admin = new admin();
         $admin->con_id = $vector[$i];
         $admin->cat_id = $num;
		$this->model->RegistrarTema($admin); //recorre los temas asignados y los gurada
    }
        header('Location: index.php?c=admin');
    }
   
}