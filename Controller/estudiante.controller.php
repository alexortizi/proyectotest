<?php
require_once 'model/estudiante.php';
class EstudianteController{
    private $model;
    public function __CONSTRUCT(){
        $this->model = new estudiante();
		
    }
	
    //Llamado plantilla principal
    public function Index(){
		session_start();  
 	if(isset($_SESSION["pru"]) && isset($_SESSION["con"]) && isset($_SESSION["est"]) ) //verifico que se encuentre logeado
 	{  
	 $pru=$_SESSION["pru"];
	 $con=$_SESSION["con"];
	 $est=$_SESSION["est"];	
	 $tiempo=''.date('Y',time()).'-'.date('m',time()).'-'.date('d',time()).''; //dia actual
		//for para seleccionar el estado del estudiante
   foreach($this->model->SeleccionarEstudiante($est) as $r):
		 $estado=$r->EST_ESTADO;
		endforeach;
		
		if($estado==0){//estudiante=1 significa que ya rindio la prueba
		if ($con==$tiempo){ //si es la convocatoria el dia de hoy
			$horaest=0; //variable para ver si existe una hora es decir ya empezo el examen
			foreach($this->model->verTiempo($est) as $r):
		 $horaest=$r->EST_TIEMPO;
		endforeach;
	if ($horaest==0){ //quiere decir que aun no ha empezado a rendir la prueba sino le mando a que continue
		foreach($this->model->existePre($est) as $r): //tomo las filas es decir el numero de preguntas
		 $existe=$r->FIL;
		endforeach;
		if ($existe<=0){ //si existe no realiza nada, si no existe me crea las preguntas
	
		//METODO PARA ASIGNAR PREGUNTAS
		
	
		$cont=0;
			
		foreach($this->model->SeleccionarPrueba($pru) as $r): //tomo los temas pertenecientes a la prueba
			$temas[$cont]=$r->TEM_ID;
			$numpretem[$cont]=$r->TA_NUMPREG;
		$cont++;
		endforeach;
		for ($i=0;$i<$cont;$i++){
			$y = new EstudianteController();
			$y->crearPreguntas($numpretem[$i],$temas[$i],$est);
			
		}	
			
		
			}
		//muestro menu de prueba
		 require_once 'view/head.php';
      require_once 'view/estudiante/navbar.php';
	  require_once 'view/estudiante/estudiante.php';
      require_once 'view/footer.php';
	
	}else{ 
		header("location:index.php?c=estudiante&a=Crear"); //sigo resolviendo la prueba
	}
		
	 
		
		}else{
			 require_once 'view/head.php';
	  		require_once 'view/estudiante/fecha.php'; //convocatoria equivocada
      		require_once 'view/footer.php';	
		}
	 
      
 	}else{  
		require_once 'view/head.php';
	 require_once 'view/estudiante/estado.php'; //prueba ya realizada
      require_once 'view/footer.php';
	}
	
       
    }else{
		header("location:index.php");  
	}
	}
		 
function crearPreguntas($numpreguntas,$idtemaasignado,$estu){
	
		//METODO PARA TOMAR ALEATORIAMENTE LAS PREGUNTAS
	$contador=0;
	$filas=$numpreguntas;
	foreach($this->model->SeleccionarTemasPreguntas($estu,$idtemaasignado) as $r):  //tomo todas las preguntas de acuerdo al examen
		$estudiante = new estudiante();
		$estudiante->est_id =$estu;
	     $auxiliar[$contador]=$r->PRE_ID; //asigno cada pregunta en una posicion de un array
		 $temaid=$r->TA_ID; //id de la tabla de temas asignados
		$contador++;
		endforeach;
	
$num = Array();
 reset($num);
 for($i=1;$i<=$filas;$i++)
 {
   $num[$i]=$auxiliar[rand(0,($contador-1))];
    if($i>1)
    {
       for($x=1; $x<$i; $x++)
       {
         if($num[$i]==$num[$x])
         {
           $i--;
           break;
         }
      }
   }
 }
 foreach($num as $valor){  //recorro todos mis preguntas aleatorias y asigno la pregunta
	$estudiante = new estudiante();
			$estudiante->est_id =$estu;
			 $estudiante->pre_id =$valor;
         	$estudiante->ta_id =$temaid;
			$this->model->AsignarPregunta($estudiante); //asigno la pregunta al estudiante
 }

		
		//METODO PARA ASIGNAR PREGUNTAS
	
}
	public function Crear(){
		 		session_start();  
		if(isset($_SESSION["pru"]) && isset($_SESSION["con"]) && isset($_SESSION["est"]) )   //verifico que se encuentre logeado
 	{  
	 $pru=$_SESSION["pru"];
	 $con=$_SESSION["con"];
	 $est=$_SESSION["est"];	
	//metodo para asignar el tiempo		
	 $horaest=0;		//variable que tendra el tiempo del estudiante
	foreach($this->model->SeleccionarPruebaTiempo($pru) as $r):
		 $hora=$r->PRU_TIEMPO;//tomamos el tiempo de la prueba
		endforeach;
		foreach($this->model->verTiempo($est) as $r):
		 $horaest=$r->EST_TIEMPO; //verificamos si existe tiempo 
		endforeach;
	if ($horaest==0){ //no existe tiempo, es decir el estudiante aun no ha empezado la prueba
		$horaest=''.date('H',time()).':'.date('i',time()).':'.date('s',time()).'';
		
		$estudiante = new estudiante();
		$estudiante->est_id =$est;
         $estudiante->hora_est =$horaest;
        $this->model->RegistrarHora($estudiante); //asignamos la hora que empezo la prueba para el estudiante
	}
			//tomamos hora actual(tiempo transcurrido) y dividimos las horas que tenemos
$horaact=''.date('H',time()).':'.date('i',time()).':'.date('s',time()).'';
	list($h3, $m3, $s3) = explode(':', $horaact);   
	 list($h2, $m2, $s2) = explode(':', $horaest);   
    list($h, $m, $s) = explode(':', $hora); 
   $tiempohora=(($h * 3600) + ($m * 60) + $s)+(($h2 * 3600) + ($m2 * 60) + $s2); //tiempo maximo para la prueba
   $tiemporestante=$tiempohora-(($h3 * 3600) + ($m3 * 60) + $s3);//tiempo maximo-tiempo transcurrido
			?>
 <script type="text/javascript">
    var timeLeft = '<?php echo $tiemporestante;?>'
</script>
<script type="text/javascript">
	//clase que realiza el cronometro
	function timeout()
	{
		var hours=Math.floor(timeLeft/3600);
		var minute=Math.floor((timeLeft-(hours*3600))/60);
		var second=timeLeft-(hours*3600)-(minute*60);
		var hrs=checktime(hours);
		var mint=checktime(minute);
		var sec=checktime(second);
		if(timeLeft<=0) //termina la prueba
		{
			clearTimeout(tm);
			 location.href ="index.php?c=estudiante&a=terminar";
		}else if(timeLeft<=60){
			document.getElementById("aviso").innerHTML="Queda menos de 1 minuto, apresurate!"; 
			document.getElementById("time").innerHTML=hrs+":"+mint+":"+sec;
		}
		else
		{

			document.getElementById("time").innerHTML=hrs+":"+mint+":"+sec; //asigno el tiempo restante
		}
		timeLeft--;
		var tm= setTimeout(function(){timeout()},1000);
	}
	function checktime(msg)
	{
		if(msg<10)
		{
			msg="0"+msg;
		}
		return msg;
	}
	</script>
<?php
			
		
	//SELECCIONA LAS PREGUNTAS			
	 $cont=0; foreach($this->model->SeleccionarPreguntas($est) as $r): 
		$array[0]=$r->PRE_PREGUNTA;
		$array[1]=$r->PREA_ID;	
		$array[2]=$r->PRE_OPCION1;
		$array[3]=$r->PRE_OPCION2;
		$array[4]=$r->PRE_OPCION3;
		$array[5]=$r->PRE_OPCION4;
	    $array[6]=$r->PRE_ID;
	    $array[7]=$r->PREA_ESTADO;
		$array[8]=$r->TEM_TEMA;
		$array[9]=$r->PREA_RESPUESTA;
		$array[10]=$r->PREA_PENDIENTE;
	    $_SESSION["pregun".$cont]=$array; //asigno en un array todas las preguntas
		$cont++;
	  
     endforeach; 
				
			$_SESSION["conteo"]=$cont; //contador de preguntas, al comienzo es 0
			if ($cont<=0){ //quiere decir que ya ha contestado todas las preguntas
		
				header("location:index.php?c=estudiante&a=terminar");
			}
			
		
			
		require_once 'view/librerias.php'; 
		require_once 'view/estudiante/prueba2.php';  //mando a la pagina de prueba
		//require_once 'view/footer.php';
			
				
    }else{
		header("location:index.php");  
	}
	   
	
       
    }
	
	 
	public function GuardarPregunta(){
		
		if (isset($_POST["preguntaasignada"])){ //si existe preguntaasignada
			 $idpreguntaasignada=$_POST["preguntaasignada"]; //creo una variable que contiene el id de la preguntaasignada
		if (isset($_POST["resul$idpreguntaasignada"])){ //si existe un resultado, guardamos la respuesta
			  
				$res=$_POST["resul$idpreguntaasignada"];
				 $estudiante = new estudiante();
			 	$estudiante->res=$res;
         		$estudiante->ta_id =$idpreguntaasignada;
				$this->model->RegistrarRespuesta($estudiante);	
		}
		}
	}
	
	
	public function PendientePregunta(){
		
		if (isset($_POST["idpreg"]) && isset($_POST["valor"])){ //si existe preguntaasignada
			 $idpreguntaasignada=$_POST["idpreg"]; //creo una variable que contiene el id de la preguntaasignada
			 $val=$_POST["valor"];
				$res=$_POST["resul$idpreguntaasignada"];
				 $estudiante = new estudiante();
			 	$estudiante->res=$val;
         		$estudiante->ta_id =$idpreguntaasignada;
				$this->model->ActualizarPendiente($estudiante);	
		
		}
	}

	

    
	 public function terminar(){ //me muestra la pantalla final si termino el examen y cambia el estado del estudiante a 0
		session_start();  
 	if(isset($_SESSION["pru"]) && isset($_SESSION["con"]) && isset($_SESSION["est"]) )   //verifico que se encuentre logeado
 	{  
	 $pru=$_SESSION["pru"];
	 $con=$_SESSION["con"];
	 $est=$_SESSION["est"];	

	$this->model->actualizarEstado($est); //cambio el estado a 1 es decir ya resolvio la prueba
		
	  require_once 'view/head.php';
      require_once 'view/estudiante/navbar.php';
	  require_once 'view/estudiante/estado.php'; //muestro pantalla con mensaje de haber terminado la prueba
      require_once 'view/footer.php';  
		session_destroy();  
    }else{
		header("location:index.php");  
	} 
    }
   
    
	
	
}