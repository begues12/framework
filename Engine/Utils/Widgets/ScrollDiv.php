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

class ScrollDiv extends Div{

    public $title;
    public $button;
  
    function __construct(){

        //ScrollDiv container
        parent::__construct();
        $this->class = "scroll-div";
        $this->id = "scroll-div";
        $this->css = [
            "width" => "100%",
            "height" => "100%",
            "overflow-y" => "scroll"
        ];

        $this->content = [];

        //Title
        $this->title = new I();
        $this->title->class = "d-block p-3 link-dark fas fa-cloud border-bottom";
        $this->title->css = [
            "font-size" => "20px",
            "font-weight" => "bold"
        ];

        $this->Add($this->title);

        //Navbar container
        $Ul_container = new Ul();
        $Ul_container->class = "nav nav-pills nav-flush flex-column mb-auto text-center";
        $this->Add($Ul_container);


    }

    /**
     * Add a new element to the navbar
     * @param BaseUtils $element
    */

    function AddElement(BaseUtils $element){

        $Navbar_item_div = new Li();

        $Navbar_item_div->class = "nav-item";
        
        $Navbar_item_div->Add($element);

        $this->content[1]->Add($Navbar_item_div);
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