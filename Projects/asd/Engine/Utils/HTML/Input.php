<?php
namespace Engine\Utils\HTML;

require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();
require_once $Config->get('FILE_BASEUTILS');

use Core\BaseUtils;

class Input extends BaseUtils{

    function __construct(){
        $this->tag = "input";
        $this->type = "text";
        $this->name = "";
        $this->value = "";
        $this->text = "";
        $this->class = "";
        $this->id = "";
        $this->css = [];
        $this->attributes = [];
    }

}

?>