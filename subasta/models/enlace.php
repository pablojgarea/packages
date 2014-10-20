<?php defined('C5_EXECUTE') or die("Access Denied.");
class Enlace extends Model{
	public $_table='subasta_enlace';


	public function borrarEnlacesSubasta($id_subasta){

		$db = Loader::db();

		$query = 'delete FROM subasta_enlace WHERE id_subasta=?';
		$db->Execute($query,$id_subasta);
	}

}

?>