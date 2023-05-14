<?php
namespace Engine\Utils\Widgets;

require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('FILE_BASEUTILS');
require_once $Config->get('ROOT_HTML')."Nav.php";
require_once $Config->get('ROOT_HTML')."Ul.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Li.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."Span.php";

use Core\BaseUtils;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Ul;
use Engine\Utils\HTML\Li;
use Engine\Utils\HTML\Nav;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Span;

class Navbar extends Nav{
    public $title;
    public $button;
    public $Ul_container;
    public $Div_container;

    function __construct(){

        //Navbar Div parent
        parent::__construct();
        $this->class = "navbar navbar-expand-md navbar-dark bg-dark";
        $this->id = "navbar";
        $this->css = [
            'height' => '8vh',
        ];
        $this->content = [];

        //Title
        $this->title = new Label();
        $this->title->text = "NavBar";
        $this->title->class = "navbar-brand";
        $this->title->css = [
            "font-size" => "20px",
            "font-weight" => "bold"
        ];

        // Add elements to navbar expand
        $this->button = new Button();
        $this->button->class = "navbar-toggler material-icons";
        $this->button->text = "menu";
        $this->button->type = "button";
        $this->button->AddAttribute("data-toggle", "collapse");
        $this->button->AddAttribute("data-target", "#navbarCollapse");
        $this->button->AddAttribute("aria-controls", "navbarCollapse");
        $this->button->AddAttribute("aria-expanded", "false");
        $this->button->AddAttribute("aria-label", "Toggle navigation");

        $this->Div_container = new Div();
        $this->Div_container->class = "collapse navbar-collapse";
        $this->Div_container->id = "navbarCollapse";


        //Navbar container
        $this->Ul_container = new Ul();
        $this->Ul_container->class = "navbar-nav  mr-auto";

        // Add title and container to navbar
        $this->Add($this->title);
        $this->Add($this->button);
        $this->Add($this->Div_container);
        $this->Div_container->Add($this->Ul_container);
    }

    /**
     * Add a new element to the navbar
     * @param BaseUtils $element
    */

    function AddElement(BaseUtils $element){

        $Navbar_item_div = new Li();

        $Navbar_item_div->class = "navbar-item";
        
        $Navbar_item_div->Add($element);

        $this->Ul_container->Add($Navbar_item_div);
    }

    /**
     * Set the navbar title
     * @param Label $title
     */

    function Title(Label $title){
        $this->title = $title;
    }

}

?>