<?php

namespace Engine\Utils\HTML;

require_once dirname(__DIR__, 3)."\Engine\Core\BaseUtils.php";

use Core\BaseUtils;

class TextArea extends BaseUtils{

    function __construct(){
        $this->tag = "textarea";
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