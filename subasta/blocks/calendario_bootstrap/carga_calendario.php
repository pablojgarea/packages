<?php

$subastas = array();
echo sizeof($lista_subastas);
foreach ($lista_subastas as $subasta):
	$subastas[]=$subasta->getCalendarJSON();
	echo var_dump($subasta->getCalendarJSON());
endforeach;

echo json_encode(array('success' => 1, 'result' => $subastas));
exit;
?>