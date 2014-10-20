<?php defined('C5_EXECUTE') or die(_("Access Denied."));

class SubastaPackage extends Package {

     protected $pkgHandle = 'subasta';
     protected $appVersionRequired = '5.3.0';
     protected $pkgVersion = '1.0';

     public function getPackageDescription() {
          return t("Gestión de subastas.");
     }

     public function getPackageName() {
          return t("Subastas");
     }
     
     public function install() {
          $pkg = parent::install();
     
          Loader::model('single_page'); 
          SinglePage::add('/dashboard/subastas/add',$pkg);
          SinglePage::add('/dashboard/subastas/lista_subastas',$pkg);

          //Frontend Blocktype:
          $this->getOrInstallBlockType($pkg, 'listado_subasta');

     }



     private function getOrInstallBlockType($pkg, $btHandle) {
          $bt = BlockType::getByHandle($btHandle);
          if (empty($bt)) {
               BlockType::installBlockTypeFromPackage($btHandle, $pkg);
               $bt = BlockType::getByHandle($btHandle);
          }
          return $bt;
     }
     
}