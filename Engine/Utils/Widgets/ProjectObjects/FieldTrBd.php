<?php
namespace Engine\Utils\Widgets\ProjectObjects;

require_once "Config.php";
use Engine\Core\Config;

require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."Input.php";
require_once $Config->get('ROOT_HTML')."Tr.php";
require_once $Config->get('ROOT_HTML')."Td.php";
require_once $Config->get('ROOT_HTML')."Select.php";
require_once $Config->get('ROOT_HTML')."Option.php";

use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Input;
use Engine\Utils\HTML\Tr;
use Engine\Utils\HTML\Td;
use Engine\Utils\HTML\Select;
use Engine\Utils\HTML\Option;

class FieldTrBd extends Tr{

    public $Config;
    public $ProjectName;
    public $IdField;
    public $TableName;

    public $Name;
    public $Type;
    public $AllTypes;
    public $Length;
    public $AI;
    public $Default;
    public $Pk;
    public $Unique;
    public $Null;

    public $Td_Field_IdField;
    public $Td_Field_Name;
    public $Td_Field_Type;
    public $Td_Field_Length;
    public $Td_Field_Default;
    public $Td_Field_Pk;
    public $Td_Field_Unique;
    public $Td_Field_Null;
    public $Td_Field_AI;
    public $Td_Field_Actions;

    public $Label_IdField;
    public $Input_Name;
    public $Select_Type;
    public $Option_Type;
    public $Input_Length;
    public $Input_Default;

    public $Radio_Pk;
    public $Input_Hidden_Pk;

    public $Checkbox_Unique;
    public $Input_Hidden_Unique;

    public $Checkbox_Null;
    public $Input_Hidden_Null;
    
    public $Checkbox_AI;
    public $Input_Hidden_AI;

    public $Button_Save;
    public $Button_Delete;

    function __construct (String $ProjectName, String $TableName, Int $IdField, String $Name)
    {
        parent::__construct();

        $this->Config       = new Config();
        $this->TableName    = $TableName;
        $this->ProjectName  = $ProjectName;
        $this->IdField      = $IdField;
        $this->Name         = $Name;

        $this->id       = "Field_".$this->IdField;
        $this->class    = "justify-content-center";

        $this->AllTypes  = [
            'int', 
            'varchar',
            'text',
            'date',
            'datetime',
            'time',
            'timestamp',
            'year',
            'tinyint',
            'smallint',
            'mediumint',
            'bigint',
            'decimal',
            'float',
            'double',
            'bit',
            'bool',
            'enum',
            'set',
            'char',
            'binary',
            'varbinary',
            'tinyblob',
            'blob',
            'mediumblob',
            'longblob',
            'tinytext',
            'mediumtext',
            'longtext',
            'json'
        ];

        $this->Td_Field_IdField = new Td();
        $this->Td_Field_Name    = new Td();
        $this->Td_Field_Type    = new Td();
        $this->Td_Field_Length  = new Td();
        $this->Td_Field_Default = new Td();
        $this->Td_Field_Pk      = new Td();
        $this->Td_Field_Unique  = new Td();
        $this->Td_Field_Null    = new Td();
        $this->Td_Field_AI      = new Td();
        $this->Td_Field_Actions  = new Td();
        
        $this->Label_IdField    = new Label();
        $this->Input_Name       = new Input();
        $this->Select_Type      = new Select();
        $this->Option_Type      = new Option();
        $this->Input_Length     = new Input();

        $this->Checkbox_AI          = new Input();
        $this->Checkbox_AI->type    = "checkbox";
        $this->Input_Hidden_AI      = new Input();
        $this->Input_Hidden_AI->type    = "hidden";

        $this->Input_Default    = new Input();

        $this->Radio_Pk         = new Input();
        $this->Radio_Pk->type   = "radio";
        $this->Input_Hidden_Pk  = new Input();
        $this->Input_Hidden_Pk->type   = "hidden";

        $this->Checkbox_Unique  = new Input();
        $this->Checkbox_Unique->type = "checkbox";
        $this->Input_Hidden_Unique  = new Input();
        $this->Input_Hidden_Unique->type = "hidden";

        $this->Checkbox_Null    = new Input();
        $this->Checkbox_Null->type = "checkbox";
        $this->Input_Hidden_Null    = new Input();
        $this->Input_Hidden_Null->type = "hidden";

        $this->Button_Delete    = new Button();
        $this->Button_Save      = new Button();


        $this->AddId();
        $this->AddName();
        $this->AddType();
        $this->AddLength();
        $this->AddAI();
        $this->AddDefault();
        $this->AddPk();
        $this->AddUnique();
        $this->AddNull();
        $this->AddActions();

    }

