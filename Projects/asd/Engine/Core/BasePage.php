<?php

namespace Engine\Core;

require_once "Config.php";
use Engine\Core\Config;

$Config = new Config();

require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once $Config->get('FILE_BASEVIEW');


use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Core\BaseView;

require_once $Config->get('ROOT_WIDGETS')."Navbar.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."A.php";


use Engine\Utils\Widgets\Navbar;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\A;


class BasePage{

    public $title;
    public $icon;
    public $ajax;
    public $content;
    public $charset = "utf8mb4";
    public $lang = "en";
    public $bootstrap = false;
    public $css = [];
    public $head = [];
    public $link = [];
    public $script = [];
    public $meta = [];

    function __construct(){
        $this->title = "";
        $this->icon = "";
        $this->ajax = true;
        $this->content = [];
        $this->charset = "utf8mb4";
        $this->lang = "en";
        $this->bootstrap = true;
    }

    function setTitle($title){
        $this->title = $title;
    }

    function setIcon($icon){
        $this->icon = $icon;
    }

    function setAjax($ajax){
        $this->ajax = $ajax;
    }

    function setContent($content){
        $this->content = $content;
    }

    function setCharset($charset){
        $this->charset = $charset;
    }

    function getTitle(){
        return $this->title;
    }

    function getIcon(){
        return $this->icon;
    }

    function getContent(){
        return $this->content;
    }

    function getCharset(){
        return $this->charset;
    }

    /**
     * Build the HTML page
     * @return string
     */

    function build(){
        $html = "";
        
        $html .= "<!DOCTYPE html>";
        $html .= "<html lang='".$this->lang."'>";
        $html .= "<head>";
        $html .= "<meta charset='".$this->charset."'>";
        $html .= "<meta name='viewport' content='width=device-width, initial-scale=1'>";
        $html .= "<title>".$this->title."</title>";
        $html .= "<link rel='icon' href='".$this->icon."'>";
        // Ajax
        if($this->ajax){
            $html .= "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
        }

        if ($this->bootstrap) {
            $html .= "<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'/>";
            $html .= "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>";
            $html .= "<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>";
            // JQuery bootstrap
            $html .= "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
        }

        $html .= "</head>";

        $html .= "<body style='height: 85vh;'>";

        $this->Nav();

        $html .= $this->buildContent();


        return $html;
    }

    /* End of build() */
    function buildEnd(){
        $html = "";
        $html .= "</body>";
        $html .= "</html>";
        return $html;
    }

    /*
    * Add CSS
    */

    function Nav(){
        // Top navbar
        $NavbarTop = new Navbar();
        $Page_icon = new I();
        $NavbarTop->title->text = "Strawberry FW";
        //Desplegable si es necesario
        $NavbarTop->class = "navbar navbar-expand-lg navbar-dark bg-dark";
        $NavbarTop->css = [
            'height' => '8vh',
        ];

        // Button menu
        $NavbarTop_button = new A();
        $NavbarTop_button->css = [
            'color' => 'white',
            'margin-left' => '10px',
            'font-size' => '15px',
            'text-decoration' => 'none',
            'font-weight' => 'bold',
        ];

        $NavbarTop_button->class = "nav-link";
        $NavbarTop_button->text = "Menu";
        $NavbarTop_button->href = "?Ctrl=Menu";
        $NavbarTop->AddElement($NavbarTop_button->copy());

        $NavbarTop_button->class = "nav-link";
        $NavbarTop_button->text = "New project";
        $NavbarTop_button->href = "?Ctrl=NewProject";
        $NavbarTop->AddElement($NavbarTop_button->copy());

        $NavbarTop_button->class = "nav-link";
        $NavbarTop_button->text = "Projects";
        $NavbarTop_button->href = "?Ctrl=Projects";
        $NavbarTop->AddElement($NavbarTop_button->copy());

        // Documentation
        $NavbarTop_button->class = "nav-link";
        $NavbarTop_button->text = "Documentation";
        $NavbarTop_button->href = "?Ctrl=Documentation";
        $NavbarTop->AddElement($NavbarTop_button->copy());

        $this->Add($NavbarTop);

    }

    /**
     * Add content to the page
     * @param $content
     */

    function Add($content){
        array_push($this->content, $content);
    }


    /**
     * Build the content of the page
     * @return string
     */

    function buildContent(){
        $html = "";

        foreach($this->content as $content){
            $html .= $content->toString();
        }
        return $html;
    }

    /**
     * Render the page
     * @return string
     */
    function render(){
        echo $this->build();
        return $this->build();
    }

}

####################
#        ,~~~.     #
#       (\___/)    #
#       /_O_O_\    #
#      {=^___^=}   #
#       \_/ \_/    #
#__________________#
# Github:@Begues12 #
####################

?>