<!DOCTYPE html>
<html lang="es">
  <head>
    <?php 
    	require_once("head.php");
    ?>
    <script type="text/javascript"> 
    $().ready(function (){
			$("#btnPublicar").click( function(event){
				event.preventDefault();
				var libro=document.getElementById('inputNameLibro');
				var autor=document.getElementById('autor');
				if (libro.value!="" && autor.value!="") {
        		var datastring = $('#formLibro').serialize();

				$.ajax({
		            type: 'POST',
		            url: 'add_libro.php',
		            data: datastring,
		            
		            success: function(data) {
		            	if (data==1) {
		            	
		            	$("#fracaso").fadeOut("slow");
		            	$(".btn.btn-warning").fadeOut("slow");
		            	$(".btn.btn-danger").fadeOut("slow");
		            	
		            	$("#exito").delay(500).fadeIn("slow");
		                $("#listaLibros").load("listaLibros.php");
		                $("#exito").delay(500).fadeOut("slow");

			            }else{
			            	$("#exito").fadeOut("slow");
	                    	$("#fracaso").delay(300).fadeIn("slow");
			            }
		            },
		            error: function(){
		                $("#exito").fadeOut("slow");
                    	$("#fracaso").delay(300).fadeIn("slow");
		            }
		        });
        	}
        });
    })
    </script>
  </head>
  <body>
  	<div class="navbar navbar navbar-inverse navbar-fixed-top">
	  <?php 
	  	require_once("nav.php");
	  ?>
	</div>
	<div class="container">
		<h2>MongoDB y PHP</h2>	

		<form class="form-horizontal" method="post" id="formLibro">
		  	<div class="control-group">
		    	<label class="control-label" for="inputNameLibro">Nombre del Libro</label>
		    	<div class="controls">
		      		<input type="text" name="nameLibro" id="inputNameLibro" class="input-xlarge" placeholder="Nombre del Libro"/>
		    	</div>
		  	</div>
			<div class="control-group">
		    	<label class="control-label" for="inputAutor">Nombre del Autor</label>
		    	<div class="controls">
		      		<select name="autor" id="autor" required>
		      		<option value="">Seleccione Autor</option>
		      			<?php
							require_once("connect_autores.php");

							if ($c_autores->count()>0)
							{
								$autores = $c_autores->find();
								foreach ($autores as $autor) {
						?>
						<option value="<?php echo $autor['nombre'] ?>"><?php echo $autor['nombre'] ?></option>
						<?php 
								}
							}
							
						?>
						<option value="Anónimo">Anónimo</option>
						<?php ?>
		      			
		      		</select>
		    	</div>
		  	</div>
		  	<div class="control-group">
		    	<label class="control-label" for="inputAutor">Breve descripción del libro</label>
		    	<div class="controls">
		      		<textarea name="descripcion" rows="6" class="input-xlarge"></textarea>
		    	</div>
		  	</div>
		  	<div class="control-group">
		    	<div class="controls">
		    	
		      		<button type="submit" class="btn btn-large btn-primary" id="btnPublicar" name="btnPublicar"><i class="icon-book icon-white"></i> Guardar Libro</button>
		    	</div>
		  	</div>
		  	<div style="display: block;">
		  		<div id="exito" style="display:none;position: absolute;">
					<p class='btn  btn-success'><i class='icon-ok icon-white'></i> El libro fue guardado con éxito.</p><br><br>
				</div>
				<div id="fracaso" style="display:none">
					<p class='btn  btn-danger'><i class='icon-trash icon-white' ></i>Error al realizar la operacion.</p><br><br>
				</div>
				<?php
					error_reporting(0);
					$mensaje = $_GET["mensaje"];
					if ($mensaje == 1) {
						echo "<p class='btn  btn-danger' style='position: absolute'><i class='icon-trash icon-white'></i> El libro fue eliminado con éxito.</p>";
					}
					if ($mensaje == 2) {
						echo "<p class='btn  btn-success' style='position: absolute'><i class='icon-ok icon-white'></i> El libro fue guardado con éxito.</p>";
					}
					if ($mensaje == 3) {
						echo "<p class='btn  btn-warning' style='position: absolute'><i class='icon-refresh icon-white'></i> El libro fue modificado con éxito.</p>";
					}
				?>
		  	</div>
		  		<br>
		</form>

		<h3>Lista de libro almacenados</h3>
		<div id="listaLibros">
			<?php
				include('listaLibros.php');
			?>
		</div>
		<footer>
		  
		</footer>
	</div> <!-- /container -->
    
  </body>
</html>