    function AddId(){

        $this->Td_Field_IdField->class = "justify-content-center";
    
        $this->Label_IdField->class  = "form-control-label text-right Field_IdField";
        $this->Label_IdField->text   = $this->IdField;

        $this->Td_Field_IdField->add($this->Label_IdField);
        $this->add($this->Td_Field_IdField);
    }

    function AddName(){
        $this->Td_Field_Name->class   = "justify-content-center";
    
        $this->Input_Name->type          = "text";
        $this->Input_Name->class         = "form-control ml-auto mr-auto Field_Name";
        $this->Input_Name->name          = "Field_".$this->IdField."_Name";
        $this->Input_Name->id            = "Field_".$this->IdField."_Name";
        $this->Input_Name->placeholder   = "Field Name";
        $this->Input_Name->value         = $this->Name;
        $this->Input_Name->AddAttribute("readonly", "readonly");
        $this->Input_Name->AddAttribute("IdField", $this->IdField);
        $this->Td_Field_Name->add($this->Input_Name);
        $this->add($this->Td_Field_Name);
    }

    function AddType(){
        $this->Td_Field_Type->class   = "justify-content-center";
    
        $this->Select_Type->type  = "text";
        $this->Select_Type->class = "form-control ml-auto mr-auto Field_Type";
        $this->Select_Type->name  = "Field_".$this->IdField."_Type";
        $this->Select_Type->id    = "Field_".$this->IdField."_Type";
        $this->Select_Type->AddAttribute("IdField", $this->IdField);
        
        foreach($this->AllTypes as $Type){
            $this->Option_Type->value  = $Type;
            $this->Option_Type->text   = $Type;
            $this->Select_Type->Add($this->Option_Type->Copy());
        }
    
        $this->Td_Field_Type->add($this->Select_Type);
        $this->add($this->Td_Field_Type);
    }

    function AddLength(){
        
        $this->Td_Field_Length->class     = "justify-content-center";
        
        $this->Input_Length->type         = "text";
        $this->Input_Length->class        = "form-control ml-auto mr-auto Field_Length";
        $this->Input_Length->name         = "Field_".$this->IdField."_Length";
        $this->Input_Length->id           = "Field_".$this->IdField."_Length";
        $this->Input_Length->placeholder  = "Length";
        $this->Input_Length->AddAttribute("IdField", $this->IdField);

        $this->Td_Field_Length->Add($this->Input_Length);
        $this->add($this->Td_Field_Length);

    }

    function AddAi(){

        $this->Td_Field_AI->class = "justify-content-center";
        
        $this->Checkbox_AI->class = "form-control ml-auto mr-auto Field_AI";
        $this->Checkbox_AI->name  = "Field_AI";
        $this->Checkbox_AI->id    = "Field_".$this->IdField."_AI";
        $this->Checkbox_AI->value = "1";
        $this->Checkbox_AI->css   = [ "width" => "15px", "height" => "15px" ];
        $this->Checkbox_AI->AddAttribute("IdField", $this->IdField);

        $this->Td_Field_AI->Add($this->Checkbox_AI);
        $this->add($this->Td_Field_AI);
    }


    function AddDefault(){
        $this->Td_Field_Default->class    = "justify-content-center";
    
        $this->Input_Default->type        = "text";
        $this->Input_Default->class       = "form-control ml-auto mr-auto Field_Default";
        $this->Input_Default->name        = "Field_".$this->IdField."_Default";
        $this->Input_Default->id          = "Field_".$this->IdField."_Default";
        $this->Input_Default->placeholder = "Default";
        $this->Input_Default->AddAttribute("IdField", $this->IdField);
    
        $this->Td_Field_Default->Add($this->Input_Default);
        $this->add($this->Td_Field_Default);
    }

    function AddPK(){
        
        $this->Td_Field_Pk->class = "justify-content-center";
    
        $this->Radio_Pk->type  = "radio";
        $this->Radio_Pk->class = "form-control ml-auto mr-auto Field_Pk";
        $this->Radio_Pk->name  = "Field_PrimaryKey";
        $this->Radio_Pk->id    = "Field_".$this->IdField."_Pk";
        $this->Radio_Pk->value = "1";
        $this->Radio_Pk->css   = [ "width" => "15px", "height" => "15px" ];
        $this->Radio_Pk->AddAttribute("IdField", $this->IdField);
    
        $this->Input_Hidden_Pk->name  = "Field_".$this->IdField."_Pk";
        $this->Input_Hidden_Pk->value = "0";
    
        $this->Td_Field_Pk->Add($this->Input_Hidden_Pk);
        $this->Td_Field_Pk->Add($this->Radio_Pk);
        $this->add($this->Td_Field_Pk);
    }

