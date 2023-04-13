<?php

namespace Engine\Utils\HTML;

require_once dirname(__DIR__, 3)."\Engine\Core\BaseUtils.php";

use Core\BaseUtils;

class Option extends BaseUtils{

    function __construct(){
        $this->tag = "option";
        $this->name = "";
        $this->value = "";
        $this->content = [];
        $this->class = "";
        $this->id = "";
        $this->css = [];
        $this->attributes = [];
    }

}

?>