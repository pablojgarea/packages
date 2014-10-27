<?php 
defined('C5_EXECUTE') or die("Access Denied.");

Loader::model('subasta','subasta');

$db = Loader::db();

$start = $_REQUEST['from'] / 1000;
$end   = $_REQUEST['to'] / 1000;
$sql   = sprintf('SELECT * FROM events WHERE `datetime` BETWEEN %s and %s',
    $db->quote(date('Y-m-d', $start)), $db->quote(date('Y-m-d', $end)));


$subastas = array();
echo sizeof($lista_subastas);
foreach ($lista_subastas as $subasta):
	$subastas[]=$subasta->getCalendarJSON();
	echo var_dump($subasta->getCalendarJSON());
endforeach;

echo json_encode(array('success' => 1, 'result' => $subastas));
exit;
?>