<?php

require_once "Config.php";

use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Input.php";

use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Input;

// URL to projects folder
$url = "";
if (isset($_POST['ProjectName'])){
    $url = $Config->get('ROOT_PROJECTS').$_POST['ProjectName']."/Objects/";
}

$Div_nav = new Div();
$Div_nav->class = "m-0 p-0 row text-center";

$Div_Url = new Div();
$Div_Url->class = "m-0 p-0 col-11";

$Input_Url = new Input();
$Input_Url->type = "text";
$Input_Url->class = "form-control w-100";
$Input_Url->value = $url;

$Div_Url->Add($Input_Url);

$Div_nav->Add($Div_Url);

$Div_add = new Div();

$Div_add->class = "m-0 p-0 col-1 text-center";

$Add_Button = new Button();

$Add_Button->class = "btn btn-primary";

$Add_Button->onclick = "CreateBox(this);";
$Add_Button->AddAttribute("Url", $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectFiles");
$Add_Button->AddAttribute("ProjectPath", $url);

$I_Add = new I();
$I_Add->class = "material-icons FileBox";
$I_Add->text = "add";
$Add_Button->Add($I_Add);

$Div_add->Add($Add_Button);

$Div_nav->Add($Div_add);

$Div_nav->render();

$Div_grid = new Div();
$Div_grid->class = "m-0 p-1";

foreach (scandir($url) as $key => $file) {
    if ($file != "." && $file != ".."){
        
        $Div = new Div();
    
        $Div->class = "border border-dark rounded";
        
        $Div->css = [
            'width' => '7em',
            'height' => '7em',
            'margin' => '5px',
            'display' => 'inline-block',
        ];

        $Button = new Button();
        $Button->type = "button";
        $Button->onclick = "EditObject(this);";

        $Button->class = "btn btn-primary";

        ///Editar el Objeto
        $Button->AddAttribute(
            "Url", 
            $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectObjects&Do=Edit"
        );
        $Button->AddAttribute("ObjectPath", $url.$file);
        $Button->AddAttribute("ProjectName", $_POST['ProjectName']);

        $Button->css = [
            'width' => '100%',
            'height' => '100%',
            'margin' => '0px',
            'padding' => '0px',
        ];

        $I = new I();
        $I->class = "material-icons mt-auto mb-auto d-block";

        //Box
        $I->text = "inventory_2";
        
        $Label = new Label();
        $Label->class = "mt-auto mb-auto";
        $Label->text = $file;

        $Button->Add($I);
        $Button->Add($Label);

        $Div->Add($Button);

        $Div_grid->Add($Div);

    }
    
}

$Div_grid->render();




?>