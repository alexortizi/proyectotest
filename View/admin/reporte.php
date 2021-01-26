
<h1 class="page-header">REPORTES</h1>
 <table id="t_reporte" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>CONVOCATORIA</th>
            <th>CATEGORIA</th>
			<th>ESTUDIANTE</th>
			<th>CEDULA</th>
			<th>Puntaje Estudiante</th>
			<th>Puntaje Total</th>
        </tr>
    </thead>
    <tbody>
		<?php $conta=0; 
		foreach($this->model->Listar($id) as $s){
		$estu[$conta]=$s->EST_ID; 
		$conta++;
		}
		for ($i=0;$i<$conta;$i++){
			
			foreach($this->model->Resul($estu[$i]) as $r){ ?>
		
        <tr>
            <td><?php echo $r->CON_FECHA; ?></td>
            <td><?php echo $r->CAT_CATEGORIA; ?></td>
            <td><?php echo $r->EST_ESTUDIANTE; ?></td>
			<td><?php echo $r->EST_CEDULA; ?></td>
            <td><?php if ($r->PUNTAJE!=""){echo $r->PUNTAJE;}else{echo 0;} ?></td>
            <td><?php if ($r->PRU_NUM!=""){echo $r->PRU_NUM;}else{echo 0;}?></td>
        
        </tr>
    <?php }
		}?>
	
        
    </tbody>
</table>
<script type="text/javascript">
	var idioma_espanol={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ puntajes",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando puntajes del _START_ al _END_ de un total de _TOTAL_ puntajes",
    "sInfoEmpty":      "Mostrando puntajes del 0 al 0 de un total de 0 puntajes",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ puntajes)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar Convocatoria,Cedula,Estudiante:",
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
        $('#t_reporte').DataTable({
        "lengthMenu": [[3, 6, 9, -1], [3, 6, 9, "Todas"]],
		"language":idioma_espanol	
    });
    });</script>


   
		
		
		
		
		
    
