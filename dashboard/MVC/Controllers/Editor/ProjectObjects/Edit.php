<?php
namespace MVC\Controllers\Editor\ProjectObjects;

//Fist load file config
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

//Load all HTML widgets
require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once($Config->get('ROOT_WIDGETS')."Alerts\ErrorMsg.php");
require_once($Config->get('ROOT_WIDGETS')."Alerts\ConfirmDeleteMsg.php");
require_once($Config->get('ROOT_WIDGETS')."Alerts\SuccessMsg.php");
require_once $Config->get('ROOT_WIDGETS')."Alerts\InputAlert.php";
require_once $Config->get('ROOT_WIDGETS')."ProjectObjects/FieldTrBd.php";

use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Utils\Widgets\Alerts\ConfirmDeleteMsg;
use Engine\Utils\Widgets\Alerts\ErrorMsg;
use Engine\Utils\Widgets\Alerts\SuccessMsg;
use Engine\Utils\Widgets\Alerts\InputAlert;
use Engine\Utils\Widgets\ProjectObjects\FieldTrBd;
use Error;
use Exception;

class Edit extends BaseController{

    public $data_projectname;
    public $data_table;
    public $Fields;
    public $BaseSQL;

    function __construct(){
        parent::__construct();
    }

    public function Prepare()
    {

        if (isset($_POST['data-projectname']) && isset($_POST['data-table'])) {
            $this->data_projectname = $_POST['data-projectname'];
            $this->data_table = $_POST['data-table'];
            $this->BaseSQL = new BaseSQL($this->data_projectname);
            
            $Fields = $this->BaseSQL->getFields($this->data_table);

            $this->setVar('data-projectname', $this->data_projectname);
            $this->setVar('data-table', $this->data_table);
            $this->setVar('data-fields', $Fields);

        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

    }

    public function Finalize()
    {
    }

    static public function EditField()
    {
        
        $data_projectname = "";
        $data_table = "";
        
        $Fields = ["data-name", "data-type", "data-length", "data-ai", "data-default", "data-pk", "data-unique", "data-null"];

        $FieldsValue = array();

        foreach ($Fields as $Field) {
            if (isset($_POST[$Field])) {
                $FieldsValue[$Field] = $_POST[$Field];
            }else{
                $ErrorMsg = new ErrorMsg('Data not found', $Field." not found");
                $ErrorMsg->render();
                die();
            }
        }

        if (isset($_POST['data-projectname'])) {
            $data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        if (isset($_POST['data-table'])) {
            $data_table = $_POST['data-table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
            $ErrorMsg->render();
            die();
        }

        try{

            $BaseSQL = new BaseSQL($data_projectname);
            
            $BaseSQL->alterTable(
                $data_table,
                'MODIFY COLUMN',
                $FieldsValue['data-name'],
                $FieldsValue['data-type'],
                $FieldsValue['data-length'],
                $FieldsValue['data-ai'],
                $FieldsValue['data-default'],
                $FieldsValue['data-pk'],
                $FieldsValue['data-unique'],
                $FieldsValue['data-null'],
            );

            $BaseSQL->Apply();

            if ($BaseSQL->OK()){
                $SuccessMsg = new SuccessMsg("Success", "Field <b>".$FieldsValue['data-name']."</b> has been edited");
                $SuccessMsg->render();
            }else{
                $ErrorMsg = new ErrorMsg("Error", "Field <b>".$FieldsValue['data-name']."</b> not edited");
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

        if (isset($_POST['data-projectname'])) {
            $ProjectName = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        if (isset($_POST['data-table'])) {
            $Table = $_POST['data-table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
            $ErrorMsg->render();
            die();
        }

        $InputAlert = new InputAlert("add_field", "New Field Name");
        $InputAlert->OnSubmit('AddField(this);');

        $Data = [
            'url'   => $Config->get('URL_DASHBOARD')."?Ctrl=Editor/ProjectObjects&Do=Edit&Action=AddField",
            'projectname'   => $ProjectName,
            'table'         => $Table,
        ];

        $InputAlert->Data($Data);

        $InputAlert->render();
    }

    static function AddField(){
        
        $data_projectname = "";
        $data_table = "";
        $data_field = "";

        if (isset($_POST['data-projectname'])) {
            $data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        if (isset($_POST['data-table'])) {
            $data_table = $_POST['data-table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
            $ErrorMsg->render();
            die();
        }

        if(isset($_POST['data-field'])){
            $data_field = $_POST['data-field'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Field name is not set");
            $ErrorMsg->render();
            die();
        }

        try{
            $BaseSQL = new BaseSQL($data_projectname);

            $BaseSQL->alterTable($data_table, "ADD", $data_field, "INTEGER");
            $BaseSQL->Apply();

            if($BaseSQL->OK()){
                $NewField = new FieldTrBd($data_projectname, $data_table, 0, $data_field);
                $NewField->render();
            }

        } catch (\Exception $e){
            $ErrorMsg = new ErrorMsg("Error", "Error on create new field");
            $ErrorMsg->render();
        }
    }

    static function ConfirmDeleteField(){

        $Config = new Config();

        $data_projectname = "";
        $data_table = "";
        $data_field = "";    
        $data_idfield = "";

        if (isset($_POST['data-projectname'])) {
            $data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        if (isset($_POST['data-table'])) {
            $data_table = $_POST['data-table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
            $ErrorMsg->render();
            die();
        }

        if(isset($_POST['data-field'])){
            $data_field = $_POST['data-field'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Field name is not set");
            $ErrorMsg->render();
            die();
        }

        if(isset($_POST['data-idfield'])){
            $data_idfield = $_POST['data-idfield'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Id Field name is not set");
            $ErrorMsg->render();
            die();
        }


        $ConfirmDelete = new ConfirmDeleteMsg($data_idfield, "Do you want to delete <b>".$data_field."</b> field?");
        $Data = [
            'url'           => $Config->get('URL_DASHBOARD')."?Ctrl=Editor/ProjectObjects&Do=Edit&Action=DeleteField",
            'field'         => $data_field,
            'projectname'   => $data_projectname,
            'idfield'       => $data_idfield,
            'table'         => $data_table,
        ];

        $ConfirmDelete->Data($Data);

        $ConfirmDelete->OnSubmit("DeleteField(this)");
        $ConfirmDelete->render();

    }


    static function DeleteField(){

        $Config = new Config();

        $data_projectname = "";
        $data_table = "";
        $data_field = "";    
        $data_idfield = "";

        if (isset($_POST['data-projectname'])) {
            $data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        if (isset($_POST['data-table'])) {
            $data_table = $_POST['data-table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Table name is not set");
            $ErrorMsg->render();
            die();
        }

        if(isset($_POST['data-field'])){
            $data_field = $_POST['data-field'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Field name is not set");
            $ErrorMsg->render();
            die();
        }

        if(isset($_POST['data-idfield'])){
            $data_idfield = $_POST['data-idfield'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Id Field name is not set");
            $ErrorMsg->render();
            die();
        }

        try{
            
            $BaseSQL = new BaseSQL($data_projectname);

            $BaseSQL->alterTable($data_table, "DROP COLUMN", $data_field);

            $BaseSQL->Apply();

            if ($BaseSQL->OK()){
                $SuccessMsg = new SuccessMsg("Success", "Field deleted");
                $SuccessMsg->render();
            }else{
                $ErrorMsg = new ErrorMsg("Error", "Field not deleted");
                $ErrorMsg->render();
            }


        } catch (\Exception $e){
            $ErrorMsg = new ErrorMsg("Error", "Field not deleted<br/>".$e);
            $ErrorMsg->render();
        }

    }

}


