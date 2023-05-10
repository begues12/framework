<?php 

namespace Engine\Utils\HTML;

require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();
require_once $Config->get('FILE_BASEUTILS');

use Core\BaseUtils;

class Label extends BaseUtils{

    function __construct(){
        $this->tag = "label";
        $this->name = "";
        $this->content = [];
        $this->class = "";
        $this->id = "";
        $this->css = [];
        $this->attributes = [];
    }

}