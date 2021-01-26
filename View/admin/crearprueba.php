<h1 class="page-header">CREAR PRUEBA</h1>
    
		
	
<form id="frm-admin" action="?c=admin&a=Guardar" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label>Convocatoria</label>
      <input type="text" name="con_id" value="" class="form-control" placeholder="Ingrese Fecha Convocatoria" data-validacion-tipo="requerido|min:20" />
    </div>

    <div class="form-group">
        <label>Categoria</label>
	<?php
	foreach($this->model->VerCategoria($id) as $r): 
    ?>
 <input type="text" name="cat_id" value="<?php echo $r->CAT_CATEGORIA; ?>" class="form-control" placeholder="Ingrese Categoria" readonly=”readonly”/>
		 <?php endforeach; ?>
       
    </div>

    <div class="form-group">
        <label>TIEMPO</label>
        <input type="text" name="pru_tiempo" value="" class="form-control" placeholder="Ingrese Tiempo Maximo Prueba" data-validacion-tipo="requerido|min:100" />
    </div>

    <div class="form-group">
        <label>TEMAS</label>
		<p></p>
		<?php foreach($this->model->ListarTemas($id) as $r): ?>
       <input type="checkbox" name="check_list[]" value="<?php echo $r->TEM_TEMA; ?>"><label><?php echo $r->TEM_TEMA; ?></label>
	<input type="text" name="tem<?php echo $r->TEM_TEMA; ?>"id="tem<?php echo $r->TEM_TEMA; ?>" value="1">
    <?php endforeach; ?>
       
    </div>

    <hr />

    <div class="text-right">
        <button class="btn btn-success">Guardar</button>
    </div>
</form>
<script>
    $(document).ready(function(){
        $("#frm-admin").submit(function(){
            return $(this).validate();
        });
    })
</script>