    function AddUnique(){
        
        $this->Td_Field_Unique->class = "justify-content-center";
    
        $this->Checkbox_Unique->class = "form-control ml-auto mr-auto Field_Unique";
        $this->Checkbox_Unique->name  = "Field_".$this->IdField."_Unique";
        $this->Checkbox_Unique->id    = "Field_".$this->IdField."_Unique";
        $this->Checkbox_Unique->value = "1";
        $this->Checkbox_Unique->css   = [ "width" => "15px", "height" => "15px" ];
        $this->Checkbox_Unique->AddAttribute("IdField", $this->IdField);
    
        $this->Input_Hidden_Unique->type  = "hidden";
        $this->Input_Hidden_Unique->name  = "Field_".$this->IdField."_Unique";
        $this->Input_Hidden_Unique->value = "0";
        $this->Input_Hidden_Unique->id   = "Field_".$this->IdField."_Unique";
    
        $this->Td_Field_Unique->Add($this->Input_Hidden_Unique);
        $this->Td_Field_Unique->Add($this->Checkbox_Unique);
        $this->add($this->Td_Field_Unique);
    }

    function AddNull(){

        $this->Td_Field_Null->class   = "justify-content-center";
    
        $this->Checkbox_Null->class   = "form-control ml-auto mr-auto Field_Null";
        $this->Checkbox_Null->name    = "Field_".$this->IdField."_Null";
        $this->Checkbox_Null->id      = "Field_".$this->IdField."_Null";
        $this->Checkbox_Null->value   = "1";
        $this->Checkbox_Null->css     = [ "width" => "15px", "height" => "15px" ];
        $this->Checkbox_Null->AddAttribute("IdField", $this->IdField);

        $this->Input_Hidden_Null->name    = "Field_".$this->IdField."_Null";
        $this->Input_Hidden_Null->value   = "0";
    
        $this->Td_Field_Null->Add($this->Input_Hidden_Null);
        $this->Td_Field_Null->Add($this->Checkbox_Null);
        $this->add($this->Td_Field_Null);
    }

    function AddActions(){
        
        $this->Td_Field_Actions->class    = "text-center";

        $this->Button_Save            = new Button();
        $this->Button_Save->class     = "btn text-success bg-transparent material-icons";
        $this->Button_Save->css       = [ "font-size" => "24px"];
        $this->Button_Save->text      = "save";
        $this->Button_Save->onclick   = "EditField(this)";
        $this->Button_Save->AddAttribute("data-url", $this->Config->get("URL_DASHBOARD")."?Ctrl=Editor/ProjectObjects&Do=Edit&Action=EditField");
        $this->Button_Save->AddAttribute("data-table", $this->TableName);
        $this->Button_Save->AddAttribute("data-projectname", $this->ProjectName);
        $this->Button_Save->AddAttribute("data-field", $this->Name);
        $this->Button_Save->AddAttribute("data-idfield", $this->IdField);

        $this->Td_Field_Actions->Add($this->Button_Save);

        /* Delete */
    
        $this->Button_Delete          = new Button();
        $this->Button_Delete->class   = "btn text-danger bg-transparent material-icons";
        $this->Button_Delete->css     = [ "font-size" => "24px"];
        $this->Button_Delete->text    = "delete";
        $this->Button_Delete->onclick = "ConfirmDeleteField(this)";
        $this->Button_Delete->AddAttribute("data-url", $this->Config->get("URL_DASHBOARD")."?Ctrl=Editor/ProjectObjects&Do=Edit&Action=ConfirmDeleteField");
        $this->Button_Delete->AddAttribute("data-table", $this->TableName);
        $this->Button_Delete->AddAttribute("data-projectname", $this->ProjectName);
        $this->Button_Delete->AddAttribute("data-field", $this->Name);
        $this->Button_Delete->AddAttribute("data-idfield", $this->IdField);
    
        $this->Td_Field_Actions->Add($this->Button_Delete);

        $this->add($this->Td_Field_Actions);
    }


    function setTypeValue(String $Type){
        
        foreach($this->Select_Type->content as $Option){
            if($Option->value == $Type){
                $Option->selected = true;
            }
        }
        
    }

    function setLengthValue(String $Length){
        $this->Input_Length->value = $Length;
    }

    function setDefaultValue(String $Default){
        $this->Input_Default->value = $Default;
    }

    function setAIValue(bool $AI){
        if($AI){
            $this->Checkbox_AI->checked = true;
        }else{
            $this->Checkbox_AI->checked = false;
        }
    }

    function setPKValue(bool $PK){
        if($PK){
            $this->Radio_Pk->checked = true;
        }else{
            $this->Radio_Pk->checked = false;
        }
    }

    function setUniqueValue(bool $Unique){
        if($Unique){
            $this->Checkbox_Unique->checked = true;
        }else{
            $this->Checkbox_Unique->checked = false;
        }
    }

    function setNullValue(bool $Null){
        if($Null){
            $this->Checkbox_Null->checked = true;
        }else{
            $this->Checkbox_Null->checked = false;
        }

    }

}

?>