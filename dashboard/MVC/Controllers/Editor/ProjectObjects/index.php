<?php

namespace MVC\Controllers\Editor\ProjectObjects;

//Fist load file config
require_once "Config.php";
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once($Config->get('ROOT_WIDGETS')."Alerts\ErrorMsg.php");
require_once($Config->get('ROOT_WIDGETS')."Alerts\SuccessMsg.php");
require_once $Config->get('ROOT_WIDGETS')."Alerts\ConfirmDeleteMsg.php";
require_once $Config->get('ROOT_WIDGETS')."Alerts\InputAlert.php";

use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Utils\Widgets\Alerts\ErrorMsg;
use Engine\Utils\Widgets\Alerts\ConfirmDeleteMsg;
use Engine\Utils\Widgets\Alerts\SuccessMsg;

class Index extends BaseController{

    public $data_projectname;
    public $BaseSQL;
    public $data_tablename;

    function __construct(){
        parent::__construct();

        $this->data_projectname = "";
        $this->BaseSQL = null;
        $this->data_tablename = array();
    }

    public function Prepare()
    {
        if (isset($_POST['data-projectname'])) {
            $this->data_projectname = $_POST['data-projectname'];
            $this->BaseSQL = new BaseSQL($this->data_projectname);
            $this->data_tablename = $this->BaseSQL->getTables();
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        $this->setVar('data-projectname', $this->data_projectname);
        $this->setVar('data-tables', $this->data_tablename);

    }

    public function Finalize()
    {
    }


    static public function InputAlert_AddTable(){
        
    }

    static public function ConfirmDeleteObject(){

        $Config = new Config();

        $data_idfield = "";
        $data_tablename = "";
        $data_projectname = "";

        if(isset($_POST['data-idfield'])){
            $data_idfield = $_POST['data-idfield'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "IdField not found");
            $ErrorMsg->render();
            return;
        }

        if(isset($_POST['data-table'])){
            $data_tablename = $_POST['data-table'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "NameTable not found");
            $ErrorMsg->render();
            return;
        }

        if(isset($_POST['data-projectname'])){
            $data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "ProjectName not found");
            $ErrorMsg->render();
            return;
        }

        $ConfirmDelete = new ConfirmDeleteMsg($data_idfield, "Do you want to delete <b><u>".$data_tablename."</u></b>?");

        $Data = [
            'idfield' => $data_idfield, 
            'nametable' => $data_tablename, 
            'projectname' => $data_projectname, 
            'url' => $Config->get('URL_DASHBOARD')
        ];

        $ConfirmDelete->Data($Data);
        $ConfirmDelete->OnSubmit("DeleteObject(this);");

        $ConfirmDelete->render();

    }

    static public function DeleteObject(){

        $data_projectname = "";
        $data_tablename = "";

        if (isset($_POST['data-tablename'])) {
            $data_tablename = $_POST['data-tablename'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "NameTable not found");
            $ErrorMsg->render();
            return;
        }

        if (isset($_POST['data-projectname'])) {
            $data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "ProjectName not found");
            $ErrorMsg->render();
            return;
        }

        try{
            $BaseSQL = new BaseSQL($data_projectname);

            $BaseSQL->dropTable($data_tablename);

            $BaseSQL->Apply();

            if ($BaseSQL->OK()){
                $SuccessMsg = new SuccessMsg("Success", "Table <b>".$data_tablename."</b> deleted");
                $SuccessMsg->render();
            }else{
                $ErrorMsg = new ErrorMsg("Error", "Table <b>".$data_tablename."</b> not deleted");
                $ErrorMsg->render();
            }
        }catch(\Exception $e){
            $ErrorMsg = new ErrorMsg("Error", $e->getMessage());
            $ErrorMsg->render();
        }


            



    }

}
?>
