 <html>  
      <head>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
      </head>  
      <body>  
           <br />  
           <div class="container" style="width:500px;">  
                <?php  
                if(isset($message))  
                {  
                     echo '<label class="text-danger">'.$message.'</label>';  
                }  
                ?>  
                <h3 align="">LOGIN PUCESI</h3><br />  
             <form id="frm-login" action="?c=login&a=Guardar" method="post" enctype="multipart/form-data">
                     <label>Usuario</label>  
                     <input type="text" name="username" class="form-control" data-validacion-tipo="requerido|min:100"/>  
                     <br />  
                     <label>Contraseña</label>  
                     <input type="password" name="password" class="form-control" data-validacion-tipo="requerido|min:100"/>  
                     <br />  
                     <input type="submit" name="login" class="btn btn-info" value="Entrar" />  
                </form>  
           </div>  
           <br />  
      </body>  
 </html>  