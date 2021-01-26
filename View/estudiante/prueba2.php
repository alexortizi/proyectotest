
    <html>
		
	<h1 class="page-header" >COMPLETE LA PRUEBA ANTES DE QUE TERMINE EL TIEMPO
	
	<div id="time" >timeout</div><div id="aviso" style="color:#FF0000;"></div>	</h1>
	

<body onload="timeout()">
</body>	

<table id="table_id" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%" >
    <thead>
        <tr>
            <th>ESTADO</th>
            <th>RECORDATORIO</th>
			<th>PREGUNTA</th>
			<th>TEMA</th>
			<th>CONTESTAR</th>
        </tr>
    </thead>
    <tbody>
		<?php $conta=$_SESSION["conteo"]; //numero de preguntas
		for($i=0;$i<$conta;$i++){
			$vector=$_SESSION["pregun".($i)];
			?>
			<tr>
				
            <td><?php if ($vector[7]==1){ //PARA SABER SI ESTA CONTESTADA O NO
				?><label id="l_<?php echo $vector[1];?>"><img src="assets/img/visto.png" alt="Contestada" width="25" height="25"></label><?php 
			}else{?><label id="l_<?php echo $vector[1];?>"><img src="assets/img/x.png" alt="No Contestada" width="25" height="25"></label><?php } ?></td>
				
				
            <td><?php if ($vector[10]==1){ //PARA SABER SI ESTA PENDIENTE O NO
				?><label id="pendiente_<?php echo $vector[1];?>"><input type="image" src="assets/img/pendiente.png" alt="pendiente" width="50" height="25" onClick="nopendiente(<?php echo $vector[1];?>)"></label><?php 
			}else{?><label id="pendiente_<?php echo $vector[1];?>"><input type="image" src="assets/img/nopendiente.png" alt="No pendiente" width="50" height="25" onClick="pendiente(<?php echo $vector[1];?>)"></label><?php } ?> </td> 
				
			<td><?php echo $vector[0]; //pregunta?></td>
			<td><?php echo $vector[8]; //tema?></td>
			<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#conpre<?php echo $vector[1];?>">
  Contestar Pregunta
</button></td>
        </tr>
		<?php
	
};
	?>
        
    </tbody>
</table>
		<?php
	for($i=0;$i<$conta;$i++){
			$vector=$_SESSION["pregun".($i)];
			?>
<form id="frm_<?php echo $vector[1];?>" method="POST">
		
	
<div class="modal fade" id="conpre<?php echo $vector[1];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $vector[0];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		  <input type="text" name="preguntaasignada" value="<?php echo $vector[1];?>" hidden>
		  <?php
        if($vector[9]==1) { //para saber cual esta seleccionada
			?><input type="radio" name="resul<?php echo $vector[1];?>" value="1" checked><label><?php echo $vector[2];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="2"><label><?php echo $vector[3];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="3"><label><?php echo $vector[4];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="4"><label><?php echo $vector[5];?></label><p></p><?php
		}else if($vector[9]==2) {
			?><input type="radio" name="resul<?php echo $vector[1];?>" value="1"><label><?php echo $vector[2];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="2" checked><label><?php echo $vector[3];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="3"><label><?php echo $vector[4];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="4"><label><?php echo $vector[5];?></label><p></p><?php
		}else if($vector[9]==3) {
			     ?><input type="radio" name="resul<?php echo $vector[1];?>" value="1"><label><?php echo $vector[2];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="2"><label><?php echo $vector[3];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="3" checked><label><?php echo $vector[4];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="4"><label><?php echo $vector[5];?></label><p></p><?php
		}else if($vector[9]==4) {
		?><input type="radio" name="resul<?php echo $vector[1];?>" value="1"><label><?php echo $vector[2];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="2"><label><?php echo $vector[3];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="3"><label><?php echo $vector[4];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="4" checked><label><?php echo $vector[5];?></label><p></p><?php	
		
		}else{
			?><input type="radio" name="resul<?php echo $vector[1];?>" value="1"><label><?php echo $vector[2];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="2"><label><?php echo $vector[3];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="3"><label><?php echo $vector[4];?></label><p></p>
       <input type="radio" name="resul<?php echo $vector[1];?>" value="4"><label><?php echo $vector[5];?></label><p></p><?php
		}
    

			?>
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary" onClick="guardar(<?php echo $vector[1];?>)">Guardar Respuesta</button>
      </div>
    </div>
  </div>
</div>
	</form>
		<?php
	
};
			?>


		
		
		
	<div class="modal fade" id="term" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop="false" style="background-color: rgba(0, 0, 0, 0.5);" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
		Esta Seguro que desea Terminar La Prueba?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" class="btn btn-danger" onClick="terminar()">Si</button>
      </div>
    </div>
  </div>
</div>
		<button type="button" class="btn btn-danger"  data-toggle="modal" data-target="#term">
 TERMINAR PRUEBA
</button>


</html>
	
   
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	
<script type="text/javascript">
	var idioma_espanol={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ preguntas",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando preguntas del _START_ al _END_ de un total de _TOTAL_ preguntas",
    "sInfoEmpty":      "Mostrando preguntas del 0 al 0 de un total de 0 preguntas",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ preguntas)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar Tema o Pregunta:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
};
	$(document).ready(function () {
        $('#table_id').DataTable({
        "lengthMenu": [[3, 6, 9, -1], [3, 6, 9, "Todas"]],
		"language":idioma_espanol	
    });
    });


	
	function guardar(dato){
			var datos=$('#frm_'+dato).serialize();
			
			$.ajax({
				type:"POST",
				url:"index.php?c=estudiante&a=GuardarPregunta",
				data:datos,
				 success: function(datos){       
                    $('#l_'+dato).html('<img src="assets/img/visto.png" alt="Contestada" width="25" height="25">');
                }
            });
	}
	function pendiente(dato){
		 var parametros = {
                "idpreg" : dato,
                "valor" : 1
        };
			
			
			$.ajax({
				type:"POST",
				url:"index.php?c=estudiante&a=PendientePregunta",
				data:parametros,
				 success: function(datos){       
                   $('#pendiente_'+dato).html('<input type="image" src="assets/img/pendiente.png" alt="pendiente" width="50" height="25" onClick="nopendiente('+dato+')">');
                }
            });
	}
	function nopendiente(dato){
			 var parametros = {
                "idpreg" : dato,
                "valor" : 0
        };
			
			
			$.ajax({
				type:"POST",
				url:"index.php?c=estudiante&a=PendientePregunta",
				data:parametros,
				 success: function(datos){  
					    $('#pendiente_'+dato).html('<input type="image" src="assets/img/nopendiente.png" alt="no pendiente" width="50" height="25" onClick="pendiente('+dato+')">');
                   
                }
            });
	}
	
	
	
	function terminar(){
		
		 location.href ="index.php?c=estudiante&a=terminar";
	}
	
	

			
	
</script>


	