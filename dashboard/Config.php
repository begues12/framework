<?php

namespace Engine\Core;

class Config{

    public $config = [];
    public $baseUrl;
    public $basePath;
    public $base;
    public $get = [];
    public $post = [];
    public $request = [];

    function __construct(){

        $this->baseUrl = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST'];
        $this->basePath = dirname(__DIR__, 1);
        $this->base     = dirname(__DIR__, 2);

        $this->config = [
            'ROOT'          => $this->basePath,
            'ROOT_FILES'    => $this->basePath,
            'CONFIG'        => $this->basePath."/Config.php",
            
            'BASE_PROJECTS' => "framework/Projects/",

            // URLS
            'URL'           => $this->baseUrl,
            'URL_ENGINE'    => $this->baseUrl."/framework/Engine/",
            'URL_DASHBOARD' => $this->baseUrl."/framework/Dashboard/",
            'URL_PROJECTS'  => $this->baseUrl."/framework/Projects/",
            'URL_EDITOR'    => $this->baseUrl."/framework/Dashboard/?Ctrl=Editor",
            'URL_ACTIONS'   => $this->baseUrl."/framework/dashboard/MVC/Actions/",
            'URL_JS'        => $this->baseUrl."/framework/dashboard/MVC/Js/",
            'URL_WIDGETS'   => $this->baseUrl."/framework/dashboard/MVC/Widgets/",
            'URL_IMPORT_MVC' => $this->baseUrl."/framework/dashboard/ImportMVC.php",
            'URL_UTILS'     => $this->baseUrl."/framework/Engine/Utils/",
            'URL_HTML'      => $this->baseUrl."/framework/Engine/Utils/HTML/",
            'URL_BASEOBJECT'=> $this->baseUrl."/framework/Engine/Core/BaseObject.php",
            'URL_BASESQL'   => $this->baseUrl."/framework/Engine/Core/BaseSQL.php",
            'URL_BASEUTILS' => $this->baseUrl."/framework/Engine/Core/BaseUtils.php",
            'URL_BASECONTROLLER' => $this->baseUrl."/framework/Engine/Core/BaseController.php",
            'URL_BASEVIEW'  => $this->baseUrl."/framework/Engine/Core/BaseView.php",
            'URL_BASEFTP'   => $this->baseUrl."/framework/Engine/Core/BaseFTP.php",
            "URL_PLUGINS"   => $this->baseUrl."/framework/Engine/Plugins/",

            // ROOTS
            'ROOT_DASHBOARD'=> $this->basePath."\Dashboard/",
            'ROOT_PROJECTS'  => $this->basePath."\Projects/",
            'ROOT_ACTIONS'  => $this->basePath."/dashboard/MVC/Actions/",
            'ROOT_JS'       => $this->basePath."/dashboard/MVC/Js/",
            'ROOT_IMPORTMVC'=> $this->basePath."/dashboard/ImportMVC.php",
            'ROOT_UTILS'    => $this->basePath."/Engine/Utils/",
            'ROOT_HTML'     => $this->basePath."/Engine/Utils/HTML/",
            'ROOT_WIDGETS'  => $this->basePath."/Engine/Utils/Widgets/",
            'ROOT_CORE'     => $this->basePath."/Engine/Core/",
            'ROOT_OBJECTS'  => $this->basePath."/Engine/Objects/",
            'ROOT_BASEOBJECT' => $this->basePath."/Engine/Core/BaseObject.php",
            'ROOT_BASESQL'  => $this->basePath."/Engine/Core/BaseSQL.php",
            'ROOT_BASEUTILS'=> $this->basePath."/Engine/Core/BaseUtils.php",
            'ROOT_BASECONTROLLER' => $this->basePath."/Engine/Core/BaseController.php",
            'ROOT_BASEVIEW' => $this->basePath."/Engine/Core/BaseView.php",
            'ROOT_BASEFTP'  => $this->basePath."/Engine/Core/BaseFTP.php",
            'ROOT_PLUGINS'  => $this->basePath."/Engine/Plugins/",

            // DATABASE
            'DB_HOST'          => 'localhost',
            'DB_USER'          => 'root',
            'DB_PASS'      => '',

            // FTP
            'FTP_HOST'      => 'localhost',
            'FTP_USER'      => 'framework',
            'FTP_PASS'      => '',

            // Files
            'FILE_CONFIG'       => $this->basePath."/Config.php",
            'FILE_BASESQL'      => $this->basePath."/Engine/Core/BaseSQL.php",
            'FILE_BASEOBJECT'   => $this->basePath."/Engine/Core/BaseObject.php",
            'FILE_BASEUTILS'    => $this->basePath."/Engine/Core/BaseUtils.php",
            'FILE_BASECONTROLLER' => $this->basePath."/Engine/Core/BaseController.php",
            'FILE_BASEVIEW'     => $this->basePath."/Engine/Core/BaseView.php",
            'FILE_BASEFTP'      => $this->basePath."/Engine/Core/BaseFTP.php",


            ///Files Utils
            'FILE_ERRORMSG'     => $this->basePath."/Engine/Utils/Widgets/Alerts/ErrorMsg.php",

            // Files URL
            'URL_FILE_BASEUTILS'    => $this->basePath."/Engine/Core/BaseUtils.php",
            

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

    function autoload(String $path,String $class = null){
        
        if ($class != null){
            $path = $this->get($path).$class.".php";
        }else{
            $path = $this->get($path);
        }
        
        if(file_exists($path)){
            require_once($path);
        }else{
            echo "File not found: ".$path;
        }
    }

}

?>