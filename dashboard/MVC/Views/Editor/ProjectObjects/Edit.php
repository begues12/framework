<?php

//Fist load file config
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Input.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Select.php";
require_once $Config->get('ROOT_HTML')."Option.php";
require_once $Config->get('ROOT_HTML')."Form.php";
require_once $Config->get('ROOT_HTML')."Table.php";
require_once $Config->get('ROOT_HTML')."Tr.php";
require_once $Config->get('ROOT_HTML')."Td.php";
require_once $Config->get('ROOT_HTML')."Nav.php";

use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Input;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Select;
use Engine\Utils\HTML\Option;
use Engine\Utils\HTML\Form;
use Engine\Utils\HTML\Table;
use Engine\Utils\HTML\Tr;
use Engine\Utils\HTML\Td;
use Engine\Utils\HTML\Nav;

$Label_XML_Path = new Label();
$Label_XML_Path->class = "form-control-label font-weight-bold";
$Label_XML_Path->text = "XML Path: ".$XML_PATH;

$Input_Name = new Input();
$Input_Name->type = "text";
$Input_Name->class = "form-control d-block";
$Input_Name->name = "Object_Name";
$Input_Name->value = $xml->Name;

$Label_Name = new Label();
$Label_Name->class = "form-control-label font-weight-bold";
$Label_Name->text = "Object Name";

$Div_Name = new Div();
$Div_Name->class = "form-group";
$Div_Name->Add($Label_Name);
$Div_Name->Add($Input_Name);

$Input_Table = new Input();
$Input_Table->type = "text";
$Input_Table->class = "form-control d-block";
$Input_Table->name = "Object_Table";
$Input_Table->value = $xml->Table;

$Label_Table = new Label();
$Label_Table->class = "form-control-label font-weight-bold";
$Label_Table->text = "Table";

$Div_Table = new Div();
$Div_Table->class = "form-group";
$Div_Table->Add($Label_Table);
$Div_Table->Add($Input_Table);

$Div_Fields = new Div();
$Div_Fields->class = "form-group row";

$Label_Fields = new Label();
$Label_Fields->class = "form-control-label d-block";
$Label_Fields->text = "Fields";

$Div_Fields->Add($Label_Fields);

$Button_AddField = new Button();
$Button_AddField->class = "btn btn-primary";
$Button_AddField->css = ["width" => "30px", "height" => "30px" ];
$Button_AddField->onclick = "AddField(this);";

$I_Add = new I();
$I_Add->class = "material-icons m-0 p-0"; 
$I_Add->css = [ "color" => "white", "font-size" => "18px" ];
$I_Add->text = "add";

$Button_AddField->Add($I_Add);

$Div_nav = new Div();
$Div_nav->class = "col-md-12";
$Div_nav->Add($Button_AddField);

$Div_Fields->Add($Div_nav);

$Table_Field_header = new Table();
$Table_Field_header->class = "form-group col-md-12 table table-bordered table-striped table-hover table-sm";

$Tr_Field_header = new Tr();

$All_Fields = ["id", "Name", "Type", "Length", "AI", "Required", "Default", "PK", "Unique", "Null", "Actions" ];

foreach($All_Fields as $Field){

    $Td_Field_header = new Td();
    $Td_Field_header->class = "text-center";

    $Label_Field_header = new Label();
    $Label_Field_header->class = "font-weight-bold";
    $Label_Field_header->text = $Field;

    $Td_Field_header->Add($Label_Field_header);
    $Tr_Field_header->Add($Td_Field_header);

}

$Table_Field_header->Add($Tr_Field_header);

