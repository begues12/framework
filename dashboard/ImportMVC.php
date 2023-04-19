<?php
require_once "Config.php";
use Engine\Core\Config;
$Config = new Config();

$ctrl = "Menu";
$do = 'index';
$action = "";

if(isset($_GET['Ctrl'])){

    $ctrl = $_GET['Ctrl'];

    if(isset($_GET['Do'])){
        $do = $_GET['Do'];
    }

    if (isset($_GET['Action'])) {
        $action = $_GET['Action'];
    }

}


// Create iclude view
$path_file =        "MVC/Views/".$ctrl."/".$do.".php";
$path_controller = "MVC/Controllers/".$ctrl."/".$do.".php";
$path_actions =     "MVC/Actions/".$ctrl."/".$action.".php";
$path_js =         "MVC/Js/".$ctrl."/".$do.".js";
$path_css =        "MVC/Css/".$ctrl."/".$do.".css";

$Actual_URl = $_SERVER['REQUEST_URI'];

if(file_exists($Config->get('ROOT_DASHBOARD').$path_css)){
    echo "<link rel='stylesheet' href='".$path_css."'>";
}

if(file_exists($Config->get('ROOT_DASHBOARD').$path_js)){
    echo "<script src='".$path_js."'></script>";
}

if (file_exists($Config->get('ROOT_DASHBOARD').$path_actions)) {
    include_once $path_actions;
    die();
}

if(file_exists( $Config->get('ROOT_DASHBOARD').$path_file) && file_exists( $Config->get('ROOT_DASHBOARD').$path_controller)){
    include_once $path_controller;
    include_once $path_file;
}



if(!file_exists( $Config->get('ROOT_DASHBOARD').$path_controller)){
    echo "<div style='margin: 0 auto; background-color: #f5f5f5; padding: 20px; border: 1px solid #e3e3e3; border-radius: 4px;'>";
    echo "<h3>404</h3>";
    echo "<h5>Controller not found</h5>";
    echo "<label>".$Config->get('ROOT_DASHBOARD').$path_controller."</label>";
    echo "</div>";
}

if (!file_exists($Config->get('ROOT_DASHBOARD').$path_file)) {
    echo "<div style='margin: 0 auto; background-color: #f5f5f5; padding: 20px; border: 1px solid #e3e3e3; border-radius: 4px;'>";
    echo "<h3>404</h3>";
    echo "<h5>View not found</h5>";
    echo "<label>".$Config->get('ROOT_DASHBOARD').$path_file."</label>";
    echo "</div>";
}

?>