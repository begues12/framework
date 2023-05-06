<?php

namespace MVC\Controllers\Editor\ProjectObjects;

//Fist load file config
require_once "Config.php";
use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once($Config->get('ROOT_WIDGETS')."ErrorMsg.php");
require_once $Config->get('ROOT_WIDGETS')."ConfirmDeleteMsg.php";

use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Utils\Widgets\ErrorMsg;
use Engine\Utils\Widgets\ConfirmDeleteMsg;

class Index extends BaseController{

    public $ProjectName;
    public $BaseSQL;
    public $Tables;

    function __construct(){
        parent::__construct();

        $this->ProjectName = "";
        $this->BaseSQL = null;
        $this->Tables = array();
    }

    public function Prepare()
    {
        if (isset($_POST['ProjectName'])) {
            $this->ProjectName = $_POST['ProjectName'];
            $this->BaseSQL = new BaseSQL($this->ProjectName);
            $this->Tables = $this->BaseSQL->getTables();
        }else{
            $ErrorMsg = new ErrorMsg("Error", "Project name is not set");
            $ErrorMsg->render();
            die();
        }

        $this->setVar('ProjectName', $this->ProjectName);
        $this->setVar('Tables', $this->Tables);

    }

    public function Finalize()
    {
    }

    static public function ConfirmDeleteObject(){

        $Config = new Config();

        $IdField = "";
        $NameTable = "";
        $ProjectName = "";

        if(isset($_POST['IdField'])){
            $IdField = $_POST['IdField'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "IdField not found");
            $ErrorMsg->render();
            return;
        }

        if(isset($_POST['NameTable'])){
            $NameTable = $_POST['NameTable'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "NameTable not found");
            $ErrorMsg->render();
            return;
        }

        if(isset($_POST['ProjectName'])){
            $ProjectName = $_POST['ProjectName'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "ProjectName not found");
            $ErrorMsg->render();
            return;
        }

        $ConfirmDelete = new ConfirmDeleteMsg($IdField, "Do you want to delete <b>".$NameTable."</b>?");
        $ConfirmDelete->AddSendData(['idfield' => $IdField, 'nametable' => $NameTable, 'projectname' => $ProjectName, 'url' => $Config->get('URL_DASHBOARD')]);
        $ConfirmDelete->render();

    }

    static public function DeleteObject(){

        $ProjectName = "";
        $Table = "";

        if (isset($_POST['NameTable'])) {
            $Table = $_POST['NameTable'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "NameTable not found");
            $ErrorMsg->render();
            return;
        }

        if (isset($_POST['ProjectName'])) {
            $ProjectName = $_POST['ProjectName'];
        }else{
            $ErrorMsg = new ErrorMsg("Error", "ProjectName not found");
            $ErrorMsg->render();
            return;
        }

        try{
            $BaseSQL = new BaseSQL($ProjectName);

            $BaseSQL->dropTable($Table);

            $BaseSQL->Apply();

            if ($BaseSQL->OK()){
                $SuccessMsg = new ErrorMsg("Success", "Table <b>".$Table."</b> deleted");
                $SuccessMsg->render();
            }else{
                $ErrorMsg = new ErrorMsg("Error", "Table <b>".$Table."</b> not deleted");
                $ErrorMsg->render();
            }
        }catch(\Exception $e){
            $ErrorMsg = new ErrorMsg("Error", $e->getMessage());
            $ErrorMsg->render();
        }


            



    }

}
?>
