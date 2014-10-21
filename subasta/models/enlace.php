<?php defined('C5_EXECUTE') or die("Access Denied.");
class Enlace extends Model{
	public $_table='subasta_enlace';

	public function loadById($id){

		$db = Loader::db();
		$query = 'SELECT * FROM subasta_enlace WHERE id=?';

		$enlaces = $db->getAll($query,$id);
		$enlace = $enlaces[0];

		$this->id = $enlace['id'];
		$this->titulo = $enlace['titulo'];
		$this->enlace = $enlace['enlace'];
		$this->orden = $enlace['orden'];

	}

	public function borrarEnlacesSubasta($id_subasta){

		$db = Loader::db();

		$query = 'delete FROM subasta_enlace WHERE id_subasta=?';
		$db->Execute($query,$id_subasta);
	}

}

?>