<?php defined('C5_EXECUTE') or die("Access Denied.");
class Adjunto extends Model{
	public $_table='subasta_adjunto';

	public function loadById($id){

		$db = Loader::db();
		$query = 'SELECT * FROM subasta_adjunto WHERE id=?';

		$adjuntos = $db->getAll($query,$id);
		$adjunto = $adjuntos[0];

		$this->id = $adjunto['id'];
		$this->titulo_adjunto = $adjunto['titulo_adjunto'];
		$this->adjunto = $adjunto['adjunto'];
		$this->orden = $adjunto['orden'];

	}

	public function borrarAdjuntosSubasta($id_subasta){

		$db = Loader::db();

		$query = 'delete FROM subasta_adjunto WHERE id_subasta=?';
		$db->Execute($query,$id_subasta);
	}

}

?>