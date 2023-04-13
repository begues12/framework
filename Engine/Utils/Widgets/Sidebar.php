<?php
namespace Engine\Utils\Widgets;

require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Div.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Ul.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Label.php";
require_once dirname(__DIR__, 3)."\Engine\Core\BaseUtils.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Li.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\A.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Svg.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\I.php";

use Core\BaseUtils;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Ul;
use Engine\Utils\HTML\Li;
use Engine\Utils\HTML\A;
use Engine\Utils\HTML\Svg;
use Engine\Utils\HTML\I;

class Sidebar extends Div{

    public $title;
    public $button;
    public $Ul_container;

    function __construct(){

        //Navbar Div parent
        parent::__construct();
        $this->class = "d-flex flex-column bg-light text-center";
        $this->id = "navbar";

        $this->css = [
            "width" => "1em",
            "height" => "100%",
        ];

        $this->content = [];

        //Navbar container
        $this->Ul_container = new Ul();
        $this->Ul_container->class = "nav nav-pills nav-flush flex-column mb-auto text-center";
        $this->Add($this->Ul_container);

    }

    /**
     * Add a new element to the navbar
     * @param BaseUtils $element
    */

    function AddElement(BaseUtils $element){

        $Navbar_item_div = new Li();

        $Navbar_item_div->class = "navbar-item nav-link border-bottom hover";
        
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