<?php

namespace Engine\Core;

class Config{

    public $config = [];
    public $baseUrl;
    public $get = [];
    public $post = [];
    public $request = [];

    function __construct(){

        $this->baseUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];

        $this->config = [
            'ROOT'          => dirname(__DIR__, 1),
            'CONFIG'        => dirname(__DIR__, 1)."/Config.php",
            
            // URLS
            'URL'           => $this->baseUrl,
            'URL_ENGINE'    => $this->baseUrl."/framework/Engine/",
            'URL_DASHBOARD' => $this->baseUrl."/framework/Dashboard/",
            'URL_PROJECTS'  => $this->baseUrl."/framework/Projects/",
            'URL_EDITOR'    => $this->baseUrl."/framework/Dashboard/?Ctrl=Editor",
            'URL_ACTIONS'   => $this->baseUrl."/framework/dashboard/MVC/Actions/",
            'URL_WIDGETS'   => $this->baseUrl."/framework/dashboard/MVC/Widgets/",
            'URL_IMPORT_MVC' => $this->baseUrl."/framework/dashboard/ImportMVC.php",
            'URL_UTILS'     => $this->baseUrl."/framework/Engine/Utils/",
            'URL_HTML'      => $this->baseUrl."/framework/Engine/Utils/HTML/",
            'URL_BASEOBJECT'=> $this->baseUrl."/framework/Engine/Core/BaseObject.php",

            // ROOTS
            'ROOT_DASHBOARD'=> dirname(__DIR__, 1)."\Dashboard/",
            'ROOT_PROJECTS'  => dirname(__DIR__, 1)."\Projects/",
            'ROOT_ACTIONS'  => dirname(__DIR__, 1)."/dashboard/MVC/Actions/",
            'ROOT_IMPORTMVC'=> dirname(__DIR__, 1)."/dashboard/ImportMVC.php",
            'ROOT_UTILS'    => dirname(__DIR__, 1)."/Engine/Utils/",
            'ROOT_HTML'     => dirname(__DIR__, 1)."/Engine/Utils/HTML/",
            'ROOT_WIDGETS'  => dirname(__DIR__, 1)."/Engine/Utils/Widgets/",
            'ROOT_CORE'     => dirname(__DIR__, 1)."/Engine/Core/",
            'ROOT_OBJECTS'  => dirname(__DIR__, 1)."/Engine/Objects/",
            'ROOT_BASEOBJECT' => dirname(__DIR__, 1)."/Engine/Core/BaseObject.php",
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
    
    function pre_array($array){
        echo "<pre>";
        print_r($array);
        echo "</pre>";
    }

}

?>