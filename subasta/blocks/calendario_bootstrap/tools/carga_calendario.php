
<?php  defined('C5_EXECUTE') or die("Access Denied.");?>
<?php

$db    = Loader::db();
$start = $_REQUEST['from'] / 1000;
$end   = $_REQUEST['to'] / 1000;


$query   = sprintf('SELECT * FROM subasta WHERE `fecha` BETWEEN %s and %s',$db->quote(date('Y-m-d', $start)), $db->quote(date('Y-m-d', $end)));

$subastas = $db->getAll($query);


$out = array();
foreach($subastas as $row) {
    $out[] = array(
        'id' => $row['id'],
        'title' => $row['tipo_bienes'].'::'.$row['localizacion'].'::'.$row['fecha'],
        'url' => 'http://www.google.es',
        'class'=> 'event-important',
        'start' => strtotime($row['fecha']) . '000',
        'end' => strtotime($row['fecha']) .'000'
    );
}

echo json_encode(array('success' => 1, 'result' => $out));
exit;

?>
