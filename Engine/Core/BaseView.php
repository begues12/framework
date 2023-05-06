<?php

namespace Engine\Core;

use Engine\Core\Config;
$Config = new Config();
$Config->autoload("FILE_BASEUTILS");
$Config->autoload("ROOT_HTML","DIV");

use Core\BaseUtils;
use Engine\Utils\HTML\Div;

class BaseView extends BaseUtils{

    public $Config;
    public $path;
    public $Vars = array();
    

    function __construct(){
        $this->Config = new Config();
        $this->tag = "div";
        $this->class = "p-2";
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

