<?php
namespace Engine\Utils\HTML;

require_once dirname(__DIR__, 3)."\Engine\Core\BaseUtils.php";

use Core\BaseUtils;

class Div extends BaseUtils{

    function __construct(){
        $this->tag = "div";
        $this->name = "";
        $this->value = "";
        $this->content = [];
        $this->class = "";
        $this->id = "";
        $this->css = [];
        $this->attributes = [];
    }

}