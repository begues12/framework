<?php
namespace MVC\Controllers\Editor\ProjectObjects;

//Fist load file config
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

//Load all HTML widgets
require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once($Config->get('ROOT_WIDGETS')."ErrorMsg.php");
require_once($Config->get('ROOT_WIDGETS')."SuccessMsg.php");
require_once $Config->get('ROOT_WIDGETS')."InputAlert.php";

use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Utils\Widgets\ErrorMsg;
use Engine\Utils\Widgets\SuccessMsg;
use Engine\Utils\Widgets\InputAlert;

class Edit extends BaseController{

    public $ProjectName;
    public $Object;
    public $Fields;
    public $BaseSQL;

    function __construct(){
        parent::__construct();
    }

    public function Prepare()
    {

        if (isset($_POST['ProjectName']) && isset($_POST['Object'])) {
            $this->ProjectName = $_POST['ProjectName'];
            $this->Object = $_POST['Object'];
            $this->BaseSQL = new BaseSQL($this->ProjectName);
            
            $Fields = $this->BaseSQL->getFields($this->Object);

            $this->setVar('ProjectName', $this->ProjectName);
            $this->setVar('Object', $this->Object);
            $this->setVar('Fields', $Fields);

        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

    }

    public function Execute()
    {
    }

    public function Finalize()
    {
    }

    static public function EditField()
    {
        
        $ProjectName = "";
        $Table = "";
        
        $Fields = ["Name", "Type", "Length", "AI", "Default", "Pk", "Unique", "Null"];

        $FieldsValue = array();

        foreach ($Fields as $Field) {
            if (isset($_POST[$Field])) {
                $FieldsValue[$Field] = $_POST[$Field];
            }else{
                $ErrorMsg = new ErrorMsg("Error", $Field." is not set");
                $ErrorMsg->render();
                die();
            }
        }

        if (isset($_POST['ProjectName'])) {
            $ProjectName = $_POST['ProjectName'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        if (isset($_POST['Table'])) {
            $Table = $_POST['Table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
            $ErrorMsg->render();
            die();
        }

        try{

            $BaseSQL = new BaseSQL($ProjectName);
            
            $BaseSQL->alterTable(
                $Table,
                'MODIFY COLUMN',
                $FieldsValue['Name'],
                $FieldsValue['Type'],
                $FieldsValue['Length'],
                $FieldsValue['AI'],
                $FieldsValue['Default'],
                $FieldsValue['Pk'],
                $FieldsValue['Unique'],
                $FieldsValue['Null'],
            );

            $BaseSQL->Apply();

            if ($BaseSQL->OK()){
                $SuccessMsg = new SuccessMsg("Success", "Field <b>".$FieldsValue['Name']."</b> has been edited");
                $SuccessMsg->render();
            }else{
                $ErrorMsg = new ErrorMsg("Error", "Field <b>".$FieldsValue['Name']."</b> not edited");
                $ErrorMsg->render();
            }

        } catch (\Throwable $th) {
            $ErrorMsg = new ErrorMsg("Error", $th->getMessage());
            $ErrorMsg->render();
            die();
        }

    }


    static function AlertInput_AddField(){
        
        $Config = new Config();

        $ProjectName = "";
        $Table = "";

        if (isset($_POST['ProjectName'])) {
            $ProjectName = $_POST['ProjectName'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        if (isset($_POST['Table'])) {
            $Table = $_POST['Table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
            $ErrorMsg->render();
            die();
        }

        $InputAlert = new InputAlert("add_field", "New Field Name");

        $InputAlert->SubmitButton->AddAttribute("Url", $Config->get('URL_IMPORT_MVC')."?Ctrl=Editor/ProjectObjects&Action=AddField");
        $InputAlert->SubmitButton->AddAttribute("ProjectName", $ProjectName);
        $InputAlert->SubmitButton->AddAttribute("Table", $Table);

        $InputAlert->render();
    }

    static function AddField(){
        
    }

}


