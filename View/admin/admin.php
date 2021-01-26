
<h1 class="page-header">PRUEBAS CREADAS</h1>
<table id="t_admin" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>CONVOCATORIA</th>
            <th>CATEGORIA</th>
            <th>TIEMPO</th>
           
          
        </tr>
    </thead>
    <tbody>
    <?php foreach($this->model->ListarPruebas($id) as $r): ?>
        <tr>
            <td><?php echo $r->CON_FECHA; ?></td>
            <td><?php echo $r->CAT_CATEGORIA; ?></td>
            <td><?php echo $r->PRU_TIEMPO; ?></td>
           
          
        
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<script type="text/javascript">
	var idioma_espanol={
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ pruebas",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando pruebas del _START_ al _END_ de un total de _TOTAL_ pruebas",
    "sInfoEmpty":      "Mostrando pruebas del 0 al 0 de un total de 0 pruebas",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ pruebas)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar Convocatoria,Tiempo:",
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
        $('#t_admin').DataTable({
        "lengthMenu": [[3, 6, 9, -1], [3, 6, 9, "Todas"]],
		"language":idioma_espanol	
    });
    });</script>