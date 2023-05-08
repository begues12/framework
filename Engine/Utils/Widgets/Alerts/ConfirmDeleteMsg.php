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

class ConfirmDeleteMsg extends Div{

    public $Icon;
    public $Message;
    public $ConfirmDeleteButton;
    public $DenyDeleteButton;
    public $Url;

    function __construct($Id, $Message){

        parent::__construct();

        // Fix in top center
        $this->class = "alert alert-dark alert-dismissible fade show pl-3 pr-3 pt-4";
        $this->id = "ConfirmDeleteMsg";
        $this->AddAttribute("role", "alert");

        // In center of screen 
        $this->css = [
            "position" => "fixed",
            "top" => "70px",
            "left" => "50%",
            "transform" => "translate(-50%, -50%)",
            "z-index" => "100000"
        ];

        $this->Message = new Span();
        $this->Message->class = "font-weight-bold  d-block";
        $this->Message->text = $Message;

        $this->Add($this->Message);

        $this->AddAttribute("style", "margin-top: 10px;");

        $CloseButton = new Button();
        $CloseButton->class = "close material-icons p-1";
        $CloseButton->text = "close";
        $CloseButton->AddAttribute("data-dismiss", "alert");
        $CloseButton->AddAttribute("aria-label", "Close");

        $this->Add($CloseButton);

        $DivButtons = new Div();
        $DivButtons->class = "float-right m-2";

        $DenyDeleteButton = new Button();
        $DenyDeleteButton->class = "btn btn-secondary btn-sm float-right ml-1";
        $DenyDeleteButton->text = "Cancel";
        $DenyDeleteButton->AddAttribute("data-dismiss", "alert");
        $DenyDeleteButton->AddAttribute("aria-label", "Close");

        $DivButtons->Add($DenyDeleteButton);

        $this->ConfirmDeleteButton = new Button();
        $this->ConfirmDeleteButton->class = "btn btn-danger btn-sm float-right";
        $this->ConfirmDeleteButton->text = "Delete";
        $this->ConfirmDeleteButton->id = "ConfirmDeleteButton";

        $DivButtons->Add($this->ConfirmDeleteButton);

        $this->Add($DivButtons);

        $this->Js("Utils/Widgets/ConfirmDeleteMsg.js");

    }
    function OnSubmit(String $action){
        $this->ConfirmDeleteButton->onclick = $action;
    }

    function Data(Array $Data){

        foreach($Data as $Key => $Value){
            $this->ConfirmDeleteButton->AddAttribute("data-".$Key, $Value);
        }

    }
}

?>