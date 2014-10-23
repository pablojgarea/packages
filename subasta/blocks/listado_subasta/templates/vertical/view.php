<?php  defined('C5_EXECUTE') or die("Access Denied.");
?>

<?php


	function ordernarArray ($ArrayaOrdenar, $por_este_campo, $descendiente = false) {
		$posicion = array();
		$NuevaFila = array();
		foreach ($ArrayaOrdenar as $clave => $fila) {
		$posicion[$clave] = $fila[$por_este_campo];
		$NuevaFila[$clave] = $fila;
		}
		if ($descendiente) {
		arsort($posicion);
		}
		else {
		asort($posicion);
		}
		$ArrayOrdenado = array();
		foreach ($posicion as $clave => $pos) {
		$ArrayOrdenado[] = $NuevaFila[$clave];
		}
		return $ArrayOrdenado;
	} //fin de la funcion

	$parametros_busqueda = array();

	if (!empty($field_1_textbox_text)): 
		$parametros_busqueda['tipo_bienes']=$field_1_textbox_text; 
	endif;

	if (!empty($field_2_textbox_text)): 
		$parametros_busqueda['localizacion']=$field_2_textbox_text; 
	endif;

	if (!empty($field_3_textbox_text)): 
		$parametros_busqueda['estado']=$field_3_textbox_text; 
	endif;

	// if (!empty($field_4_textbox_text)): 
	// 	array_push($parametros,'field_4_textbox_text',$field_4_textbox_text); 
	// endif;

	// if (!empty($field_5_textbox_text)): 
	// 	array_push($parametros,'field_5_textbox_text',$field_5_textbox_text); 
	// endif;

?>

<?php	
		Loader::model('subasta','subasta');

		$subasta_busqueda = new Subasta();

//		$lista_subastas = $subasta->find('1=1');
		$lista_subastas = $subasta_busqueda->search($parametros_busqueda);

?>

	<div class="row listado-cuadros-subastas">			
		<?php foreach ($lista_subastas as $subasta): ?>
			<div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 cuadro-subasta">
				<div class=" miniatura ">
				                        <?php 
                                        $imagen = File::getByID($subasta->miniatura);
                                        $ih = Loader::helper('image');
                                        $thumb = $ih->getThumbnail($imagen, 150, 150, true);
                                        ?>
                                        <img src="<?php echo $thumb->src; ?>" width="<?php echo $thumb->width; ?>" height="<?php echo $thumb->height; ?>" alt="" />
				</div>
				<div class="datos-subasta">			
					<b>Tipo de bienes: </b><?php echo $subasta->tipo_bienes ?>
					<br><b>Localización:</b><br><?php echo $subasta->localizacion ?>
					<br><b>Estado: </b><?php echo $subasta->estado ?>
					<br><?php echo $subasta->datos_subasta ?>
					<br><b>Fecha: </b><br><?php echo date($subasta->fecha) ?>
				</div>
				<div class="listado-enlaces">
				<?php
					$lista_enlaces = $subasta->getEnlaces();
					$lista_adjuntos = $subasta->getAdjuntos();
					$listado = array();
					foreach ($lista_enlaces as $enlace) {
						$listado[] = array($enlace->orden,$enlace->titulo, $enlace->enlace);

					//	echo "<div class='enlace item' orden=".$enlace->orden."><a href='".$enlace->enlace."'>".$enlace->titulo."</a></div>";		
					}
					foreach ($lista_adjuntos as $adjunto) {
						$listado[] = array($adjunto->orden, $adjunto->titulo_adjunto, File::getByID($adjunto->adjunto)->getURL());

					//	echo "<div class='adjunto item' orden=".$adjunto->orden."><a href='".File::getByID($adjunto->adjunto)->getURL()."'>".$adjunto->titulo_adjunto."</a></div>";		
					}
					$listado_ordenado = ordernarArray($listado,0,false);
					foreach ($listado_ordenado as $item) {
						echo "<div class='adjunto item' orden=".$item[0]."><a href='".$item[2]."'>".$item[1]."</a></div>";		
					//	echo "<div class='adjunto item' orden=".$adjunto->orden."><a href='".File::getByID($adjunto->adjunto)->getURL()."'>".$adjunto->titulo_adjunto."</a></div>";		
					}

				?>
				</div>
			</div>
		<?php endforeach; ?>
	</div>	



