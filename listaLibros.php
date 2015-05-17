<table class="table table-striped table-bordered" id="tablaLibros">
			<thead>
			    <tr class="tr-head">
			    	<th>Nombre del Libro</th>
			    	<th>Autor</th>
			    	<th>Descripción</th>
			    	<th>Modificar</th>
			    	<th>Eliminar</th>
			    </tr>
			</thead>
			<tbody>
				<?php
					require_once("connect_libros.php");

					if ($c_libros->count()>0)
					{
						$libros = $c_libros->find();
						foreach ($libros as $libro) {
						
				?>
				<tr>
					<td><?php echo $libro["nombre"]; ?></td>
					<td><?php echo $libro["autor"]; ?></td>
					<td><?php echo $libro["descripcion"]; ?></td>
					<td><a href="mod_libro.php?id=<?php echo $libro['_id'] ?>" class="btn btn-warning"><i class="icon-pencil icon-white"></i> Modificar</a></td>
					<td><a href="eliminar_libro.php?id=<?php echo $libro['_id'] ?>" class="btn btn-danger"><i class="icon-remove icon-white"></i> Eliminar</a></td>
				</tr>
				<?php
						}
					}else{
				?>
				<tr>
					<td colspan="4"><h4><i class="icon-info-sign"></i> Sin registros en la Base de Datos</h4></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>