<?php

// Create a new Project in Engine\Projects
require_once($Config->get('ROOT_CORE')."BasePage.php");
require_once($Config->get('ROOT_WIDGETS')."Sidebar.php");
require_once($Config->get('ROOT_HTML')."A.php");
require_once($Config->get('ROOT_HTML')."I.php");
require_once($Config->get('ROOT_HTML')."Div.php");
require_once($Config->get('ROOT_HTML')."Button.php");
require_once($Config->get('ROOT_HTML')."Label.php");
require_once($Config->get('ROOT_HTML')."Img.php");
require_once($Config->get('ROOT_HTML')."Textarea.php");
require_once($Config->get('ROOT_HTML')."Input.php");
require_once($Config->get('ROOT_HTML')."IFrame.php");

use Engine\Core\BasePage;
use Engine\Utils\Widgets\Sidebar;
use Engine\Utils\HTML\A;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Input;
use Engine\Utils\HTML\IFrame;

$Content = new Div();
$Content->css = [
    'height' => '82vh',
];

$Title_div = new Div();
$Title_div->css = [
    'height' => '4vh',
];

// Title of the project
$Title_project_name = new Label();
$Title_project_name->class = "h3";
$Title_project_name->css = [
    'position' => 'fixed',
    'left' => '1%',
    'top' => '10vh',
];

$Title_project_name->text = "Project name";

if (isset($_GET['Project'])) {
    $Title_project_name->text = $_GET['Project'];
}

$Title_div->Add($Title_project_name);

$Content->Add($Title_div);

// Sidebar
$Sidebar = new Sidebar();
$Sidebar->class = "p-0 m-0";
// Fix in left
$Sidebar->css = [
    'position' => 'fixed',
    'left' => '0',
    'top' => '17vh',
];

$ProjectName = "";

if(isset($_GET['Project'])){
    $ProjectName = $_GET['Project'];
}

$Editor = new Div();
$Editor->class = "p-0 row m-0";
// Fix in middle
$Editor->css = [
    'position' => 'fixed',
    'left' => '10%',
    'top' => '0vh',
    'width' => '100%',
    'height' => '85vh',
];

/// Add the buttons to the sidebar

// Page view button
$Button_pageView = new Button();
// On mouse hover, the button will change its color
$Button_pageView->class = "btn p-1 hover";
$Button_pageView->id = "Sidebar_PageView";
$Button_pageView->AddAttribute("title", "Page View");
$Button_pageView->AddAttribute("Ctrl", "index");
$Button_pageView->AddAttribute("Url", $Config->get('URL_PROJECTS').$ProjectName."/index.php");

$Icono_sidebar = new I();
$Icono_sidebar->class = "material-icons hover";
$Icono_sidebar->text = "restore_page";

/// Add the icon to the button
$Button_pageView->Add($Icono_sidebar->copy());
$Sidebar->AddElement($Button_pageView);

