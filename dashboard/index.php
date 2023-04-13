<?php
require_once "Config.php";

use Engine\Core\Config;

$Config = new Config();

require_once  $Config->get('ROOT_CORE')."BasePage.php";
require_once  $Config->get('ROOT_WIDGETS')."Navbar.php";
require_once  $Config->get('ROOT_WIDGETS')."Sidebar.php";

use Engine\Core\BasePage;
use Engine\Utils\Widgets\Navbar;
use Engine\Utils\HTML\A;
use Engine\Utils\Widgets\Sidebar;
use Engine\Utils\HTML\I;

//Page creation <body>
$Page = new BasePage();
$Page->title = "Dashboard";
$Page->ajax = true;
$Page->bootstrap = true;

// Top navbar
$NavbarTop = new Navbar();
$Page_icon = new I();
$NavbarTop->title->text = "Strawberry FW";
//Desplegable si es necesario
$NavbarTop->class = "navbar navbar-expand-lg navbar-dark bg-dark";
$NavbarTop->css = [
    'position' => 'fixed',
    'top' => '0',
    'width' => '100%',
    'z-index' => '1',
];

// Button menu
$NavbarTop_button = new A();
$NavbarTop_button->css = [
    'color' => 'white',
    'margin-left' => '10px',
    'font-size' => '15px',
    'text-decoration' => 'none',
    'font-weight' => 'bold',
];

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

// Documentation
$NavbarTop_button->class = "nav-link";
$NavbarTop_button->text = "Documentation";
$NavbarTop_button->href = "?Ctrl=Documentation";
$NavbarTop->AddElement($NavbarTop_button->copy());

$Page->Add($NavbarTop);

$Page->render();

include_once("ImportMVC.php");

function pre_array(array $array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


?>