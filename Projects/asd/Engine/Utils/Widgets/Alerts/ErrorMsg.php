<?php

namespace Engine\Utils\Widgets\Alerts;

require_once "Config.php";
use Engine\Core\Config;

$Config = new Config();

require_once $Config->get('FILE_BASEUTILS');
use Core\BaseUtils;

require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Span.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";

use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Span;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;

class ErrorMsg extends Div{

    public $Icon;
    public $Title;
    public $Message;

    function __construct($Title, $Message){

        parent::__construct();

        // Fix in top center
        $this->class = "alert alert-danger alert-dismissible fade show border border-danger border-3 rounded";
        $this->id = "ErrorMsg";
        $this->AddAttribute("role", "alert");

        // In center of screen 
        $this->css = [
            "position" => "fixed",
            "top" => "70px",
            "left" => "50%",
            "transform" => "translate(-50%, -50%)",
            "z-index" => "100000"
        ];

        $Div = new Div();
        $Div->class = "container-fluid";
        $Div->css = [
            "padding" => "0px"
        ];

        $this->Icon = new I();
        $this->Icon->class = "material-icons d-inline mr-1 align-middle";
        $this->Icon->text = "error";

        $this->Title = new Label();
        $this->Title->class = "font-weight-bold d-inline mb-2 align-middle";
        $this->Title->text = $Title;

        $this->Message = new Span();
        $this->Message->text = $Message;


        $this->Add($Div);
        $Div->Add($this->Icon);
        $Div->Add($this->Title);
        $this->Add($this->Message);

        $this->AddAttribute("style", "margin-top: 10px;");

        $CloseButton = new Button();
        $CloseButton->class = "close p-1";

        $CloseHidden = new Span();
        $CloseHidden->AddAttribute("aria-hidden", "true");
        $CloseHidden->text = "&times;";

        $CloseButton->AddAttribute("data-dismiss", "alert");

        $CloseButton->Add($CloseHidden);
        $this->Add($CloseButton);

        $this->Js("Utils/Widgets/ErrorMsg.js");


    }

}

?>