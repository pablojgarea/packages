<?php defined('C5_EXECUTE') or die("Access Denied.");
class DashBoardSubastasListaSubastasController extends Controller{

	public function view(){
		Loader::model('subasta','subasta');

		$subasta = new Subasta();

		$lista_subastas = $subasta->find('1=1');

		$this->set('lista_subastas',$lista_subastas);

	}

	public function delete($id){

		Loader::model('subasta','subasta');

		$subasta = new Subasta();

		$subasta->load('id=?',$id);

		$subasta->delete();

		//falta borrar adjuntos y enlaces
		
		$this->redirect('/dashboard/subastas/lista_subastas');
	}
}

?>