<?php

/*
    * @package Engine
    * @version 1.0
    * @author Fuentes
    * @link 
*/

namespace Core;

require_once "Config.php";
use Engine\Core\Config;


class BaseUtils{

    #This function is parent of all of the classes in the Engine\Utils folder
    #It is used to create a new object of the class
    #It for create new html elements
    #Get all of the html attributes and css attributes

    public $Config;
    public $Js = "";
    public $doNothing;

    public $return = "";
    public $css = [];
    public $attributes = [];
    public $name = "";
    public $class = "";
    public $id = "";
    public $required = false;
    public $tag = "div";
    public $content = [];
    public $type = "";
    public $value = "";
    public $placeholder = "";
    public $min = null;
    public $max = null;
    public $pattern = null;
    public $rows = null;
    public $cols = null;
    public $multiple = false;
    public $options = [];
    public $selected = 0;
    public $checked = false;
    public $for = "";
    public $src = "";
    public $alt = "";
    public $href = "";
    public $target = "";
    public $method = "";
    public $action = "";
    public $enctype = "";
    public $length = 0;
    public $label = "";
    public $text = "";
    public $onchange = "";
    public $onclick = "";
    public $onsubmit = "";
    public $onreset = "";
    public $onfocus = "";
    public $onblur = "";
    public $onmouseover = "";
    public $onmouseout = "";
    public $onkeydown = "";
    public $onkeyup = "";
    public $onkeypress = "";
    public $onselect = "";
    public $onload = "";
    public $onunload = "";
    public $onabort = "";
    public $onerror = "";


    function __construct(){

        $this->Config = new Config();
        $this->Js = "";
        $this->doNothing = false;

        $this->return = "";
        $this->css = [];
        $this->attributes = [];
        $this->name = "";
        $this->class = "";
        $this->id = "";
        $this->required = false;
        $this->tag = "";
        $this->content = [];
        $this->type = "";
        $this->value = "";
        $this->placeholder = "";
        $this->min = null;
        $this->max = null;
        $this->pattern = null;
        $this->rows = null;
        $this->cols = null;
        $this->multiple = false;
        $this->options = [];
        $this->selected = 0;
        $this->checked = false;
        $this->for = "";
        $this->src = "";
        $this->alt = "";
        $this->href = "";
        $this->target = "";
        $this->method = "";
        $this->action = "";
        $this->enctype = "";
        $this->length = 0;
        $this->label = "";
        $this->text = "";
        $this->onchange = "";
        $this->onclick = "";
        $this->onsubmit = "";
        $this->onreset = "";
        $this->onfocus = "";
        $this->onblur = "";
        $this->onmouseover = "";
        $this->onmouseout = "";
        $this->onkeydown = "";
        $this->onkeyup = "";
        $this->onkeypress = "";
        $this->onselect = "";
        $this->onchange = "";
        $this->onload = "";
        $this->onunload = "";
        $this->onabort = "";
        $this->onerror = "";
        $this->onselect = "";
        $this->onsubmit = "";
        $this->onreset = "";
        $this->onfocus = "";
        $this->onblur = "";
        $this->onchange = "";
        $this->onselect = "";

    }

    /*
     * Add function
     * @param BaseUtil parent
     * @return BaseUtil
     * 
     * @desc Add a new element to the parent element
        * @example <div class="container"><div class="row"><div class="col-12"></div></div></div>
    */
    function Add (BaseUtils $Element){
        $this->content[] = $Element;
    }

    /*
        * @param String name
        * @param String value
        * @return void
        * @desc Add a new attribute to the element
        * @example <input type="text" name="name" class="name" id="name" required style="color: red;">
        */

    function AddCss($css){
        $this->css[] = $css;
    }

    /*
        * @param String name
        * @param String value
        * @return void
        * @desc Add a new attribute to the element
        * @example <input type="text" name="name" class="name" id="name" required style="color: red;">
        */

    function AddAttribute($name, $value){
        $this->attributes[$name] = $value;
    }

    //Return copy of the object

    /*
     * @return BaseUtil
     * @desc Return copy of the object
    */

    function Copy(){
        return clone $this;
    }


    /*
     * @return String
     * @desc Build the element
     * @example <input type="text" name="name" class="name" id="name" required style="color: red;">
     * @example <label for="name">Name</label>
    */

