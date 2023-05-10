<?php

namespace Engine\Utils\Widgets\Alerts;

require_once "Config.php";

use Core\BaseUtils;
use Engine\Core\BaseView;
use Engine\Core\Config;

$Config = new Config();

require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."Input.php";

use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Input;
/*
* This is a widget that creates an alert with an input and a submit button
*
* @param $Id is the id of the alert
* @param $Title is the title of the alert
*
* @param $Container is the container of the alert
* @param $CloseButton is the close button of the alert
* @param $Title is the title of the alert
* @param $InputDiv is the div of the input and the buttons
* @param $Input is the input of the alert
* @param $Span is the span of the input
* @param $SubmitButton is the submit button of the alert
*
* @method render() renders the alert
*/

class InputAlert extends Div{

    public $Container;
    public $CloseButton;
    public $DivTitle;
    public $Title;
    public $InputDiv;
    public $Input;
    public $Span;
    public $SubmitButton;

    function __construct($Id, $Title){

        parent::__construct();

        // Fix in top center
        $this->class = "alert alert-light alert-dismissible fade show position-fixed w-100 h-100";
        $this->id = 'Alert_'.$Id;
        $this->css = [
            "top" => "0",
            "left" => "0",
            "z-index" => "10000",
            "background-color" => "rgba(0, 0, 0, 0.5)"
        ];

        $this->Container = new Div();
        $this->Container->class = "bg-light fade show w-50 mx-auto border border-gray rounded p-3 text-right";

        // In center of screen 
        $this->Container->css = [
            "position" => "fixed",
            "top" => "70px",
            "left" => "50%",
            "transform" => "translate(-50%, -0%)",
            "z-index" => "100000"
        ];

        /*
        * This is the title of the alert
        */

        $this->DivTitle = new Div();
        $this->DivTitle->class = "d-flex text-left";


        $this->Title = new Label();
        $this->Title->class = "font-weight-bold d-block mb-2";
        $this->Title->text = $Title;


        /*
        * This is the div of the input and the buttons
        */

        $this->InputDiv = new Div();
        $this->InputDiv->class = "mb-3";


        /*
        * This is the input of the alert
        */

        $this->Input = new Input();
        $this->Input->type = "text";
        $this->Input->id = 'input_'.$Id;
        $this->Input->class = "form-control";
        $this->AddAttribute("style", "margin-top: 10px;");

        /*
        * This is the close button of the alert
        */

        $this->CloseButton = new Button();
        $this->CloseButton->class = "close material-icons p-2";
        $this->CloseButton->text = "close";
        // Cierra el div alertbgblack cuando se hace click en el boton con data-dismiss="alertbgblack"
        $this->CloseButton->AddAttribute("data-dismiss", "alert");
        $this->CloseButton->AddAttribute("aria-label", "Close");


        /*
        * This is the submit button of the alert
        */

        $this->SubmitButton = new Button();
        $this->SubmitButton->type = "button";
        $this->SubmitButton->class = "btn btn-success material-icons ml-auto";
        $this->SubmitButton->text = "check";
        $this->SubmitButton->id = "submit_".$Id;
        $this->SubmitButton->AddAttribute("data-father", 'Alert_'.$Id);
        $this->SubmitButton->AddAttribute("data-input", $this->Input->id);

        // Close the alert when the button is clicked


        /*
        * Add all the elements to the alert
        */

        $this->Add($this->Container);    
        $this->DivTitle->Add($this->Title);
        $this->Container->Add($this->DivTitle);
        $this->Container->Add($this->CloseButton);
        $this->Container->Add($this->InputDiv);
        $this->InputDiv->Add($this->Input);
        $this->Container->Add($this->SubmitButton);
    
        $this->Js("Utils/Widgets/InputAlert.js");

    }

    function AddInput(BaseUtils $Element){
        $this->InputDiv->Add($Element);
        $this->Data([$Element->name => $Element->id]);
    }

    function OnSubmit(String $action){
        $this->SubmitButton->onclick = $action;
    }

    /*
    *
    */

    function Data(Array $Data){

        foreach($Data as $Key => $Value){
            $this->SubmitButton->AddAttribute("data-".$Key, $Value);
        }

    }

}

?>