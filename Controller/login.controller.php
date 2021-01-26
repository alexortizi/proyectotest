<?php
require_once 'model/login.php';
class loginController{
    private $model;
    public function __CONSTRUCT(){
        $this->model = new login();
    }
    //Llamado plantilla principal
    public function Index(){
        require_once 'view/head.php';
        require_once 'view/login/login.php';
        require_once 'view/footer.php';
    }
    public function Guardar(){
        $login = new login();
        $login->username = $_REQUEST['username'];
        $login->password= $_REQUEST['password'];
		foreach($this->model->BuscarUsuario($login) as $r){
			 session_start();
			$_SESSION["cat"] = $r->CAT_ID;
		}
		
		foreach($this->model->BuscarEstudiante($login) as $r){
			 session_start();
			$_SESSION["pru"] = $r->PRU_ID;
			$_SESSION["con"] = $r->CON_FECHA;
			$_SESSION["est"] = $r->EST_ID;	
		}
		
		if(isset($_SESSION["pru"]) && isset($_SESSION["con"]) && isset($_SESSION["est"]) )  
 	{
			header('Location: index.php?c=estudiante&a=Index');
			
    }else if(isset($_SESSION["cat"])){
			header('Location: index.php?c=admin&a=Index');
			
			
		}else{
				header('Location: index.php?c=login&a=Index2');
		}
		
	
                    
	
		
    }
	
	public function Index2(){
		 $message = '<label>Datos mal ingresados</label>'; 
        require_once 'view/head.php';
        require_once 'view/login/login.php';
        require_once 'view/footer.php';
    }
	
	public function Buscar(){
		
	}
    
}