    function build(){

        $this->return .= "<".$this->tag;
        
        if($this->name != ""){
            $this->return .= " name='".$this->name."'";
        }
        if($this->class != ""){
            $this->return .= " class='".$this->class."'";
        }
        if($this->id != ""){
            $this->return .= " id='".$this->id."'";
        }
        if($this->required){
            $this->return .= " required";
        }
        if($this->type != ""){
            $this->return .= " type='".$this->type."'";
        }

        if($this->src != ""){
            $this->return .= " src='".$this->src."'";
        }

        if($this->alt != ""){
            $this->return .= " alt='".$this->alt."'";
        }

        if($this->href != ""){
            $this->return .= " href='".$this->href."'";
        }

        if($this->target != ""){
            $this->return .= " target='".$this->target."'";
        }

        if($this->action != ""){
            $this->return .= " action='".$this->action."'";
        }

        if($this->method != ""){
            $this->return .= " method='".$this->method."'";
        }

        if($this->enctype != ""){
            $this->return .= " enctype='".$this->enctype."'";
        }

        if($this->for != ""){
            $this->return .= " for='".$this->for."'";
        }

        if($this->value != ""){
            $this->return .= " value='".$this->value."'";
        }

        if($this->placeholder != ""){
            $this->return .= " placeholder='".$this->placeholder."'";
        }

        if($this->checked){
            $this->return .= " checked";
        }

        if($this->selected){
            $this->return .= " selected = selected";
        }

        if($this->multiple){
            $this->return .= " multiple";
        }

        if($this->min != null){
            $this->return .= " min='".$this->min."'";
        }

        if($this->max != null){
            $this->return .= " max='".$this->max."'";
        }

        if($this->pattern != null){
            $this->return .= " pattern='".$this->pattern."'";
        }

        if($this->rows != null){
            $this->return .= " rows='".$this->rows."'";
        }

        if($this->cols != null){
            $this->return .= " cols='".$this->cols."'";
        }

        if($this->length != 0){
            $this->return .= " length='".$this->length."'";
        }

        if($this->label != ""){
            $this->return .= " label='".$this->label."'";
        }

        if($this->onchange != ""){
            $this->return .= " onchange='".$this->onchange."'";
        }

        if($this->onclick != ""){
            $this->return .= " onclick='".$this->onclick."'";
        }

        if($this->onsubmit != ""){
            $this->return .= " onsubmit='".$this->onsubmit."'";
        }

        if($this->onreset != ""){
            $this->return .= " onreset='".$this->onreset."'";
        }

        if($this->onfocus != ""){
            $this->return .= " onfocus='".$this->onfocus."'";
        }

        if($this->onblur != ""){
            $this->return .= " onblur='".$this->onblur."'";
        }

        if($this->onmouseover != ""){
            $this->return .= " onmouseover='".$this->onmouseover."'";
        }

        if($this->onmouseout != ""){
            $this->return .= " onmouseout='".$this->onmouseout."'";
        }

        if($this->onkeydown != ""){
            $this->return .= " onkeydown='".$this->onkeydown."'";
        }

        if($this->onkeyup != ""){
            $this->return .= " onkeyup='".$this->onkeyup."'";
        }

        if($this->onkeypress != ""){
            $this->return .= " onkeypress='".$this->onkeypress."'";
        }

        if($this->onselect != ""){
            $this->return .= " onselect='".$this->onselect."'";
        }

        if($this->onchange != ""){
            $this->return .= " onchange='".$this->onchange."'";
        }

        if($this->onload != ""){
            $this->return .= " onload='".$this->onload."'";
        }

        if($this->onunload != ""){
            $this->return .= " onunload='".$this->onunload."'";
        }

        if($this->onabort != ""){
            $this->return .= " onabort='".$this->onabort."'";
        }

        if($this->onerror != ""){
            $this->return .= " onerror='".$this->onerror."'";
        }

        if(count($this->css) > 0){
            $this->return .= " style='";
            foreach($this->css as $key => $value){
                $this->return .= $key.":".$value.";";
            }
            $this->return .= "'";
        }
        if(count($this->attributes) > 0){
            foreach($this->attributes as $key => $value){
                $this->return .= " ".$key."='".$value."'";
            }
        }
        $this->return .= ">";

        if ($this->Js != ""){
            $this->return .= "<script src='{$this->Js}'></script>";
        }

        if(count($this->content) > 0){
            foreach($this->content as $value){
                $this->return .= $value->toString();
            }
        }

        if ($this->text != ""){
            $this->return .= $this->text;
        }

        $this->return .= "</".$this->tag.">";
        return $this->return;
    }

    /*
     * @return String
     * @desc Get the element
    */
    function toString(){
        return $this->build();
    }

    /*
     * @return void
     * @desc Render the element
    */
    function render(){
        echo $this->build();
    }

    function Js(String $js){

        $Config = new Config();

        if (file_exists($Config->get('ROOT_JS').$js)){
            $this->Js = $Config->get('URL_JS').$js;
        }
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