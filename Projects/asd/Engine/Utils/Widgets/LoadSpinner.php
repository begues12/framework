<?php
namespace Engine\Utils\Widgets;

require_once("Config.php");
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('ROOT_HTML')."Div.php";

use Engine\Utils\HTML\Div;

class LoadSpinner extends Div{

    public $Spinner;

    function __construct(){

        //Navbar Div parent
        parent::__construct();
        $this->id = "LoadSpinner";

        // Center in to screen
        $this->css = [
            "width"             => "100%",
            "height"            => "100%",
            "position"          => "fixed",
            "top"               => "0",
            "left"              => "0",
            "right"             => "0",
            "bottom"            => "0",
            "z-index"           => "9",
            "background-color"  => "rgba(0, 0, 0, 0.3)",
            "display"           => "none",
        ];

        $this->Spinner = new Div();
        $this->Spinner->class = "spinner-border text-primary";
        $this->Spinner->AddAttribute('role', 'status');

        // Center in to screen
        $this->Spinner->css = [
            "width" => "3rem",
            "height" => "3rem",
            "position" => "absolute",
            "top" => "50%",
            "left" => "50%",
            "margin-top" => "-1.5rem",
            "margin-left" => "-1.5rem",
        ];

        $this->Add($this->Spinner);
    }

}

?>