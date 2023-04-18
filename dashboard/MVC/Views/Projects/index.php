<?php

// Primero recoge los utls y con widgets usando $Config->get("ROOT")
require_once($Config->get("ROOT_CORE")."/BasePage.php");
require_once($Config->get("ROOT_HTML")."A.php");
require_once($Config->get("ROOT_HTML")."H1.php");
require_once($Config->get("ROOT_HTML")."I.php");
require_once($Config->get("ROOT_HTML")."Div.php");
require_once($Config->get("ROOT_HTML")."Img.php");
require_once($Config->get("ROOT_HTML")."Label.php");
require_once($Config->get("ROOT_WIDGETS")."ScrollDiv.php");

use Engine\Utils\HTML\A;
use Engine\Utils\HTML\H1;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Img;
use Engine\Utils\HTML\Label;
use Engine\Utils\Widgets\ScrollDiv;


// Crea la página
$Content = new Div();
$Content->class = "content p-5";

$Project_title_text = new H1();
$Project_title_text->text = "Projects";
$Project_title_text->class = "h3 mb-3 font-weight-normal";

$Content->Add($Project_title_text);

// Crea el scroll
$Scroll = new ScrollDiv();
$Scroll->class = "scrol m-2 row";
$Scroll->id = "scroll";
$Scroll->css = [
    'height' => '2em',
];

// Crea el div que contendrá los proyectos
$ProjectsDiv = new Div();
$ProjectsDiv->class = "projects col-md-12";
$ProjectsDiv->id = "projects";

foreach($Projects as $Project){

    $Link_div = new Div();
    $Link_div->class = "col-sm-12";

    $Project_link = new A();
    $Project_link->href = $Config->get("URL_EDITOR")."&Project=".$Project;

    $DivProject = new Div();
    $DivProject->class = "project row border border m-2 p-2";

    $Icon_div = new Div();
    $Icon_div->class = "col-sm-1 text-center align-middle";

    $Icon = new I();
    $Icon->class = "material-icons mt-auto mb-auto";
    $Icon->text = "folder";

    $Icon_div->Add($Icon);

    $DivProject->Add($Icon_div);

    $Name_div = new Div();
    $Name_div->class = "col-sm-11 text-left align-middle";

    $Project_name = new Label();
    $Project_name->text = $Project;
    $Project_name->class = "project-name mt-auto mb-auto";

    $Name_div->Add($Project_name);

    $DivProject->Add($Name_div);

    $Project_link->Add($DivProject);

    $Link_div->Add($Project_link);

    $ProjectsDiv->Add($Link_div);
}

$Scroll->Add($ProjectsDiv);

$Content->Add($Scroll);

$Content->render();


?>