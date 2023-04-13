<?php

namespace Engine\Core;

class BaseScript{

    public $url = "";
    public $type = "text/javascript";
    public $text = "";
    public $variables = [];

    function __construct($url){
        $this->url = $url;
    }

    function toString(){

        if ($this->url != "" && file_exists($this->url)){
            $this->text = file_get_contents($this->url);
        }

    }

    function getVariables($variables){
        
        switch (gettype($variables)){
            case "php":
                $this->variables = $variables;
                break;
            }

    }

}

?>