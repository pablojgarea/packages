<?php  defined('C5_EXECUTE') or die("Access Denied.");

class ListadoSubastaBlockController extends BlockController {
	
	protected $btName = 'ListadoSubasta';
	protected $btDescription = '';
	protected $btTable = 'btDCListadoSubasta';
	
	protected $btInterfaceWidth = "700";
	protected $btInterfaceHeight = "450";
	
	protected $btCacheBlockRecord = true;
	protected $btCacheBlockOutput = true;
	protected $btCacheBlockOutputOnPost = true;
	protected $btCacheBlockOutputForRegisteredUsers = false;
	protected $btCacheBlockOutputLifetime = CACHE_LIFETIME;
	
	public function getSearchableContent() {
		$content = array();
		$content[] = $this->field_1_textbox_text;
		$content[] = $this->field_2_textbox_text;
		$content[] = $this->field_3_textbox_text;
		$content[] = date('F jS, Y', $this->field_4_date_value);
		$content[] = date('F jS, Y', $this->field_5_date_value);
		return implode(' - ', $content);
	}


	public function add() {
		//Set default values for new blocks
		$this->set('field_4_date_value', date('Y-m-d'));
		$this->set('field_5_date_value', date('Y-m-d'));
	}


	public function save($args) {
		$args['field_4_date_value'] = empty($args['field_4_date_value']) ? null : Loader::helper('form/date_time')->translate('field_4_date_value', $args);
		$args['field_5_date_value'] = empty($args['field_5_date_value']) ? null : Loader::helper('form/date_time')->translate('field_5_date_value', $args);
		parent::save($args);
	}




}
