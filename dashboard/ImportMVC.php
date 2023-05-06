<?php
namespace Engine\Core;

require_once "Config.php";
use Engine\Core\Config;

$Config = new Config();

require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once $Config->get('FILE_BASEVIEW');
require_once $Config->get('FILE_ERRORMSG');

use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Core\BaseView;
use Engine\Utils\Widgets\ErrorMsg;

class ImportMVC{

    public $ctrl;
    public $do;
    public $action;
    public $Config;
    public $pathCtrl;
    public $pathView;
    public $pathAction;
    public $pathJs;
    public $pathCss;
    public $Vars = array();

    function __construct(){
        $this->Config = new Config();
        $this->ctrl = "Menu";
        $this->do = "Index";
        $this->action = "";
    }

    public function getCtrl(){
        if (isset($_GET['Ctrl'])) {
            $this->setCtrl($_GET['Ctrl']);
        }
    }

    public function getDo(){
        if (isset($_GET['Do'])) {
            $this->setDo($_GET['Do']);
        }
    }

    public function getAction(){
        if (isset($_GET['Action'])) {
            $this->setAction($_GET['Action']);
        }
    }

    public function setCtrl($ctrl){
        $this->ctrl = $ctrl;
    }

    public function setDo($do){
        $do = str_replace("/", "\\", $do);
        $this->do = $do;
    }

    public function setAction($action){
        $this->action = $action;
    }

    public function getActualUrl(){
        return $_SERVER['REQUEST_URI'];
    }

    public function getRootDashboard(){
        return $this->Config->get('ROOT_DASHBOARD');
    }

    public function getRootJs(){
        return $this->Config->get('ROOT_JS');
    }

    public function getRootCss(){
        return $this->Config->get('ROOT_CSS');
    }

    public function getRootWidgets(){
        return $this->Config->get('ROOT_WIDGETS');
    }

    public function getRootImages(){
        return $this->Config->get('ROOT_IMAGES');
    }

    public function getRootFonts(){
        return $this->Config->get('ROOT_FONTS');
    }

    public function getUrlJs(){
        return $this->Config->get('URL_JS');
    }

    public function getUrlCss(){
        return $this->Config->get('URL_CSS');
    }

    public function getUrlImages(){
        return $this->Config->get('URL_IMAGES');
    }

    public function getUrlFonts(){
        return $this->Config->get('URL_FONTS');
    }

    public function getRoot(){
        return $this->Config->get('ROOT');
    }

    public function getRootController(){
        return $this->Config->get('ROOT_CONTROLLER');
    }

    public function setVar($key, $value){
        $this->Vars[$key] = $value;
    }

    public function getVar($key){
        return $this->Vars[$key];
    }

    public function execute(){

        $this->getCtrl();
        $this->getDo();
        $this->getAction();

        $this->pathView   = "MVC\\Views\\".$this->ctrl."\\".$this->do;
        $this->pathCtrl   = "MVC\\Controllers\\".$this->ctrl."\\".$this->do;
        $this->pathAction = "MVC\\Actions\\".$this->ctrl."\\".$this->do."\\".$this->action.".php";
        $this->pathJs     = $this->ctrl."\\".$this->do.".js";
        $this->pathCss    = "MVC\\Css\\".$this->ctrl."\\".$this->do.".css";
        
        if(isset($_COOKIE['debug']) && $_COOKIE['debug'] == 1){
            $this->pathCtrl   = str_replace("/", "\\", $this->pathCtrl);
            $this->pathView   = str_replace("/", "\\", $this->pathView);
            echo $this->pathCtrl."<br>";
            echo $this->pathView."<br>";
            echo $this->pathAction."<br>";
            echo $this->pathJs."<br>";
            echo $this->pathCss."<br>";
        }

        if(file_exists( $this->Config->get('ROOT_DASHBOARD').$this->pathCtrl.".php")){

            if($this->action != ""){
                try{

                    require_once $this->Config->get('ROOT_DASHBOARD').$this->pathCtrl.".php";
                    $this->pathCtrl   = str_replace("/", "\\", $this->pathCtrl);
                    
                    if ( class_exists($this->pathCtrl) ) {
                        call_user_func(array($this->pathCtrl, $this->action));
                        die();
                    }

                }catch(\Exception $e){
                    $Error = new ErrorMsg('Error 404', 'Action not found '.$this->action);
                    $Error->render();
                }

            }
        }
        
        if(file_exists($this->Config->get('ROOT_DASHBOARD').$this->pathCss)){
            echo "<link rel='stylesheet' href='".$this->pathCss."'>";
        }

        if(file_exists( $this->Config->get('ROOT_DASHBOARD').$this->pathCtrl.".php")){
            
            require_once $this->Config->get('ROOT_DASHBOARD').$this->pathCtrl.".php";
            require_once $this->Config->get('ROOT_DASHBOARD').$this->pathView.".php";

            $this->pathCtrl   = str_replace("/", "\\", $this->pathCtrl);
            $this->pathView   = str_replace("/", "\\", $this->pathView);

            if ( class_exists($this->pathCtrl) ) {

                $this->pathCtrl   = str_replace("/", "\\", $this->pathCtrl);
                $controller = new $this->pathCtrl;
                $controller->Prepare();
                
                $view = new $this->pathView;
                $view->setVars($controller->getVars());
                $view->prepare();
                $view->render();
            }else{
                $ErrorMsg = new ErrorMsg('Error 404', 'Controller not found '.$this->pathCtrl);
                $ErrorMsg->render();
            }
        }
        
        if(file_exists($this->Config->get('ROOT_JS').$this->pathJs)){
            echo "<script src='".$this->Config->get('URL_JS').$this->pathJs."'></script>";
        }
    }

}

?>