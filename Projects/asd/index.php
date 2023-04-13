<?php
require_once "Config.php";

use Engine\Core\Config;

$Config = new Config();

require_once $Config->get('ROOT_CORE')."BasePage.php";

require_once  $Config->get('ROOT_WIDGETS')."Navbar.php";
require_once  $Config->get('ROOT_WIDGETS')."Sidebar.php";

use Engine\Core\BasePage;
use Engine\Utils\Widgets\Navbar;
use Engine\Utils\HTML\A;
use Engine\Utils\Widgets\Sidebar;
use Engine\Utils\HTML\I;

//Page creation <body>
$Page = new BasePage();
$Page->ajax = true;
$Page->bootstrap = true;

// Top navbar
$NavbarTop = new Navbar();
$NavbarTop->title->text = "Dashboard";

// Button menu
$NavbarTop_button = new A();

$NavbarTop_button->class = "nav-link";
$NavbarTop_button->text = "Menu";
$NavbarTop_button->href = "?Ctrl=Menu";
$NavbarTop->AddElement($NavbarTop_button->copy());

$NavbarTop_button->class = "nav-link";
$NavbarTop_button->text = "New project";
$NavbarTop_button->href = "?Ctrl=NewProject";
$NavbarTop->AddElement($NavbarTop_button->copy());

$NavbarTop_button->class = "nav-link";
$NavbarTop_button->text = "Projects";
$NavbarTop_button->href = "?Ctrl=Projects";
$NavbarTop->AddElement($NavbarTop_button->copy());

$Page->Add($NavbarTop);

$Page->render();

$ctrl = "Menu";
$action = 'index';

if(isset($_GET['Ctrl'])){

    $ctrl = $_GET['Ctrl'];

    if(isset($_GET['Do'])){
        $action = $_GET['Do'];
    }
}

// Create iclude view
$path_file = $Config->get('ROOT')."dashboard/MVC/Views/".$ctrl."/".$action.".php";
$path_controller = $Config->get('ROOT')."dashboard/MVC/Controllers/".$ctrl."/".$action.".php";
$path_js = "MVC/Js/".$ctrl."/".$action.".js";
$path_css = "dashboard/MVC/Css/".$ctrl."/".$action.".css";

// echo $path_file."<br>";
// echo $path_controller."<br>";
// echo $path_js."<br>";
// echo $path_css."<br>";

$Actual_URl = $_SERVER['REQUEST_URI'];

if(file_exists($Config->get('ROOT').$path_css)){
    echo "<link rel='stylesheet' href='".$path_css."'>";
}

if(file_exists($Config->get('ROOT')."dashboard/".$path_js)){
    echo "<script src='".$path_js."'></script>";
}

if(file_exists($path_file) && file_exists($path_controller)){
    include_once $path_controller;
    include_once $path_file;
}

function pre_array(array $array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$Page->buildEnd();

?>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Menu</h1>
                <ul>
                    <li><a href="/asd/MVC/Menu/Menu">Menu</a></li>
                    <li><a href="/asd/MVC/Menu/Menu2">Menu2</a></li>
                    <li><a href="/asd/MVC/Menu/Menu3">Menu3</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Menu2</h1>
                <ul>
                    <li><a href="/asd/MVC/Menu/Menu">Menu</a></li>
                    <li><a href="/asd/MVC/Menu/Menu2">Menu2</a></li>
                    <li><a href="/asd/MVC/Menu/Menu3">Menu3</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>Menu3</h1>
                <ul>
                    <li><a href="/asd/MVC/Menu/Menu">Menu</a></li>
                    <li><a href="/asd/MVC/Menu/Menu2">Menu2</a></li>
                    <li><a href="/asd/MVC/Menu/Menu3">Menu3</a></li>
                </ul>
            </div>
        </div>

    </div>
</body>