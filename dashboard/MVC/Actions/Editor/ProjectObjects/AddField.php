<?php
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

$XML_FILE = "";
$ID_FIELD = "";

if (isset($_POST['XML_FILE'])) {
    $XML_FILE = $_POST['XML_FILE'];
}

if ($XML_FILE != "") {

    $xml = new SimpleXMLElement($XML_FILE, 0, true);
    
    if ($xml === false) {
        echo "No se pudo cargar el archivo XML";
    } else {
        
        // Get last field id
        $last_field  = $xml->xpath("//Field[last()]");
        $Field_Id = (int)$last_field[0]['id'] + 1;

        $Tr_Field = new Tr();
        $Tr_Field->id = "Fields_Field_".$Field_Id;
    
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
        $Input_Field->name = "Fields_Field_".$Field_Id."_Name";
    
        $Input_Field->placeholder = "Field Name";
    
        $Td_Field_Name->Add($Input_Field);
    
        /* Type */
    
        $Td_Field_Type = new Td();
        $Td_Field_Type->class = "justify-content-center";
    
        $Select_Type = new Select();
        $Select_Type->type = "text";
        $Select_Type->class = "form-control ml-auto mr-auto";
        $Select_Type->name = "Fields_Field_".$Field_Id."_Type";
    

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

            $Select_Type->Add($Option->Copy());
        }
    
        $Td_Field_Type->Add($Select_Type);
    
        /* Length */
    
        $Td_Field_Length = new Td();
        $Td_Field_Length->class = "justify-content-center";
        
        $Input_Length = new Input();
        $Input_Length->type = "text";
        $Input_Length->class = "form-control ml-auto mr-auto";
        $Input_Length->name = "Fields_Field_".$Field_Id."_Length";
    
        $Input_Length->placeholder = "Length";
    
        $Td_Field_Length->Add($Input_Length);
    
        /* AI */
    
        $Td_Field_AI = new Td();
        $Td_Field_AI->class = "justify-content-center";
        
        $Checkbox_AI = new Input();
        $Checkbox_AI->type = "checkbox";
        $Checkbox_AI->class = "form-control ml-auto mr-auto";
        $Checkbox_AI->name = "Fields_Field_".$Field_Id."_AutoIncrement";
        $Checkbox_AI->css = [ "width" => "15px", "height" => "15px" ];
    
        $Td_Field_AI->Add($Checkbox_AI);
    
        /* Required */
    
        $Td_Field_Requiered = new Td();
        $Td_Field_Requiered->class = "justify-content-center";
    
        $Checkbox_Requiered = new Input();
        $Checkbox_Requiered->type = "checkbox";
        $Checkbox_Requiered->class = "form-control ml-auto mr-auto";
        $Checkbox_Requiered->name = "Fields_Field_".$Field_Id."_Required";
        $Checkbox_Requiered->css = [ "width" => "15px", "height" => "15px" ];
    
        $Td_Field_Requiered->Add($Checkbox_Requiered);
    
        /* Default */
    
        $Td_Field_Default = new Td();
        $Td_Field_Default->class = "justify-content-center";
    
        $Input_Default = new Input();
        $Input_Default->type = "text";
        $Input_Default->class = "form-control ml-auto mr-auto";
        $Input_Default->name = "Fields_Field_".$Field_Id."_Default";

        $Input_Default->placeholder = "Default";
    
        $Td_Field_Default->Add($Input_Default);
    
        /* Primary Key */
    
        $Td_Field_PrimaryKey = new Td();
        $Td_Field_PrimaryKey->class = "justify-content-center";
    
        $Checkbox_PrimaryKey = new Input();
        $Checkbox_PrimaryKey->type = "radio";
        $Checkbox_PrimaryKey->class = "form-control ml-auto mr-auto";
        $Checkbox_PrimaryKey->name = "Fields_Field_".$Field_Id."_PrimaryKey";
        $Checkbox_PrimaryKey->css = [ "width" => "15px", "height" => "15px" ];

        $Td_Field_PrimaryKey->Add($Checkbox_PrimaryKey);
    
        /* Unique */
    
        $Td_Field_Unique = new Td();
        $Td_Field_Unique->class = "justify-content-center";
    
        $Checkbox_Unique = new Input();
        $Checkbox_Unique->type = "checkbox";
        $Checkbox_Unique->class = "form-control ml-auto mr-auto";
        $Checkbox_Unique->name = "Fields_Field_".$Field_Id."_Unique";
        $Checkbox_Unique->css = [ "width" => "15px", "height" => "15px" ];
  
        $Td_Field_Unique->Add($Checkbox_Unique);
    
        /* Null */
    
        $Td_Field_Null = new Td();
        $Td_Field_Null->class = "justify-content-center";
    
        $Checkbox_Null = new Input();
        $Checkbox_Null->type = "checkbox";
        $Checkbox_Null->class = "form-control ml-auto mr-auto";
        $Checkbox_Null->name = "Fields_Field_".$Field_Id."_Null";
        $Checkbox_Null->css = [ "width" => "15px", "height" => "15px" ];
    
        $Td_Field_Null->Add($Checkbox_Null);
    
        /* Delete */
    
        $Td_Field_Delete = new Td();
        $Td_Field_Delete->class = "text-center";
    
        $Button_Delete = new Button();
        $Button_Delete->class = "btn btn-danger material-icons";
        $Button_Delete->text = "delete";
        $Button_Delete->AddAttribute("URL", $Config->get("URL_IMPORT_MVC"));
        $Button_Delete->AddAttribute("XML_File", $XML_FILE);
        $Button_Delete->AddAttribute("Id_Field", $Field_Id);
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

        $Tr_Field->render();

        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->load($XML_FILE);
        
        // Crear el nuevo campo con saltos de línea
        $root = $doc->getElementsByTagName('Relations')->item(0);
        $nuevo_campo = $doc->createElement('Relation');
        $nuevo_campo->setAttribute('id', $Field_Id);
    //     <Relation id="2">
    //     <Field>1</Field>
    //     <Type>ManyToOne</Type>
    //     <FKTable>Transfers</FKTable>
    //     <FKField>4</FKField>
    //   </Relation>
    //   <Relation id="3">


        $field = $doc->createElement('Field');
        $field->appendChild($doc->createTextNode($Field_Id));
        $nuevo_campo->appendChild($field);

        $type = $doc->createElement('Type');
        $type->appendChild($doc->createTextNode("ManyToOne"));
        $nuevo_campo->appendChild($type);

        $fktable = $doc->createElement('FKTable');
        $fktable->appendChild($doc->createTextNode($Table_Name));
        $nuevo_campo->appendChild($fktable);

        $fkfield = $doc->createElement('FKField');
        $fkfield->appendChild($doc->createTextNode($Field_Id));
        $nuevo_campo->appendChild($fkfield);

        $name = $doc->createElement('Name');
        $name->appendChild($doc->createTextNode(""));
        $nuevo_campo->appendChild($name);
        
        $type = $doc->createElement('Type');
        $type->appendChild($doc->createTextNode("int"));
        $nuevo_campo->appendChild($type);
        
        $desc = $doc->createElement('Description');
        $desc->appendChild($doc->createTextNode(""));
        $nuevo_campo->appendChild($desc);

        $required = $doc->createElement('Required');
        $required->appendChild($doc->createTextNode("0"));
        $nuevo_campo->appendChild($required);

        $default = $doc->createElement('Default');
        $default->appendChild($doc->createTextNode(""));
        $nuevo_campo->appendChild($default);

        $pk = $doc->createElement('PrimaryKey');
        $pk->appendChild($doc->createTextNode("0"));
        $nuevo_campo->appendChild($pk);

        $unique = $doc->createElement('Unique');
        $unique->appendChild($doc->createTextNode("0"));
        $nuevo_campo->appendChild($unique);

        $null = $doc->createElement('Null');
        $null->appendChild($doc->createTextNode("0"));
        $nuevo_campo->appendChild($null);

        $root->appendChild($nuevo_campo);

        $doc->save($XML_FILE);
        
    }
    
} else {
    echo "Error en los parámetros";
}
?>