<?php defined('C5_EXECUTE') or die("Access Denied.");

$form = Loader::helper('form');

$dtt = Loader::helper('form/date_time');

?>

<div id="ccm-dashboard-content">
<div class="ccm-ui">

	<?php
		$dashboard = Loader::helper('concrete/dashboard');
		echo $dashboard->getDashboardPaneHeader('Edición Subasta');
	?>
<div class="ccm-pane-body">
<form class="formulario-edicion-subasta form-horizontal" action="<?php echo $this->action('save')?>" method="POST">
	<div class="clearfix form-group">
		<?php echo $form->label('miniatura', t('Miniatura')); ?>
		<div class="input col-xs-9"><?php 
	                        $alh = Loader::helper('concrete/asset_library');
	                        $miniatura = $subasta['miniatura'];
	                        $imagen = File::getByID($miniatura);
	                        echo $alh->image('miniatura', 'miniatura', t('Selecciona una imagen'), $imagen); 
	    				?></div>
    </div>
   	
    <div class="clearfix form-group">
		<?php echo $form->label('tipo_bienes', t('Tipo de bienes')); ?>
		<div class="input col-xs-9"><?php echo $form->text('tipo_bienes',$subasta['tipo_bienes']) ?></div>
	</div>
    <div class="clearfix form-group">
		<?php echo $form->label('localizacion', t('Localización')); ?>
		<div class="input col-xs-9"><?php echo $form->textarea('localizacion',$subasta['localizacion'])?></div>
	</div>
    <div class="clearfix form-group">
		<?php echo $form->label('estado', t('Estado')); ?>
		<div class="input col-xs-9"><?php echo $form->text('estado',$subasta['estado'])?></div>
	</div>
    <div class="clearfix form-group">
		<?php echo $form->label('fecha', t('Fecha')); ?>
		<div class="input col-xs-9"><?php echo $dtt->datetime('fecha', date($subasta['fecha']), false,true); $dtt->translate('fecha');?>
		</div>
	</div>
    <div class="clearfix form-group">
		<?php echo $form->label('datos', t('Datos')); ?>
		<div class="input col-xs-9"><?php echo $form->text('datos_subasta',$subasta['datos_subasta'])?></div>
	</div>
	<div class="listado-adjuntos">
	<h3 class="titulo-enlaces" style="display:none;"></h3>
	<?php $i=0; 
	if($lista_enlaces){
		?>
	<?php foreach($lista_enlaces as $enlace):?>
		<div class="enlace-subasta  ccm-pane ccm-pane-body item">

    		<div class="clearfix form-group">
			Título:<?php echo $form->text('titulo[]',$enlace->titulo);?>
			</div>
    		<div class="clearfix form-group">
    			Dirección:<?php echo $form->text('enlace[]',$enlace->enlace);?>
    		</div>
			<?php echo $form->hidden('orden[]',$enlace->orden);?>
			<a href="" class="borrar-enlace btn danger">Borrar</a>		
		</div>
	<?php $i++; endforeach; }
	?>


	<h3 class="titulo-adjuntos" style="display:none;"></h3>
	<?php $i=0; 
	if($lista_adjuntos){
		?>
	<?php foreach($lista_adjuntos as $subasta_adjunto):?>
		<div class="adjunto-subasta  ccm-pane ccm-pane-body item">

    		<div class="clearfix form-group">
			Título:<?php echo $form->text('titulo_adjunto[]',$subasta_adjunto->titulo_adjunto);?>
			</div>
    		<div class="clearfix form-group">
    		Adjunto:<div class="input col-xs-9"><?php 
	                        $lh = Loader::helper('concrete/asset_library');
	                        $adjunto = File::getByID($subasta_adjunto->adjunto);
	                        echo $lh->file('adjunto'.$i, 'adjunto[]', t('Selecciona un adjunto'), $adjunto ); 
	    				?></div>	
    			
    		</div>
			<?php echo $form->hidden('orden_adjunto[]',$subasta_adjunto->orden);?>
			<a href="" class="borrar-adjunto btn danger">Borrar</a>		
		</div>
	<?php $i++; endforeach; }
	?>

	

</div>

<a href="javascript:void(0)" class="nuevo-adjunto btn btn-primary">Añadir Adjunto</a>
<a href="" class="nuevo-enlace btn btn-primary">Añadir Enlace</a>

</div>
 	<div class="ccm-pane-footer">
 		<div class="dialog-buttons">
			<input class="btn btn-primary" type="submit" value="Save">
			<a href="<?php echo $this->url('/dashboard/subastas/lista_subastas')?>" class="btn">Cancel</a>
			<?php if($subasta['id']): ?>
			  <?php echo $form->hidden('id',$subasta['id']); ?>
			<?php endif; ?>
		</div>
	</div>
</form>
</div>
</div>



