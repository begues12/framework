<?php
namespace MVC\Views\Editor\ProjectObjects;

//Fist load file config
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

$Config->autoload('FILE_BASEVIEW');

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
require_once $Config->get('ROOT_WIDGETS')."FieldTrBd.php";

use Engine\Core\BaseView;

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
use Engine\Utils\Widgets\FieldTrBd;


class Edit extends BaseView{

    public $ProjectName;
    public $Tables;

    function __construct(){
        parent::__construct();

        $this->class = "p-2";
    }

    public function Prepare()
    {

        $this->ProjectName = $this->getVar('ProjectName');
        
        /* Title */
        $Label_Title_Editor = new Label();
        $Label_Title_Editor->class = "form-control-label font-weight-bold h3 border-bottom d-block .";
        $Label_Title_Editor->text = "Object Editor";
        $this->Add($Label_Title_Editor);

        /* Table Name */
        $Label_Table = new Label();
        $Label_Table->class = "form-control-label font-weight-bold h4 m-3";
        $Label_Table->text = "Table";
        
        $Input_Table = new Input();
        $Input_Table->type = "text";
        $Input_Table->class = "form-control d-block  ml-3 mr-3";
        $Input_Table->css = ['width' => '300px'];
        $Input_Table->name = "Object_Table";
        $Input_Table->value = $this->getVar('Object');
        $Input_Table->AddAttribute("readonly", "readonly");

        $this->Add($Label_Table);
        $this->Add($Input_Table);
        
        /* Fields */
        $Div_Table = new Div();
        $Div_Table->class = "form-group";
        $Div_Table->Add($Label_Table);
        $Div_Table->Add($Input_Table);
        
        $Div_Fields = new Div();
        $Div_Fields->class = "form-group m-3";
        
        $Label_Fields = new Label();
        $Label_Fields->class = "form-control-label d-block h4 font-weight-bold";
        $Label_Fields->text = "Fields";
        
        $Div_Fields->Add($Label_Fields);
        
        $Button_AddField = new Button();
        $Button_AddField->class = "btn btn-primary ml-auto mb-3";
        $Button_AddField->onclick = "AddField(this);";
        $Button_AddField->text = "Add Field";
        $Button_AddField->AddAttribute("URL", $this->Config->get("URL_DASHBOARD"));
        $Button_AddField->AddAttribute("ProjectName", $this->ProjectName);
        $Button_AddField->AddAttribute("Table", $this->getVar('Object'));
        
        $Div_Fields->Add($Button_AddField);
        
        $this->Add($Div_Fields);

        $Table_Field_header = new Table();
        $Table_Field_header->class = "form-group col-md-12 table table-bordered table-striped table-hover table-sm";
        $Table_Field_header->id = "Table_Fields";
        
        $Tr_Field_header = new Tr();
        
        $All_Fields = ["#", "Name", "Type", "Length", "AI", "Default", "PK", "Unique", "Null", "Actions" ];
        
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
        
        foreach( $this->getVar('Fields')[0]['Rows'] as $index => $Field ) {

            $Tr_Field = new FieldTrBd($this->ProjectName, $index, $Field['Field']);

            $Tr_Field->setTypeValue(explode("(", $Field['Type'])[0]);
            $Tr_Field->setLengthValue(explode("(", str_replace(")","",$Field['Type']))[1]);

            $AI_Value = false;

            if (isset($Field['Extra'])){
                $AI_Value = true;
            }
            $Tr_Field->setAIValue($AI_Value);

            $Default_Value = "";

            if (isset($Field['Default'])){
                $Default_Value = $Field['Default'];
            }

            $Tr_Field->setDefaultValue($Default_Value);
            
            $PK_Value = false;
            if ($Field['Key'] == "PRI"){
                $PK_Value = true;
            }
            
            $Tr_Field->setPKValue($PK_Value);

            $Unique_Val = false;

            if ($Field['Key'] == "UNI"){
                $Unique_Val = true;
            }
            $Tr_Field->setUniqueValue($Unique_Val);

            $Null_Value = true;
            if ($Field['Null'] == "NO"){
                $Null_Value = false;
            }

            $Tr_Field->setNullValue($Null_Value);
          
            $Table_Field_header->Add($Tr_Field);
        
        }

        $Div_Fields->Add($Table_Field_header);


    }

}


?>
