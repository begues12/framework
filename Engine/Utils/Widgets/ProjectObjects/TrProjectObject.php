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

class TrProjectObject extends Tr{

    public $Config;
    public $tablename;
    public $ProjectName;
    public $Index;

    public $Td_Index_Object;
    public $Td_Name_Object;
    public $Td_Actions_Object;

    public $Label_Index_Object;
    public $Label_Name_Object;
    
    public $Button_Show_Object;
    public $Button_Edit_Object;
    public $Button_Delete_Object;

    public function __construct($Index, $tablename, $ProjectName){
        $this->Config = new Config();
        
        $this->tag = "tr";
        $this->id = "Tr_Object_".$Index;
        $this->class = "text-center Tr_Object";

        $this->ProjectName = $ProjectName;
        $this->Index = $Index;
        $this->tablename = $tablename;

        $this->Td_Index_Object = new Td($this->Config);
        $this->Td_Name_Object = new Td($this->Config);
        $this->Td_Actions_Object = new Td($this->Config);

        $this->Label_Index_Object = new Label($this->Config);
        $this->Label_Name_Object = new Label($this->Config);

        $this->Button_Show_Object = new Button($this->Config);
        $this->Button_Edit_Object = new Button($this->Config);
        $this->Button_Delete_Object = new Button($this->Config);

        $this->AddIndex();
        $this->AddName();
        $this->AddActions();

    }

    private function AddIndex(){

        $this->Td_Index_Object->class = "text-center m-0 p-0 align-middle";
        $this->Td_Index_Object->css = [
            'width' => '10%',
        ];
        $this->Label_Index_Object->class = "text-center font-weight-bold";
        $this->Label_Index_Object->text = $this->Index;

        $this->Td_Index_Object->Add($this->Label_Index_Object);
        $this->Add($this->Td_Index_Object);

    }

    private function AddName(){
        $this->Td_Name_Object->class = "text-left m-0 p-0 align-middle";
        $this->Td_Name_Object->css = [
            'width' => '60%',
        ];
        $this->Label_Name_Object->class = "text-left font-weight-bold";
        $this->Label_Name_Object->text = $this->tablename;

        $this->Td_Name_Object->Add($this->Label_Name_Object);
        $this->Add($this->Td_Name_Object);
    }

    private function AddActions(){


        // Actions Td

        $this->Td_Actions_Object->class = "text-center m-0 p-0 align-middle";
        $this->Td_Actions_Object->css = [
        ];


        // Show button

        $this->Button_Show_Object->class    = "btn text-primary bg-transparent material-icons";
        $this->Button_Show_Object->css      = [ "font-size" => "24px"];
        $this->Button_Show_Object->text     = "visibility";
        $this->Button_Show_Object->onclick  = "ShowObject(this);";
        $this->Button_Show_Object->AddAttribute( "data-url", $this->Config->get('URL_DASHBOARD')."?Ctrl=Editor\ProjectObjects&Do=Show");
        $this->Button_Show_Object->AddAttribute('data-mdb-toggle', 'tooltip');
        $this->Button_Show_Object->AddAttribute('data-title', "<em>Tooltip</em> <u>with</u> <b>HTML</b>");
        $this->Button_Show_Object->AddAttribute("data-table", $this->tablename);
        $this->Button_Show_Object->AddAttribute("data-projectname", $this->ProjectName);


        // Edit button

        $this->Button_Edit_Object->class    = "btn text-success bg-transparent material-icons";
        $this->Button_Edit_Object->text     = "edit";
        $this->Button_Edit_Object->onclick  = "EditObject(this);";
        $this->Button_Edit_Object->AddAttribute( "data-url", $this->Config->get('URL_DASHBOARD')."?Ctrl=Editor\ProjectObjects&Do=Edit");
        $this->Button_Edit_Object->AddAttribute("data-table", $this->tablename);
        $this->Button_Edit_Object->AddAttribute("data-projectname", $this->ProjectName);
        

        // Delete button

        $this->Button_Delete_Object->class      = "btn text-danger bg-transparent material-icons";
        $this->Button_Delete_Object->css        = [ "font-size" => "24px"];
        $this->Button_Delete_Object->text       = "delete";
        $this->Button_Delete_Object->onclick    = "ConfirmDelete(this);";
        $this->Button_Delete_Object->AddAttribute( "data-url", $this->Config->get('URL_DASHBOARD'));
        $this->Button_Delete_Object->AddAttribute("data-idfield", $this->Index);
        $this->Button_Delete_Object->AddAttribute("data-table", $this->tablename);
        $this->Button_Delete_Object->AddAttribute("data-projectname", $this->ProjectName);

        // Add buttons

        $this->Td_Actions_Object->Add($this->Button_Show_Object);
        $this->Td_Actions_Object->Add($this->Button_Edit_Object);
        $this->Td_Actions_Object->Add($this->Button_Delete_Object);

        $this->Add($this->Td_Actions_Object);
    }

}