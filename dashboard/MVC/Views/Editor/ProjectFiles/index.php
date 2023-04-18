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
if (isset($_POST['ProjectPath'])){
    $url = $Config->get('ROOT_PROJECTS').$_POST['ProjectPath']."/";
}

$Div_nav = new Div();
$Div_nav->class = "m-0 p-0 row text-center";

$Div_Undo = new Div();
$Div_Undo->class = "m-0 p-0 col-1 text-center";

$Undo_Button = new Button();
$Undo_Button->class = "btn btn-primary";
$Undo_Button->onclick = "FileBox(this);";

$Undo_url = explode("/", $url);

$Undo_url = array_slice($Undo_url, 0, count($Undo_url)-2);

$Undo_Button->AddAttribute(
    "Url", 
    $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectFiles"
);

$Undo_Button->AddAttribute("ProjectPath", implode("/", $Undo_url));

$I_Undo = new I();
$I_Undo->class = "material-icons FileBox";
$I_Undo->text = "undo";
$Undo_Button->Add($I_Undo);

$Div_Undo->Add($Undo_Button);

$Div_Url = new Div();
$Div_Url->class = "m-0 p-0 col-11";

$Input_Url = new Input();
$Input_Url->type = "text";
$Input_Url->class = "form-control w-100";
$Input_Url->value = $url;

$Div_Url->Add($Input_Url);

$Div_nav->Add($Div_Undo);
$Div_nav->Add($Div_Url);

$Div_nav->render();

$Div_grid = new Div();
$Div_grid->class = "m-0 p-1";

if (file_exists($url)){

    $files = scandir($url);

    foreach($files as $file){

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
                $Button->onclick = "FileBox(this);";

                if (is_dir($url.$file)){

                    $Button->class = "btn btn-primary";
                    $Button->AddAttribute(
                        "Url", 
                        $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectFiles"
                    );
                    $Button->AddAttribute("ProjectPath", $url.$file);

                }else{

                    $Button->class = "btn btn-secondary FileBox";
                    $Button->AddAttribute(
                        "Url", 
                        $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectFiles&Do=OpenFile"
                    );
                    $Button->AddAttribute("ProjectPath", $url.$file);
                }

                $Button->css = [
                    'width' => '100%',
                    'height' => '100%',
                    'margin' => '0px',
                    'padding' => '0px',
                ];

                $I = new I();
                $I->class = "material-icons mt-auto mb-auto d-block";


                if (is_dir($url.$file)){
                    $I->text = "folder";
                }else{
                    $I->text = "insert_drive_file";
                }

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

}


?>