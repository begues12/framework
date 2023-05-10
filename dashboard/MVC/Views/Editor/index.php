<?php
namespace MVC\Views\Editor;

use Engine\Core\Config;

$this->Config = new Config();

$this->Config->autoload("ROOT_WIDGETS", "Sidebar");
$this->Config->autoload("FILE_ERRORMSG");

$this->Config->autoload("ROOT_HTML", "A");
$this->Config->autoload("ROOT_HTML", "I");
$this->Config->autoload("ROOT_HTML", "Div");
$this->Config->autoload("ROOT_HTML", "Button");
$this->Config->autoload("ROOT_HTML", "Label");
$this->Config->autoload("ROOT_HTML", "Input");
$this->Config->autoload("ROOT_HTML", "IFrame");
$this->Config->autoload("ROOT_WIDGETS", "Alerts\ErrorMsg");

use Engine\Core\BaseView;

use Engine\Utils\Widgets\Sidebar;
use Engine\Utils\HTML\A;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Input;
use Engine\Utils\HTML\IFrame;

use Engine\Utils\Widgets\Alerts\ErrorMsg;

class Index extends BaseView{

    /// Objects
    public $Content;
    public $Sidebar;
    public $Editor;

    /// Variables
    public $ProjectName;

    function __construct(){
        parent::__construct();

        $this->css = [
            'height' => '90vh',
        ];

        $this->Content = new Div();
        $this->Sidebar = new Sidebar();
        $this->Sidebar->css = [
            'position' => 'sticky',
        ];
        $this->Editor = new Div();

    }

    public function Check(){

        if(isset($_GET['Project'])){
            $this->ProjectName = $_GET['Project'];
        }else{
            $Error = new ErrorMsg("Error", "Project not found");
            $Error->render();
        }

    }

    public function Prepare()
    {

        $this->Check();

        /// Add content to the view
        $this->Content->class = "content row m-0 p-0";
        $this->Content->css = [
            "height" => "100%",
            "width" => "100%",
        ];

        /// Add the sidebar to the content
        $this->Editor->class = "row row-fluid col-12 m-0 p-0";

        $this->Sidebar();

        $this->ViewPages();

        $this->Content->Add($this->Editor);

        $this->Add($this->Content);
    }

