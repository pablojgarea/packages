<?php defined('C5_EXECUTE') or die("Access Denied.");
class Adjunto extends Model{
	public $_table='subasta_adjunto';


	public function borrarAdjuntosSubasta($id_subasta){

		$db = Loader::db();

		$query = 'delete FROM subasta_adjunto WHERE id_subasta=?';
		$db->Execute($query,$id_subasta);
	}

}

?>