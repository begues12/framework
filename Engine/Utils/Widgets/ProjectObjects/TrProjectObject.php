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
    public $ObjectName;
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

    public function __construct($Index, $ObjectName, $ProjectName){
        $this->Config = new Config();
        
        $this->tag = "tr";
        $this->id = "Tr_Object_".$Index;
        $this->class = "text-center";

        $this->ProjectName = $ProjectName;
        $this->Index = $Index;
        $this->ObjectName = $ObjectName;

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
        $this->Label_Name_Object->text = $this->ObjectName;

        $this->Td_Name_Object->Add($this->Label_Name_Object);
        $this->Add($this->Td_Name_Object);
    }

    private function AddActions(){

        $this->Td_Actions_Object->class = "text-center m-0 p-0 align-middle";
        $this->Td_Actions_Object->css = [
        ];

        $this->Button_Show_Object->class = "btn btn-primary ml-1 material-icons";
        $this->Button_Show_Object->text = "visibility";
        $this->Button_Show_Object->onclick = "ShowObject(this);";
        $this->Button_Show_Object->AddAttribute(
            "Url", 
            $this->Config->get('URL_DASHBOARD')."?Ctrl=Editor\ProjectObjects&Do=Show"
        );
        $this->Button_Show_Object->AddAttribute("Object", $this->ObjectName);
        $this->Button_Show_Object->AddAttribute("ProjectName", $this->ProjectName);

        $this->Button_Edit_Object->class = "btn btn-warning ml-1 material-icons";
        $this->Button_Edit_Object->text = "edit";
        $this->Button_Edit_Object->onclick = "EditObject(this);";
        $this->Button_Edit_Object->AddAttribute(
            "Url", 
            $this->Config->get('URL_DASHBOARD')."?Ctrl=Editor\ProjectObjects&Do=Edit"
        );
        $this->Button_Edit_Object->AddAttribute("Object", $this->ObjectName);
        $this->Button_Edit_Object->AddAttribute("ProjectName", $this->ProjectName);

        $this->Button_Delete_Object->class = "btn btn-danger ml-1 material-icons";
        $this->Button_Delete_Object->text = "delete";
        $this->Button_Delete_Object->AddAttribute(
            "Url", 
            $this->Config->get('URL_DASHBOARD')
        );
        $this->Button_Delete_Object->AddAttribute("IdField", $this->Index);
        $this->Button_Delete_Object->AddAttribute("NameTable", $this->ObjectName);
        $this->Button_Delete_Object->AddAttribute("ProjectName", $this->ProjectName);
        $this->Button_Delete_Object->onclick = "ConfirmDelete(this);";

        $this->Td_Actions_Object->Add($this->Button_Show_Object);
        $this->Td_Actions_Object->Add($this->Button_Edit_Object);
        $this->Td_Actions_Object->Add($this->Button_Delete_Object);

        $this->Add($this->Td_Actions_Object);
    }

}