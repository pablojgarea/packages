<?php defined('C5_EXECUTE') or die("Access Denied.");
class DashboardSubastasAddController extends Controller{

	public function save(){
		Loader::model('subasta','subasta');
		Loader::model('enlace','subasta');
		Loader::model('subasta_adjunto','subasta');

		$dtt = Loader::helper('form/date_time');
		$subasta=new Subasta();
		$enlace=new Enlace();
		$adjunto=new Adjunto();

		if($this->post('id')){
			$subasta->load('id=?',$this->post('id'));
			$enlaces_subasta = $enlace->find('id_subasta=?',$this->post('id'));
			$adjuntos_subasta = $adjunto->find('id_subasta=?',$this->post('id'));
			 
			//borrar enlaces de esta subasta
			$enlace->borrarEnlacesSubasta($this->post('id'));
			$adjunto->borrarAdjuntosSubasta($this->post('id'));
		}

		$subasta->miniatura = $this->post('miniatura');

		$subasta->tipo_bienes = $this->post('tipo_bienes');

		$subasta->localizacion = $this->post('localizacion');

		$subasta->estado = $this->post('estado');

		$subasta->fecha = $dtt->translate('fecha');

		$subasta->datos_subasta = $this->post('datos_subasta');

		$subasta->replace();

		$i=0;
		//enlaces
        foreach ($_POST['titulo'] as $key => $value){
        	//para cada título, nuevo evento
        	$enlace=new Enlace();
        	$enlace->id_subasta = $subasta->id;
        	$enlace->titulo=$value;
        	$i=array_search($key,array_keys($_POST['titulo']));

        	$enlace->enlace=$_POST['enlace'][$i];
        	$enlace->orden=$_POST['orden'][$i];
        	$enlace->save();
        }

        //ficheros
        foreach ($_POST['titulo_adjunto'] as $key => $value){
        	//para cada título, nuevo evento
        	$adjunto=new Adjunto();
        	$adjunto->id_subasta = $subasta->id;
        	$adjunto->titulo_adjunto=$value;
        	$i=array_search($key,array_keys($_POST['titulo_adjunto']));

        	$adjunto->adjunto=$_POST['adjunto'][$i];
        	$adjunto->orden=$_POST['orden_adjunto'][$i];
        	$adjunto->save();
        }

		$this->redirect('/dashboard/subastas/lista_subastas');
	}

	public function edit($id){
		Loader::model('subasta','subasta');

		$subasta = new Subasta();
		
		$subasta->load('id=?',$id);

		$this->set('subasta',(array)$subasta);

		//cargamos enlaces asociados
		Loader::model('enlace','subasta');

		$enlace = new Enlace();

		$lista_enlaces = $enlace->find('id_subasta=?',$id);

		$this->set('lista_enlaces',$lista_enlaces);

		//cargamos adjuntos asociados
		Loader::model('subasta_adjunto','subasta');

		$adjunto = new Adjunto();

		$lista_adjuntos = $adjunto->find('id_subasta=?',$id);

		$this->set('lista_adjuntos',$lista_adjuntos);

	}


}

?>