<?php

namespace Engine\Core;

require_once "Config.php";
use Engine\Core\Config;
use SimpleXMLElement;

class BaseObject{

    public $Config;
    public $Data;
    public $Fields;
    public $Relations;
    public $Table;
    public $PrimaryKey;
    public $Id;
    public $XmlFile;

    function __construct(String $XmlFile){
        $this->XmlFile = $XmlFile;
        $this->Config = new Config();
        $this->Data = [];
        $this->Relations = [];
        $this->Table = "";
        $this->PrimaryKey = "";
        $this->Id = "";
    
        $this->DataObjectXML();
    }

    function DataObjectXML(){

        if (file_exists($this->XmlFile)) {

            $xml = simplexml_load_file($this->XmlFile);

            $this->Table = $xml->table;
            $this->PrimaryKey = $xml->primaryKey;

            foreach($xml->children() as $child){
                
                if($child->getName() == "Fields"){
                    
                    foreach($child->children() as $field){
                        ///Get attributes
                        $attributes = $field->attributes();
                        $this->Config->pre_array($attributes);

                        foreach($attributes as $key => $value){
                            $this->Fields[$field->getName()][$key] = $value;
                        }

                    }

                }

                if($child->getName() == "Relations"){
                    $this->Relations[] = $child;
                }
            }

            $this->Config->pre_array($this->Fields);
            $this->Config->pre_array($this->Relations);

        } else {
            exit('Failed to open '.$this->XmlFile);
        }

    }

    /*
    * Create Object in database
    */
    function CreateObject(){
    }

    /*
    * Delete Object in database
    */
    function DeleteObject(){
    }

    /*
    * Update Object in database
    */
    function UpdateObject(){
    }

}

?>