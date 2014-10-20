<?php defined('C5_EXECUTE') or die("Access Denied.");
?>

<div class="ccm-ui">
	<?php
	$dashboard = Loader::helper('concrete/dashboard');
	echo $dashboard->getDashboardPaneHeader('Listado de subastas');
	?>
	<div class="ccm-pane-body">
	<table class="table table-bordered">
		<tr>
			<th>ID</th>
			<th>Miniatura</th>
			<th>Tipo de bienes</th>
			<th>Localización</th>
			<th>Estado</th>
			<th>Fecha</th>
			<th>Datos Subasta</th>
		</tr>
		<?php foreach ($lista_subastas as $subasta): ?>
		<tr>
			<td><?php echo $subasta->id ?></td>
			<td>                            <?php 
                                        $imagen = File::getByID($subasta->miniatura);
                                        $ih = Loader::helper('image');
                                        $thumb = $ih->getThumbnail($imagen, 100, 100, true);
                                        ?>
                                        <img src="<?php echo $thumb->src; ?>" width="<?php echo $thumb->width; ?>" height="<?php echo $thumb->height; ?>" alt="" />
			</td>
			<td><?php echo $subasta->tipo_bienes ?></td>
			<td><?php echo $subasta->localizacion ?></td>
			<td><?php echo $subasta->estado ?></td>
			<td><?php echo date($subasta->fecha) ?></td>
			<td><?php echo $subasta->datos_subasta ?></td>
			<td>
				<a href="<?php echo $this->url('/dashboard/subastas/add/edit',$subasta->id)?>" class="btn">Editar</a>
				<a href="<?php echo $this->url('/dashboard/subastas/delete',$subasta->id)?>" class="btn danger">Borrar</a>
			</td>
		</tr>
		<?php endforeach; ?>


		</table>	
		<a href="<?php echo $this->url('/dashboard/subastas/add')?>" class="btn btn-primary">Añadir</a>
	</div>