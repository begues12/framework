<?php
namespace Engine\Utils;

class Text{

    public $return = "";
    public $css = [];
    public $attributes = [];
    public $name = "";
    public $class = "";
    public $id = "";
    public $required = false;
    public $tag = "label";
    public $text = "";

    function __construct(){
        $this->return = "";
        $this->css = [];
        $this->attributes = [];
        $this->name = "";
        $this->class = "";
        $this->id = "";
        $this->required = false;
        $this->tag = "label";
        $this->text = "";
    }

    function add_css(){
        $this->return .= " style='";

        foreach($this->css as $key => $attribute){
            $this->return .= $key.":".$attribute.";";
        }

        // Close style attribute
        $this->return .= "'";

    }

    function add_attributes(){
        foreach($this->attributes as $key => $attribute){
            $this->return .= " ".$key."='".$attribute."'";
        }
    }

    function start(){
        $this->return = "<".$this->tag;

        //Add class name attribute;
        $this->return .= " class = '".$this->class."'";

        ///Add name attribute
        $this->return .= " name = '".$this->name."'";

        /// Add id attribute
        $this->return .= " id = '".$this->id."'";

        $this->add_css();

        $this->add_attributes();

        if($this->required){
            $this->return .= " required = 'required'";
        }

        $this->return .= ">";

        $this->return .= $this->text;

    }

    function end(){
        $this->return .= "</".$this->tag.">";
    }

    function get(){
        $this->start();
        $this->end();
        return $this->return;
    }

    function print(){
        echo $this->get();
        $this->return = "";
    }

}

?>