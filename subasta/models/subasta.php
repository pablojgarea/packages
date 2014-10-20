<?php defined('C5_EXECUTE') or die("Access Denied.");
class Subasta extends Model{

	public $_table='subasta';

	public function createSubasta($miniatura, $tipo_bienes,$localizacion,$estado,$fecha,$datos_subasta){

		$db = Loader::db();
		$this->miniatura = $miniatura;
		$this->tipo_bienes = $tipo_bienes;
		$this->localizacion = $localizacion;
		$this->estado = $estado;
		$this->fecha = $fecha;
		$this->datos_subasta = $datos_subasta;
		$query = 'INSERT INTO subasta (miniatura, tipo_bienes, localizacion, estado, fecha, datos_subasta) VALUES (?,?,?,?,?,?)';
		$values = array($miniatura,$tipo_bienes,$localizacion,$estado,$fecha,$datos_subasta);
		$db->execute($query,$values);
		$this->id = mysql_insert_id();

		return $this->id;
	}

	public function loadById($id){

		$db = Loader::db();
		$query = 'SELECT * FROM subasta WHERE id=?';

		$subastas = $db->getAll($query,$id);
		$subasta = $subastas[0];

		$this->id = $subasta['id'];
		$this->miniatura = $subasta['miniatura'];
		$this->tipo_bienes = $subasta['tipo_bienes'];
		$this->localizacion = $subasta['localizacion'];
		$this->estado = $subasta['estado'];
		$this->fecha = $subasta['fecha'];
		$this->datos_subasta = $subasta['datos_subasta'];		

	}


	public function getMiniatura(){
		return $this->miniatura;
	}

	public function getTipoBienes(){
		return $this->tipo_bienes;
	}

	public function getLocalizacion(){
		return $this->localizacion;
	}

	public function getEstado(){
		return $this->estado;
	}

	public function getFecha(){
		return $this->fecha;
	}

	public function getDatosSubasta(){
		return $this->datos_subasta;
	}

}
Model::ClassHasMany('Subasta','subasta_enlace','id_subasta');
Model::ClassHasMany('Subasta','subasta_adjunto','id_subasta');
?>