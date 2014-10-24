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

	public function search($parametros){

		$db = Loader::db();
		$sql_where = '';

		foreach ($parametros as $key => $value) {
			$sql_where .= "(".$key." LIKE '%".$value."%') AND ";
		}
		
		$query = "SELECT id FROM subasta WHERE ".$sql_where." 1=1 ";

		$result = $db->Execute($query);
		$lista_subastas = array();

		while ($row = $result->FetchRow()) {

			$nueva_subasta = new Subasta();
    		$nueva_subasta->loadById($row['id']);
    		$lista_subastas[] = $nueva_subasta;
		}

		return $lista_subastas;

	}


	public function getEnlaces(){
		$db = Loader::db();
		Loader::model('enlace','subasta');

		$query_enlaces = "SELECT id FROM subasta_enlace WHERE id_subasta=".$this->id;
	
		$result = $db->Execute($query_enlaces);
		$lista_enlaces = array();

		while ($row = $result->FetchRow()) {
			$nueva_enlace = new Enlace();
    		$nueva_enlace->loadById($row['id']);
    		$lista_enlaces[] = $nueva_enlace;
		}

		return $lista_enlaces;
	}

	public function getAdjuntos(){
		$db = Loader::db();
		Loader::model('subasta_adjunto','subasta');
		
		$query_adjuntos = "SELECT id FROM subasta_adjunto WHERE id_subasta=".$this->id;
	
		$result = $db->Execute($query_adjuntos);
		$lista_adjuntos = array();

		while ($row = $result->FetchRow()) {
			$nueva_adjunto = new Adjunto();
    		$nueva_adjunto->loadById($row['id']);
    		$lista_adjuntos[] = $nueva_adjunto;
		}

		return $lista_adjuntos;
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
