<?php

namespace Engine\Core;

class Config{

    public $config = [];

    function __construct(){

        $this->config = [
            'ROOT'          => dirname(__DIR__, 1),
            'URL'           => "http://localhost/framework/",
            'URL_ENGINE'    => "http://localhost/framework/Engine/",
            'URL_DASHBOARD' => "http://localhost/framework/Dashboard/",
            'URL_PROJECTS'  => "http://localhost/framework/Projects/",
            'URL_ACTIONS'   => "http://localhost/framework/dashboard/MVC/Actions/",
            'URL_IMPORT_MVC' => "http://localhost/framework/dashboard/ImportMVC.php",
            'ROOT_DASHBOARD'=> dirname(__DIR__, 1)."/Dashboard/",
            'ROOT_PROJECT'  => dirname(__DIR__, 1)."/Projects/",
            'ROOT_ACTIONS'  => dirname(__DIR__, 1)."/dashboard/MVC/Actions/",
            'ROOT_IMPORTMVC'=> dirname(__DIR__, 1)."/dashboard/ImportMVC.php",
            'ROOT_UTILS'    => dirname(__DIR__, 1)."/Engine/Utils/",
            'ROOT_HTML'     => dirname(__DIR__, 1)."/Engine/Utils/HTML/",
            'ROOT_WIDGETS'  => dirname(__DIR__, 1)."/Engine/Utils/Widgets/",
            'ROOT_CORE'     => dirname(__DIR__, 1)."/Engine/Core/",
        ];

    }

    function set(String $key, String $value){

        if(isset($this->config[$key])){
            $this->config[$key] = $value;
        }

    }

    function get(String $key){
        
        if (isset($this->config[$key])){
            return $this->config[$key];
        }
    }
        

}

?>