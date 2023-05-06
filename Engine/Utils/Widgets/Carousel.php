<?php

namespace Engine\Utils\Widgets;

require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Div.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Img.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Li.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Ol.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\A.php";
require_once dirname(__DIR__, 3)."\Engine\Utils\HTML\Span.php";
require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();
require_once $Config->get('FILE_BASEUTILS');

use Engine\Utils\HTML\Div;
use Core\BaseUtils;
use Engine\Utils\HTML\Img;
use Engine\Utils\HTML\Li;
use Engine\Utils\HTML\Ol;
use Engine\Utils\HTML\A;
use Engine\Utils\HTML\Span;

class Carousel extends Div{

    public $CarruselInner;
    public $CarruseIndicators;
    public $PrevControl;
    public $NextControl;

    function __construct(){

        //ScrollDiv container
        parent::__construct();
        $this->class = "carousel slide d-block w-100";
        $this->id = "carouselExampleControls";

        $this->AddAttribute("data-ride", "carousel");

        $this->content = [];

        $this->CarruseIndicators = new Ol();
        $this->CarruseIndicators->class = "carousel-indicators";
   
        // Controls
        $this->PrevControl = new A();
        $this->PrevControl->class = "carousel-control-prev";
        $this->PrevControl->href = "#carouselExampleControls";
        $this->PrevControl->AddAttribute("data-slide", "prev");
        $this->PrevControl->AddAttribute("role", "button");

        $Prev_control_span = new Span();
        $Prev_control_span->class = "carousel-control-prev-icon";
        $Prev_control_span->AddAttribute("aria-hidden", "true");
        $this->PrevControl->Add($Prev_control_span);

        $Prev_control_span = new Span();
        $Prev_control_span->class = "sr-only";
        $Prev_control_span->text = "Previous";
        $this->PrevControl->Add($Prev_control_span);

        $this->NextControl = new A();
        $this->NextControl->class = "carousel-control-next";
        $this->NextControl->href = "#carouselExampleControls";
        $this->NextControl->AddAttribute("data-slide", "next");
        $this->NextControl->AddAttribute("role", "button");

        $Next_control_span = new Span();
        $Next_control_span->class = "carousel-control-next-icon";
        $Next_control_span->AddAttribute("aria-hidden", "true");
        $this->NextControl->Add($Next_control_span);

        $Next_control_span = new Span();
        $Next_control_span->class = "sr-only";
        $Next_control_span->text = "Next";
        $this->NextControl->Add($Next_control_span);

        //Carrusel Inner
        $this->CarruselInner = new Div();
        $this->CarruselInner->class = "carousel-inner d-flex";
        $this->CarruselInner->AddAttribute("role", "listbox");

        $this->Add($this->CarruseIndicators);
        $this->Add($this->CarruselInner);
        $this->Add($this->PrevControl);
        $this->Add($this->NextControl);


    }

    /**
     * Add a new element to the navbar
     * @param string $title
     * @param string $href
     * @param string $icon
     * @param string $id
     */

    function AddImage(Img $element, bool $active = false){

        $Div = new Div();
        $Div->class = "carousel-item m-auto";

        if($active){
            $Div->class .= " active";
        }

        $Div->Add($element);
        $this->CarruselInner->Add($Div);

        $Li = new Li();
        $Li->AddAttribute("data-target", "#carouselExampleControls");
        $Li->AddAttribute("data-slide-to", count($this->CarruselInner->content) - 1);
        $this->CarruseIndicators->Add($Li);

    }

}
    

?>