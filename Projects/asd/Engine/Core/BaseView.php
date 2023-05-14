<?php

namespace Engine\Core;

use Engine\Core\Config;
$Config = new Config();
$Config->autoload("FILE_BASEUTILS");
$Config->autoload("ROOT_HTML","DIV");

require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_WIDGETS')."LoadSpinner.php";

use Core\BaseUtils;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Button;
use Engine\Utils\Widgets\LoadSpinner;
class BaseView extends BaseUtils{

    public $Config;
    public $path;
    public $Vars = array();

    public $Button_return;
    public $Icon_return;
    public $Label_return;

    public $Label_Title_Editor;
    public $LoadSpinner;


    function __construct(){
        $this->Config = new Config();
        $this->tag = "div";
        $this->id = "BaseView";
        
        $this->css = [
            'height' => '90vh',
        ];

        $this->LoadSpinner = new LoadSpinner();

        $this->Add($this->LoadSpinner);

    }

    public function SetReturn(String $Text, String $Id){

        $this->Button_return = new Button();
        $this->Button_return->class = "btn btn-secondary mb-3 ml-1 p-0 d-block align-middle";
        $this->Button_return->id = $Id;

        $this->Icon_return = new I();
        $this->Icon_return->class = "material-icons m-auto p-0 d-inline";
        $this->Icon_return->text = "reply";
        $this->Button_return->Add($this->Icon_return);

        $this->Label_return = new Label();
        $this->Label_return->class = "ml-2 mr-2 mb-0 mt-0";
        $this->Label_return->text     = $Text;
        $this->Button_return->Add($this->Label_return);

        $this->Add($this->Button_return);

    }

    public function SetTitle(String $Title){
        /* Title */
        $this->Label_Title_Editor = new Label();
        $this->Label_Title_Editor->class = "font-weight-bold ml-1 h3 border-bottom d-block";
        $this->Label_Title_Editor->text = $Title;
        $this->Add($this->Label_Title_Editor);
    }

    public function setPath($path){
        $this->path = $path;
    }

    public function setVar($name, $value){
        $this->Vars[$name] = $value;
    }

    public function setVars($vars){
        $this->Vars = $vars;
    }

    public function getVar($name){
        return $this->Vars[$name];
    }

    public function getVars(){
        return $this->Vars;
    }

    public function prepare(){
    }

}

