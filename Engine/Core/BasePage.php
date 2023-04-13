<?php

namespace Engine\Core;

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
        $this->ajax = false;
        $this->content = [];
        $this->charset = "utf8mb4";
        $this->lang = "en";
        $this->bootstrap = false;
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
            $html .= "<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js'></script>";
            $html .= "<script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js'></script>";
            $html .= "<link href='https://fonts.googleapis.com/icon?family=Material+Icons' rel='stylesheet'>";
            // JQuery bootstrap
            $html .= "<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js'></script>";
        }

        $html .= "</head>";

        $html .= "<body style='height: 100%;'>";

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

?>