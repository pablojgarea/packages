<?php  defined('C5_EXECUTE') or die("Access Denied.");
$dt = Loader::helper('form/date_time');
?>

<style type="text/css" media="screen">
	.ccm-block-field-group h2 { margin-bottom: 5px; }
	.ccm-block-field-group td { vertical-align: middle; }
</style>

<div class="ccm-block-field-group">
	<h2>Tipo de bienes</h2>
	<?php  echo $form->text('field_1_textbox_text', $field_1_textbox_text, array('style' => 'width: 95%;')); ?>
</div>

<div class="ccm-block-field-group">
	<h2>Localización</h2>
	<?php  echo $form->text('field_2_textbox_text', $field_2_textbox_text, array('style' => 'width: 95%;')); ?>
</div>

<div class="ccm-block-field-group">
	<h2>Estado</h2>
	<?php  echo $form->text('field_3_textbox_text', $field_3_textbox_text, array('style' => 'width: 95%;')); ?>
</div>

<div class="ccm-block-field-group">
	<h2>Desde:</h2>
	<?php  echo $dt->date('field_4_date_value', $field_4_date_value); ?>
</div>

<div class="ccm-block-field-group">
	<h2>Hasta:</h2>
	<?php  echo $dt->date('field_5_date_value', $field_5_date_value); ?>
</div>


