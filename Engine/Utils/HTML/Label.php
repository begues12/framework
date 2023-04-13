<?php 

namespace Engine\Utils\HTML;

require_once dirname(__DIR__, 3)."\Engine\Core\BaseUtils.php";

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