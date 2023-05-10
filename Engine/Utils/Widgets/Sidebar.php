<?php
namespace Engine\Utils\Widgets;

require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('FILE_BASEUTILS');
require_once $Config->get('ROOT_HTML')."Li.php";
require_once $Config->get('ROOT_HTML')."A.php";
require_once $Config->get('ROOT_HTML')."Svg.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Ul.php";
require_once $Config->get('ROOT_HTML')."Label.php";

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
        $this->class = "d-flex flex-column bg-light text-center border-right border-secondary";
        $this->id = "navbar";

        $this->css = [
            "height" => "92vh",
            'fixed' => 'top',
        ];

        $this->content = [];

        //Navbar container
        $this->Ul_container = new Ul();
        $this->Ul_container->class = "nav flex-column";
        $this->Add($this->Ul_container);

    }

    /**
     * Add a new element to the navbar
     * @param BaseUtils $element
    */

    function AddElement(BaseUtils $element){

        $Navbar_item_div = new Li();

        $Navbar_item_div->class = "navbar-item nav-link hover p-0";
        
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