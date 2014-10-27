<?php  defined('C5_EXECUTE') or die("Access Denied.");

class CalendarioBootstrapBlockController extends BlockController {
	
	protected $btName = 'Calendario Bootstrap';
	protected $btDescription = '';
	protected $btTable = 'btDCCalendarioBootstrap';
	
	protected $btInterfaceWidth = "700";
	protected $btInterfaceHeight = "450";
	
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;
	
	public function getSearchableContent() {
		return $this->field_1_textbox_text;
	}

	public function view(){
		Loader::model('subasta','subasta');

		$subasta = new Subasta();

		$lista_subastas = $subasta->find('1=1');

		$this->set('lista_subastas',$lista_subastas);

	}





}