<script type="text/javascript">
$( document ).ready(function() {

	function ordenacionInicialAdjuntos(){
		
		var	$adjuntos = $(".listado-adjuntos").children(".item");

		$adjuntos.sort(function(a,b){
			var an = a.querySelector("input[id^='orden']").value;
			var	bn = b.querySelector("input[id^='orden']").value;

			if(an > bn) {
				return 1;
			}
			if(an < bn) {
				return -1;
			}
			return 0;
		});

		$adjuntos.detach().appendTo($(".listado-adjuntos"));
	}

	ordenacionInicialAdjuntos();

	function ordenacion(){
		$(".listado-adjuntos").find("input[id^='orden']").each(function(i){
	    	 	$(this).attr("value",i);
	    	 });

	    $(".listado-adjuntos").sortable({
	    	items:".item",
	    	update: function(event, ui) {
	    	 $(this).find("input[id^='orden']").each(function(i){
	    	 	$(this).attr("value",i);
	    	 });    
	    }

	    });
	}

	ordenacion();
	
//    $( ".listado-adjuntos" ).disableSelection();

	var enlaces = $('.enlace-subasta');
	if (enlaces.length != 0){
		$('.titulo-enlaces').css('display','block'); 
	}

	var adjuntos = $('.adjunto-subasta');
	if (adjuntos.length != 0){
		$('.titulo-adjuntos').css('display','block'); 
	}

	$('.formulario-edicion-subasta').on('click', '.borrar-enlace', function(event) {
		event.preventDefault();
		$(this).parent().closest('.enlace-subasta').remove();
	});

	$('.formulario-edicion-subasta').on('click', '.borrar-adjunto', function(event) {
		event.preventDefault();
		$(this).parent().closest('.adjunto-subasta').remove();
	});	

	$(".nuevo-enlace").click(function(event) {
		event.preventDefault();
		var n_enlaces = $('.listado-adjuntos').children('.enlace-subasta').size();
		var div_enlace = "<div class='enlace-subasta  ccm-pane ccm-pane-body item'><div class='clearfix form-group'>Título:\
		<input id='titulo[]' type='text' name='titulo[]' value='' class='ccm-input-text'></div><div class='clearfix form-group'>Dirección:\
		<input id='enlace[]' type='text' name='enlace[]'	value='' class='ccm-input-text'></div>\
			<input id='orden[]' type='hidden' name='orden[]' value='' class='ccm-input-text'>\
					<a href='' class='borrar-enlace btn danger'>Borrar</a></div>";
		// var ultimo_enlace = $(this).closest('.listado-adjuntos').children('.enlace-subasta').last();
		// if(ultimo_enlace.length == 0){
		// 	ultimo_enlace = $(this).closest('.listado-adjuntos').children('.titulo-adjuntos');
		// 	//	ultimo_enlace.css('display','block'); 
		// }
		$(".listado-adjuntos").append(div_enlace);
		
		$(this).closest('.listado-adjuntos').on('click', '.borrar-enlace', function(event) {
			event.preventDefault();
			$(this).parent().closest('.enlace-subasta').remove();
		});
		ordenacion();
	});

	function nuevoAdjunto(n_adjuntos){
		
		var fichero_adjunto = '<div class="input col-xs-9"> \
				<div id="adjunto'+n_adjuntos+'-fm-selected" onclick="ccm_chooseAsset=false" class="ccm-file-selected-wrapper" style="display: none"> \
					<img src="/webc5/updates/concrete5.6.3.1_updater/concrete/images/throbber_white_16.gif"> \
				</div> \
				<div class="ccm-file-manager-select" id="adjunto-fm-display" ccm-file-manager-field="adjunto'+n_adjuntos+'" style="display: block"> \
					<a href="javascript:void(0)" onclick="ccm_chooseAsset=false; ccm_alLaunchSelectorFileManager(\'adjunto'+n_adjuntos+'\')">Selecciona un adxunto</a> \
				</div><input id="adjunto'+n_adjuntos+'-fm-value" type="hidden" name="adjunto[]" value="0"> \
			</div>';

		var div_adjunto = "<div class='adjunto-subasta  ccm-pane ccm-pane-body item'><div class='clearfix form-group'>Título:\
		<input id='titulo_adjunto[]' type='text' name='titulo_adjunto[]' value='' class='ccm-input-text'></div><div class='clearfix form-group'><label for='adjunto' class='control-label'>Adjunto:</label>\  "
		+fichero_adjunto+"</div><input id='orden_adjunto[]' type='hidden' name='orden_adjunto[]' value='' class='ccm-input-text'>\
					<a href='' class='borrar-adjunto btn danger'>Borrar</a></div>";

		div_adjunto = div_adjunto + '<script type="text/javascript"> \
		$(function() \
		 { ccm_triggerSelectFile(1692, \'adjunto['+n_adjuntos+']\'); } \
		);</sc'+'ript>';

		
		return div_adjunto;	
	}


	

	$(".nuevo-adjunto").click(function(event) {
		event.preventDefault();
		var n_adjuntos = $('.listado-adjuntos').children('.adjunto-subasta').size();

		// var ultimo_adjunto = $(this).closest('.listado-adjuntos').children('.adjunto-subasta').last();
		// if(ultimo_adjunto.length == 0){
		// 	ultimo_adjunto = $(this).closest('.listado-adjuntos').children('.titulo-adjuntos');
		// 	ultimo_adjunto.css('display','block'); 
		// }
		$(".listado-adjuntos").append(nuevoAdjunto(n_adjuntos));

		$(this).closest('.listado-adjuntos').on('click', '.borrar-adjunto', function(event) {
			event.preventDefault();
			$(this).parent().closest('.adjunto-subasta').remove();
		});		
		ordenacion();
	});



});
</script>