foreach( $xml->Fields->Field as $Field){

    $Field_Id = $Field->attributes()->id;

    $Tr_Field = new Tr();
    $Tr_Field->id = "Field_".$Field_Id;

    /* ID */

    $Td_Field_Id = new Td();
    $Td_Field_Id->class = "justify-content-center";

    $Label_Field_Id = new Label();
    $Label_Field_Id->class = "form-control-label text-right";
    $Label_Field_Id->text = $Field_Id;

    $Td_Field_Id->Add($Label_Field_Id);

    /* Name */

    $Td_Field_Name = new Td();
    $Td_Field_Name->class = "justify-content-center";

    $Input_Field = new Input();
    $Input_Field->type = "text";
    $Input_Field->class = "form-control ml-auto mr-auto";
    $Input_Field->name = "Field_".$Field_Id."_Name";

    if (isset($Field->Name)){
        $Input_Field->value = $Field->Name;
    }

    $Input_Field->placeholder = "Field Name";

    $Td_Field_Name->Add($Input_Field);

    /* Type */

    $Td_Field_Type = new Td();
    $Td_Field_Type->class = "justify-content-center";

    $Select_Type = new Select();
    $Select_Type->type = "text";
    $Select_Type->class = "form-control ml-auto mr-auto";
    $Select_Type->name = "Field_".$Field_Id."_Type";

    if (isset($Field->Type)){
        $Select_Type->value = $Field->Type;
    }

    $AllTypes = [
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

    $Option = new Option();

    foreach($AllTypes as $Type){
        $Option = new Option();
        $Option->value = $Type;
        $Option->text = $Type;
        if (isset($Field->Type)){

            if ($Type == $Field->Type){
                $Option->selected = "selected";
            }
        }
        $Select_Type->Add($Option->Copy());
    }

    $Td_Field_Type->Add($Select_Type);

    /* Length */

    $Td_Field_Length = new Td();
    $Td_Field_Length->class = "justify-content-center";
    
    $Input_Length = new Input();
    $Input_Length->type = "text";
    $Input_Length->class = "form-control ml-auto mr-auto";
    $Input_Length->name = "Field_".$Field_Id."_Length";

    if (isset($Field->Length)){
        $Input_Length->value = $Field->Length;
    }
     
    $Input_Length->placeholder = "Length";

    $Td_Field_Length->Add($Input_Length);

    /* AI */

    $Td_Field_AI = new Td();
    $Td_Field_AI->class = "justify-content-center";
    
    $Checkbox_AI = new Input();
    $Checkbox_AI->type = "checkbox";
    $Checkbox_AI->class = "form-control ml-auto mr-auto";
    $Checkbox_AI->name = "Field_".$Field_Id."_AI";
    $Checkbox_AI->value = "1";
    $Checkbox_AI->css = [ "width" => "15px", "height" => "15px" ];

    if (isset($Field->AutoIncrement)){
        $Checkbox_AI->checked = $Field->AutoIncrement == "1" ? true : false;
    }

    $Td_Field_AI->Add($Checkbox_AI);

    /* Required */

    $Td_Field_Requiered = new Td();
    $Td_Field_Requiered->class = "justify-content-center";

    $Checkbox_Requiered = new Input();
    $Checkbox_Requiered->type = "checkbox";
    $Checkbox_Requiered->class = "form-control ml-auto mr-auto";
    $Checkbox_Requiered->name = "Field_".$Field_Id."_Required";
    $Checkbox_Requiered->value = "1";
    $Checkbox_Requiered->css = [ "width" => "15px", "height" => "15px" ];
    if (isset($Field->Required)) {
        $Checkbox_Requiered->checked = $Field->Required == "1" ? true : false;
    }

    $Td_Field_Requiered->Add($Checkbox_Requiered);

    /* Default */

    $Td_Field_Default = new Td();
    $Td_Field_Default->class = "justify-content-center";

    $Input_Default = new Input();
    $Input_Default->type = "text";
    $Input_Default->class = "form-control ml-auto mr-auto";
    $Input_Default->name = "Field_".$Field_Id."_Default";
    if (isset($Field->Default)) {
        $Input_Default->value = $Field->Default;
    }
    $Input_Default->placeholder = "Default";

    $Td_Field_Default->Add($Input_Default);

    /* Primary Key */

    $Td_Field_PrimaryKey = new Td();
    $Td_Field_PrimaryKey->class = "justify-content-center";

    $Checkbox_PrimaryKey = new Input();
    $Checkbox_PrimaryKey->type = "radio";
    $Checkbox_PrimaryKey->class = "form-control ml-auto mr-auto";
    $Checkbox_PrimaryKey->name = "Field_".$Field_Id."_PrimaryKey";
    $Checkbox_PrimaryKey->value = "1";
    $Checkbox_PrimaryKey->css = [ "width" => "15px", "height" => "15px" ];

    if (isset($Field->PrimaryKey)){
        $Checkbox_PrimaryKey->checked = $Field->PrimaryKey == "1" ? true : false;
    }
    $Td_Field_PrimaryKey->Add($Checkbox_PrimaryKey);

    /* Unique */

    $Td_Field_Unique = new Td();
    $Td_Field_Unique->class = "justify-content-center";

    $Checkbox_Unique = new Input();
    $Checkbox_Unique->type = "checkbox";
    $Checkbox_Unique->class = "form-control ml-auto mr-auto";
    $Checkbox_Unique->name = "Field_".$Field_Id."_Unique";
    $Checkbox_Unique->value = "1";
    $Checkbox_Unique->css = [ "width" => "15px", "height" => "15px" ];

    if (isset($Field->Unique)) {
        $Checkbox_Unique->checked = $Field->Unique == "1" ? true : false;
    }

    $Td_Field_Unique->Add($Checkbox_Unique);

    /* Null */

    $Td_Field_Null = new Td();
    $Td_Field_Null->class = "justify-content-center";

    $Checkbox_Null = new Input();
    $Checkbox_Null->type = "checkbox";
    $Checkbox_Null->class = "form-control ml-auto mr-auto";
    $Checkbox_Null->name = "Field_".$Field_Id."_Null";
    $Checkbox_Null->value = "1";
    $Checkbox_Null->css = [ "width" => "15px", "height" => "15px" ];
    if (isset($Field->Null)) {
        $Checkbox_Null->checked = $Field->Null == "1" ? true : false;
    }

    $Td_Field_Null->Add($Checkbox_Null);

    /* Delete */

    $Td_Field_Delete = new Td();
    $Td_Field_Delete->class = "text-center";

    $Button_Delete = new Button();
    $Button_Delete->class = "btn btn-danger material-icons";
    $Button_Delete->text = "delete";
    $Button_Delete->AddAttribute("URL", $Config->get("URL_IMPORT_MVC"));
    $Button_Delete->AddAttribute("XML_File", $XML_PATH);
    $Button_Delete->AddAttribute("Id_Field", $Field_Id);
    $Button_Delete->AddAttribute("Config", $Config->get("CONFIG"));
    $Button_Delete->onclick = "DeleteField(this)";

    $Td_Field_Delete->Add($Button_Delete);

    $Tr_Field->Add($Td_Field_Id);
    $Tr_Field->Add($Td_Field_Name);
    $Tr_Field->Add($Td_Field_Type);
    $Tr_Field->Add($Td_Field_Length);
    $Tr_Field->Add($Td_Field_AI);
    $Tr_Field->Add($Td_Field_Requiered);
    $Tr_Field->Add($Td_Field_Default);
    $Tr_Field->Add($Td_Field_PrimaryKey);
    $Tr_Field->Add($Td_Field_Unique);
    $Tr_Field->Add($Td_Field_Null);
    $Tr_Field->Add($Td_Field_Delete);
    
    $Table_Field_header->Add($Tr_Field);

}


/*
* Relations
*/

$Div_Nav = new Div();
$Div_Nav->class = "d-flex flex-row-reverse m-2";

$Nav_Relation_tools = new Div();
$Nav_Relation_tools->class = "col-1";

$Button_Add_Relation = new Button();

$Button_Add_Relation->class = "btn btn-primary p-0 m-0";
$Button_Add_Relation->css = [ "width" => "25px", "height" => "25px" ];
$Button_Add_Relation->onclick = "AddRelation()";

$Icon_Add_Relation = new I();
$Icon_Add_Relation->class = "material-icons";
$Icon_Add_Relation->css = [ "font-size" => "20px", "margin" => "auto"];
$Icon_Add_Relation->text = "add";

$Button_Add_Relation->Add($Icon_Add_Relation);

$Nav_Relation_tools->Add($Button_Add_Relation);

$Div_Nav->Add($Nav_Relation_tools);

$Table_Relation_header = new Table();
$Table_Relation_header->class = "table table-bordered table-hover table-sm";

$Tr_Relation = new Tr();

$Relations_Header = [ "Id", "Name", "Type", "Table", "Field"];

foreach ($Relations_Header as $Header){
    $Th_Relation = new Td();
    $Th_Relation->class = "text-center font-weight-bold";

    $Th_Relation->text = $Header;
    $Tr_Relation->Add($Th_Relation);
}

$Table_Relation_header->Add($Tr_Relation);

foreach( $xml->Relations->Relation as $Relation ){


    $Relation_Id = $Relation->attributes()->id;

    $Tr_Relation = new Tr();

    /*
    * Relation Id
    */

    $Td_Relation_Id = new Td();
    $Td_Relation_Id->class = "text-center font-weight-bold";

    $Label_Relation_Id = new Label();
    $Label_Relation_Id->class = "ml-auto mr-auto";
    $Label_Relation_Id->text = $Relation_Id;
  
    $Td_Relation_Id->Add($Label_Relation_Id);

    /*
    * Relation Name
    */

    $Td_Relation_Name = new Td();

    $Input_Relation_Name = new Input();

    $Input_Relation_Name->type = "text";
    $Input_Relation_Name->class = "form-control d-block";
    $Input_Relation_Name->name = "Relation_".$Relation_Id."_Name";
    $Input_Relation_Name->value = $Relation->Name;
    $Input_Relation_Name->placeholder = "Relation Name";

    $Td_Relation_Name->Add($Input_Relation_Name);

    /*
    * Relation Type
    */

    $Td_Relation_Type = new Td();

    $Select_Relation_Type = new Select();
    
    $Select_Relation_Type->class = "form-control d-block";

    $Select_Relation_Type->name = "Relation_".$Relation_Id."_Type";

    $Relation_types = [
        "One to One" => "OneToOne",
        "One to Many" => "OneToMany",
        "Many to One" => "ManyToOne",
        "Many to Many" => "ManyToMany"
    ];

    foreach( $Relation_types as $Relation_type => $Relation_type_value ){

        $Option_Relation_Type = new Option();
        $Option_Relation_Type->text = $Relation_type;
        $Option_Relation_Type->value = $Relation_type_value;
        $Option_Relation_Type->selected = $Relation->Type == $Relation_type_value ? true : false;

        $Select_Relation_Type->Add($Option_Relation_Type);

    }

    $Td_Relation_Type->Add($Select_Relation_Type);

    /*
    * Relation Table
    */

    $Td_Relation_Table = new Td();

    $Input_Relation_Table = new Input();
    $Input_Relation_Table->type = "text";
    $Input_Relation_Table->class = "form-control d-block";
    $Input_Relation_Table->name = "Relation_".$Relation_Id."_Table";
    $Input_Relation_Table->value = $Relation->FKTable;
    $Input_Relation_Table->placeholder = "Relation Table";

    $Td_Relation_Table->Add($Input_Relation_Table);

    /*
    * Relation Field
    */

    $Td_Relation_Field = new Td();
    
    $Input_Relation_Field = new Input();

    $Input_Relation_Field->type = "text";

    $Input_Relation_Field->class = "form-control d-block";

    $Input_Relation_Field->name = "Relation_".$Relation_Id."_Field";

    $Input_Relation_Field->value = $Relation->FKField;

    $Input_Relation_Field->placeholder = "Relation Field";

    $Td_Relation_Field->Add($Input_Relation_Field);

    $Tr_Relation->Add($Td_Relation_Id);

    $Tr_Relation->Add($Td_Relation_Name);

    $Tr_Relation->Add($Td_Relation_Type);

    $Tr_Relation->Add($Td_Relation_Table);

    $Tr_Relation->Add($Td_Relation_Field);

    $Table_Relation_header->Add($Tr_Relation);

}


$Div_Submit = new Div();
$Div_Submit->class = "form-group p-3 m-2 d-flex flex-row-reverse";

$Div_SubmitPos = new Div();
$Div_SubmitPos->class = "col-1";

$Button_Submit = new Button();
$Button_Submit->class = "btn btn-primary";
$Button_Submit->text = "Submit";
$Button_Submit->type = "button";
$Button_Submit->onclick = "SubmitEditObject()";

$Div_SubmitPos->Add($Button_Submit);
$Div_Submit->Add($Div_SubmitPos);

$Form = new Form();
$Form->action = "";
$Form->method = "post";
$Form->class = "form-horizontal";

$Form->Add($Label_XML_Path);
$Form->Add($Div_Name);
$Form->Add($Div_Table);
$Form->Add($Table_Field_header);
$Form->Add($Div_Nav);
$Form->Add($Table_Relation_header);
$Form->Add($Div_Submit);

$Div_Content = new Div();
$Div_Content->class = "form-group p-3 m-2";
$Div_Content->Add($Form);
$Div_Content->render();

?>