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
$ID_Relation = "";

if (isset($_POST['XML_FILE'])) {
    $XML_FILE = $_POST['XML_FILE'];
}

if ($XML_FILE != "") {

    $xml = new SimpleXMLElement($XML_FILE, 0, true);
    
    if ($xml === false) {
        echo "No se pudo cargar el archivo XML";
    } else {
        
        // Get last Relation id
        $last_relation = $xml->xpath("//Relation[last()]");
        $Relation_Id = (int) $last_relation[0]->attributes()->id + 1;

        $Tr_Relation = new Tr();
        $Tr_Relation->id = "Relations_Relation_".$Relation_Id;
        
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
        $Td_Relation_Name->class = "text-center";
    
        $Select_Relation_Field = new Select();
        $Select_Relation_Field->class = "form-control d-block Relation_Field";
        $Select_Relation_Field->name = "Relations_Relation_".$Relation_Id."_Field";
    
        foreach( $xml->Fields->Field as $Field ){
    
            $Option_Relation_Field = new Option();
            $Option_Relation_Field->text = $Field->Name;
            $Option_Relation_Field->value = $Field->attributes()->id;
    
            $Select_Relation_Field->Add($Option_Relation_Field);
    
        }
    
        $Td_Relation_Name->Add($Select_Relation_Field);
    
        /*
        * Relation Type
        */
    
        $Td_Relation_Type = new Td();
        $Td_Relation_Type->class = "text-center";
    
        $Select_Relation_Type = new Select();
        
        $Select_Relation_Type->class = "form-control d-block";
    
        $Select_Relation_Type->name = "Relations_Relation_".$Relation_Id."_Type";
    
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
    
            $Select_Relation_Type->Add($Option_Relation_Type);
    
        }
    
        $Td_Relation_Type->Add($Select_Relation_Type);
    
        /*
        * Relation Table
        */
    
        $Td_Relation_FKTable = new Td();
        $Td_Relation_FKTable->class = "text-center";
    
        $Select_Relation_FKTable = new Select();
        $Select_Relation_FKTable->class = "form-control d-block Relation_Table";
        $Select_Relation_FKTable->name = "Relations_Relation_".$Relation_Id."_FKTable";
        $Select_Relation_FKTable->id = "Relations_Relation_".$Relation_Id."_FKTable";
        $Select_Relation_FKTable->AddAttribute("data-id", $Relation_Id);
        $Select_Relation_FKTable->AddAttribute("onchange", "ChangeRelationFKTable(this)");
    
        $URL_PROJECT_OBJECTS = $Config->get("ROOT_PROJECTS").$_POST["ProjectName"]."/Objects/";
    
        $TableSelected = "";
    
        foreach(scandir($URL_PROJECT_OBJECTS) as $file) {
            if ('.' === $file) continue;
            if ('..' === $file) continue;
            if ($XML_FILE === $URL_PROJECT_OBJECTS.$file) continue;
    
                $XML_OBJECT = simplexml_load_file($URL_PROJECT_OBJECTS.$file);
                
                $Option_Relation_FKTable = new Option();
                $Option_Relation_FKTable->text = $XML_OBJECT->Name;
                $Option_Relation_FKTable->value = $XML_OBJECT->Name;

                $Select_Relation_FKTable->Add($Option_Relation_FKTable);
        }
        
        $Td_Relation_FKTable->Add($Select_Relation_FKTable);
    
        /*
        * Relation Field
        */
    
        $Td_Relation_FKField = new Td();
        $Td_Relation_FKField->class = "text-center";
    
        $Select_Relation_FKField = new Select();
        $Select_Relation_FKField->class = "form-control d-block Relation_Field";
        $Select_Relation_FKField->name = "Relations_Relation_".$Relation_Id."_FKField";
        $Select_Relation_FKField->id = "Relations_Relation_".$Relation_Id."_FKField";
        
        $i = 0;

        foreach(scandir($URL_PROJECT_OBJECTS) as $file) {
    
            if ('.' === $file) continue;
            if ('..' === $file) continue;
            if ($XML_FILE === $URL_PROJECT_OBJECTS.$file) continue;
    
            $XML_OBJECT = simplexml_load_file($URL_PROJECT_OBJECTS.$file);

            foreach( $XML_OBJECT->Fields->Field as $Field ){

                $Option_Relation_FKField = new Option();
                $Option_Relation_FKField->AddAttribute("FKTable", $XML_OBJECT->Name);

                if ($i != 0) {
                    $Option_Relation_FKField->css = ["display" => "none"];
                }

                $Option_Relation_FKField->text = $Field->Name;
                $Option_Relation_FKField->value = $Field->attributes()->id;

                $Select_Relation_FKField->Add($Option_Relation_FKField);
            }
            $i++;
        }
    
        $Td_Relation_FKField->Add($Select_Relation_FKField);
    
        /* 
        * Delete Relation 
        */
    
        $Td_Relation_Delete = new Td();
        $Td_Relation_Delete->class = "text-center";
    
        $Button_Delete_Relation = new Button();
        $Button_Delete_Relation->class = "btn btn-danger material-icons d-inline mr-1";
        //BD icon
        $Button_Delete_Relation->text = "delete";
        $Button_Delete_Relation->onclick = "DeleteRelation(this)";
        $Button_Delete_Relation->AddAttribute("URL", $Config->get("URL_IMPORT_MVC"));
        $Button_Delete_Relation->AddAttribute("XML_FILE", $XML_FILE);
        $Button_Delete_Relation->AddAttribute("Id_Relation", $Relation_Id);
    
        $Td_Relation_Delete ->Add($Button_Delete_Relation);
    
        /* 
        * Add to table 
        */
    
        $Tr_Relation->Add($Td_Relation_Id);
    
        $Tr_Relation->Add($Td_Relation_Name);
    
        $Tr_Relation->Add($Td_Relation_Type);
    
        $Tr_Relation->Add($Td_Relation_FKTable);
    
        $Tr_Relation->Add($Td_Relation_FKField);
    
        $Tr_Relation->Add($Td_Relation_Delete);

        $Tr_Relation->render();

        $doc = new DOMDocument();
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;
        $doc->load($XML_FILE);
        
        // Crear el nuevo campo con saltos de línea
        $root = $doc->getElementsByTagName('Relations')->item(0);
        $nuevo_campo = $doc->createElement('Relation');
        $nuevo_campo->setAttribute('id', $Relation_Id);

        $field = $doc->createElement('Field');
        $field->appendChild($doc->createTextNode(''));
        $nuevo_campo->appendChild($field);

        $type = $doc->createElement('Type');
        $type->appendChild($doc->createTextNode("ManyToOne"));
        $nuevo_campo->appendChild($type);

        $fktable = $doc->createElement('FKTable');
        $fktable->appendChild($doc->createTextNode(''));
        $nuevo_campo->appendChild($fktable);

        $fkfield = $doc->createElement('FKField');
        $fkfield->appendChild($doc->createTextNode(''));
        $nuevo_campo->appendChild($fkfield);

        $root->appendChild($nuevo_campo);

        $doc->save($XML_FILE);
        
    }
    
} else {
    echo "Error en los parámetros";
}
?>