<?php

namespace Engine\Core;

class Config{

    public $config = [];
    public $baseUrl;
    public $basePath;
    public $get = [];
    public $post = [];
    public $request = [];

    function __construct(){

        $this->baseUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
        $this->basePath = dirname(__DIR__, 1);

        $this->config = [
            'ROOT'          => $this->basePath,
            'CONFIG'        => $this->basePath."/Config.php",
            
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
            'ROOT_DASHBOARD'=> $this->basePath."\Dashboard/",
            'ROOT_PROJECTS'  => $this->basePath."\Projects/",
            'ROOT_ACTIONS'  => $this->basePath."/dashboard/MVC/Actions/",
            'ROOT_IMPORTMVC'=> $this->basePath."/dashboard/ImportMVC.php",
            'ROOT_UTILS'    => $this->basePath."/Engine/Utils/",
            'ROOT_HTML'     => $this->basePath."/Engine/Utils/HTML/",
            'ROOT_WIDGETS'  => $this->basePath."/Engine/Utils/Widgets/",
            'ROOT_CORE'     => $this->basePath."/Engine/Core/",
            'ROOT_OBJECTS'  => $this->basePath."/Engine/Objects/",
            'ROOT_BASEOBJECT' => $this->basePath."/Engine/Core/BaseObject.php",

            // DATABASE
            'DB_HOST'          => 'localhost',
            'DB_USER'          => 'root',
            'DB_PASS'      => '',
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