$Button_Files = new Button();
$Button_Files->class = "btn p-1";
$Button_Files->id = "Sidebar_Files";
$Button_Files->AddAttribute("title", "Files");
$Button_Files->AddAttribute("Ctrl", "index");
$Button_Files->AddAttribute("ProjectName", $ProjectName);
$Button_Files->AddAttribute("Url", $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectFiles");
$Button_Files->AddAttribute("ProjectPath", $Config->get('ROOT_PROJECT').$ProjectName);

$Icono_sidebar = new I();
$Icono_sidebar->class = "material-icons hover";
$Icono_sidebar->text = "folder";

$Button_Files->Add($Icono_sidebar->copy());
$Sidebar->AddElement($Button_Files);

// Objects button
$Button_Objects = new Button();
$Button_Objects->class = "btn p-1";
$Button_Objects->id = "Sidebar_Objects";
$Button_Objects->AddAttribute("title", "ProjectObjects");
$Button_Objects->AddAttribute("Url", $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectObjects");
$Button_Objects->AddAttribute("ProjectName", $ProjectName);

$Icono_sidebar = new I();
$Icono_sidebar->class = "material-icons hover";
$Icono_sidebar->text = "bubble_chart";

$Button_Objects->Add($Icono_sidebar->copy());
$Sidebar->AddElement($Button_Objects);

// Configurations button
$Button_config = new Button();
$Button_config->class = "btn p-1";
$Button_config->id = "Sidebar_Config";
$Button_config->AddAttribute("title", "Configurations");
$Button_config->AddAttribute("Url", $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectConfig");
$Button_config->AddAttribute("ProjectName", $ProjectName);

$Icono_sidebar = new I();
$Icono_sidebar->class = "material-icons hover";
$Icono_sidebar->text = "settings";

$Button_config->Add($Icono_sidebar->copy());
$Sidebar->AddElement($Button_config);

$Editor->Add($Sidebar);

$PageView_IFrame = new IFrame();
$PageView_IFrame->class = "container-fluid col-10 m-4 border border-dark PageView";
$PageView_IFrame->id = "PageView_IFrame";
$PageView_IFrame->AddAttribute("Url", $Config->get('URL_PROJECTS').$_GET['Project']."/index.php");
$PageView_IFrame->AddAttribute("Ctrl", 'Menu');
$PageView_IFrame->src = $Config->get('URL_PROJECTS').$_GET['Project']."/index.php";
$PageView_IFrame->AddAttribute("frameborder", "1");
$PageView_IFrame->css = [
    'height' => '82vh',
    'right' => '0',
    'top' => '13vh',
    'overflow' => 'auto'
];
$Editor->Add($PageView_IFrame);

$PageView_ProjectFiles = new Div();
$PageView_ProjectFiles->class = "container-fluid col-10 m-2 p-0 border border-dark PageView";
$PageView_ProjectFiles->id = "PageView_ProjectFiles";
$PageView_ProjectFiles->AddAttribute("Url", $Config->get('URL_IMPORT_MVC').$_GET['Project']."/index.php");
$PageView_ProjectFiles->AddAttribute("ProjectName", $_GET['Project']);
$PageView_ProjectFiles->css = [
    'height' => '82vh',
    'right' => '0',
    'top' => '13vh',
    'overflow' => 'auto',
    'display' => 'none'
];
$Editor->Add($PageView_ProjectFiles);

$PageView_ProjectObjects = new Div();
$PageView_ProjectObjects->class = "container-fluid col-10 m-2 p-0 border border-dark PageView";
$PageView_ProjectObjects->id = "PageView_ProjectObjects";
$PageView_ProjectObjects->css = [
    'height' => '82vh',
    'right' => '0',
    'top' => '13vh',
    'overflow' => 'auto',
    'display' => 'none'
];
$Editor->Add($PageView_ProjectObjects);

$PageView_ProjectConfig = new Div();
$PageView_ProjectConfig->class = "container-fluid col-10 m-2 p-0 border border-dark PageView";
$PageView_ProjectConfig->id = "PageView_ProjectConfig";
$PageView_ProjectConfig->css = [
    'height' => '82vh',
    'right' => '0',
    'top' => '13vh',
    'overflow' => 'auto',
    'display' => 'none'
];
$Editor->Add($PageView_ProjectConfig);

$Sidebar_Attributes = new Sidebar();
$Sidebar_Attributes->class = "col-2 p-0 border border-dark";
$Sidebar_Attributes->id = "Sidebar_Attributes";
$Sidebar_Attributes->css = [
    'position' => 'fixed',
    'height' => '82vh',
    'right' => '0',
    'top' => '17vh',
    'overflow' => 'auto'
];


// Get settings from the database
$Settings = new Div();
$Settings->class = "p-0 m-0";
$Settings->id = "Settings";

$Label_placeholder = new Div();
$Label_placeholder->class = "container-fluid p-0 m-0";
$Label_placeholder->id = "Label_placeholder";
$Label_placeholder->text = "Settings Object";

$Input_placeholder = new Input();
$Input_placeholder->class = "container-fluid p-0 m-0";
$Input_placeholder->id = "Input_placeholder";
$Input_placeholder->type = "text";
$Input_placeholder->value = "Settings Object";

$Settings->Add($Label_placeholder);
$Settings->Add($Input_placeholder);

$Sidebar_Attributes->AddElement($Settings);

// $Editor->Add($Sidebar_Attributes);

$Content->Add($Editor);

$Content->render();

?>
