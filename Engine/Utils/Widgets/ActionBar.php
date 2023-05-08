<?php
namespace Engine\Utils\Widgets;



require_once("Config.php");
use Engine\Core\Config;

$Config = new Config();
require_once $Config->get('FILE_BASEUTILS');
require_once $Config->get('ROOT_HTML')."Li.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."Span.php";
require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Nav.php";
require_once $Config->get('ROOT_HTML')."Ul.php";
require_once $Config->get('ROOT_HTML')."Label.php";

use Core\BaseUtils;
use Engine\Utils\HTML\Nav;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Ul;
use Engine\Utils\HTML\Li;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Span;

class ActionBar extends Nav{

    public $Label_Title;
    public $Ul_container;

    function __construct(){

        //Navbar Div parent
        parent::__construct();
        $this->class = "navbar navbar-expand-md bg-light border border-dark border-4 rounded mb-4 ml-auto mr-auto p-0";
        $this->id = "actionbar";

        $this->css = [
            'width' => "100%",
        ];
        $this->content = [];

        $this->Label_Title = new Label();
        $this->Label_Title->class = "h4 ml-1 mr-auto mt-auto mb-auto";
        $this->Add($this->Label_Title);

        //Navbar container
        $this->Ul_container = new Ul();
        $this->Ul_container->class = "navbar-nav ml-auto mt-auto mb-auto";
        $this->Add($this->Ul_container);
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

    function setTitle(String $Title){
        $this->Label_Title->text = $Title; 
    }

}

?>