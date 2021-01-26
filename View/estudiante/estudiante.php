<h1 class="page-header">INDICACIONES</h1>
    


 
 <form id="frm-estudiante" action="?c=estudiante&a=Crear" method="post" enctype="multipart/form-data">

   
  
    <?php foreach($this->model->VerIndicaciones($est) as $r): ?>
	 <div class="form-group">
        <label>PRUEBA A REALIZARSE EL DIA DE HOY  <?php echo $r->CON_FECHA; ?></label>
    </div>
	 
     <div class="form-group">
        <label>PERTENECIENTE A LA CATEGORIA DE <?php echo $r->CAT_CATEGORIA; ?></label>
    </div>
	 
	  <div class="form-group">
        <label>TIENE UN TIEMPO MAXIMO DE  <?php echo $r->PRU_TIEMPO; ?> PARA REALIZAR LA PRUEBA</label>
    </div>
	   <div class="form-group">
        <label>LE DESEAMOS MUCHA SUERTE <?php echo $r->EST_ESTUDIANTE; ?> !!!</label>
    </div>
	 
    <?php endforeach; ?>

        <button class="btn btn-primary">Empezar la prueba</button>
    
</form>

 
