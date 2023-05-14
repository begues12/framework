<?php
namespace MVC\Views\Menu;

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
    public $Title;

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
        $this->Title = new Label();

    }

    public function Check(){

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

        $this->Title->class = "col-12 text-center";
        $this->Title->css = [
            "font-size" => "2rem",
            "font-weight" => "bold",
        ];
        $this->Title->text = "Menu";

        $this->Content->Add($this->Title);

        $this->Add($this->Content);
    }

    
}

?>