    public function Sidebar(){

        $Button_pageView = new Button();
        // On mouse hover, the button will change its color
        $Button_pageView->class = "btn Sidebar_Button rounded-0";
        $Button_pageView->id = "Sidebar_PageView";
        $Button_pageView->AddAttribute("title", "Page View");
        $Button_pageView->AddAttribute("Ctrl", "index");
        $Button_pageView->AddAttribute("Url", $this->Config->get('URL_PROJECTS').$this->ProjectName."/index.php");

        $Icono_sidebar = new I();
        $Icono_sidebar->class = "material-icons hover";
        $Icono_sidebar->text = "restore_page";

        /// Add the icon to the button
        $Button_pageView->Add($Icono_sidebar->copy());
        $this->Sidebar->AddElement($Button_pageView);

        $Button_Files = new Button();
        $Button_Files->class = "btn Sidebar_Button rounded-0";
        $Button_Files->id = "Sidebar_Files";
        $Button_Files->AddAttribute("title", "Files");
        $Button_Files->AddAttribute("data-projectname", $this->ProjectName);
        $Button_Files->AddAttribute("data-url", $this->Config->get('URL_DASHBOARD')."?Ctrl=Editor\ProjectFiles&Do=Index");
        $Button_Files->AddAttribute("data-projecturl", $this->Config->get('BASE_PROJECTS').$this->ProjectName."/");

        $Icono_sidebar = new I();
        $Icono_sidebar->class = "material-icons hover";
        $Icono_sidebar->text = "folder";

        $Button_Files->Add($Icono_sidebar->copy());
        $this->Sidebar->AddElement($Button_Files);

        // Objects button
        $Button_Objects = new Button();
        $Button_Objects->class = "btn Sidebar_Button rounded-0";
        $Button_Objects->id = "Sidebar_Objects";
        $Button_Objects->AddAttribute("title", "ProjectObjects");
        $Button_Objects->AddAttribute("data-url", $this->Config->get('URL_DASHBOARD')."?Ctrl=Editor\ProjectObjects&Do=Index");
        $Button_Objects->AddAttribute("data-projectname", $this->ProjectName);

        $Icono_sidebar = new I();
        $Icono_sidebar->class = "material-icons hover";
        $Icono_sidebar->text = "bubble_chart";

        $Button_Objects->Add($Icono_sidebar->copy());
        $this->Sidebar->AddElement($Button_Objects);

        // Services button
        $Button_Services = new Button();
        $Button_Services->class = "btn Sidebar_Button rounded-0";
        $Button_Services->id = "Sidebar_Services";
        $Button_Services->AddAttribute("title", "Project Services");
        $Button_Services->AddAttribute("data-url", $this->Config->get('URL_DASHBOARD')."?Ctrl=Editor\ProjectsServices&Do=Index");
        $Button_Services->AddAttribute("data-projectname", $this->ProjectName);

        $Icono_sidebar = new I();
        $Icono_sidebar->class = "material-icons hover";
        // Services
        $Icono_sidebar->text = "build";

        $Button_Services->Add($Icono_sidebar->copy());
        $this->Sidebar->AddElement($Button_Services);

        // Configurations button
        $Button_config = new Button();
        $Button_config->class = "btn Sidebar_Button rounded-0";
        $Button_config->id = "Sidebar_Config";
        $Button_config->AddAttribute("title", "Configurations");
        $Button_config->AddAttribute("Url", $this->Config->get('URL_IMPORT_MVC_CALLABLE')."?Ctrl=Editor\ProjectConfig");
        $Button_config->AddAttribute("ProjectName", $this->ProjectName);

        $Icono_sidebar = new I();
        $Icono_sidebar->class = "material-icons hover m-0 p-0";
        $Icono_sidebar->text = "settings";

        $Button_config->Add($Icono_sidebar->copy());
        $this->Sidebar->AddElement($Button_config);

        $this->Editor->Add($this->Sidebar);

    }

    private function ViewPages(){
        
        $PageView_IFrame = new IFrame();
        $PageView_IFrame->class = "col m-0 p-0 PageView";
        $PageView_IFrame->id = "PageView_IFrame";
        $PageView_IFrame->AddAttribute("Url", $this->Config->get('URL_PROJECTS').$_GET['Project']."/index.php");
        $PageView_IFrame->AddAttribute("Ctrl", 'Menu');
        $PageView_IFrame->AddAttribute("frameborder", "1");
        $PageView_IFrame->src = $this->Config->get('URL_PROJECTS').$_GET['Project']."/index.php";
        $PageView_IFrame->css = [
            'overflow' => 'auto',
            'height' => '90vh',
        ];
        $this->Editor->Add($PageView_IFrame);

        $PageView_ProjectFiles = new Div();
        $PageView_ProjectFiles->class = "col m-0 p-0 PageView";
        $PageView_ProjectFiles->id = "PageView_ProjectFiles";
        $PageView_ProjectFiles->AddAttribute("Url", $this->Config->get('ROOT_DASHBOARD').$_GET['Project']."/index.php");
        $PageView_ProjectFiles->AddAttribute("data-projectname", $_GET['Project']);
        $PageView_ProjectFiles->css = [
            'overflow' => 'auto',
            'display' => 'none'
        ];
        $this->Editor->Add($PageView_ProjectFiles);

        $PageView_ProjectObjects = new Div();
        $PageView_ProjectObjects->class = "col m-0 p-0 PageView";
        $PageView_ProjectObjects->id = "PageView_ProjectObjects";
        $PageView_ProjectObjects->css = [
            'overflow' => 'auto',
            'display' => 'none',
            'height' => '90vh',
        ];
        $this->Editor->Add($PageView_ProjectObjects);

        $PageView_ProjectConfig = new Div();
        $PageView_ProjectConfig->class = "col p-0 PageView";
        $PageView_ProjectConfig->id = "PageView_ProjectConfig";
        $PageView_ProjectConfig->css = [
            'overflow' => 'auto',
            'display' => 'none',
            'height' => '90vh',
        ];

        $this->Editor->Add($PageView_ProjectConfig);
    }

}

?>
