<?php
namespace MVC\Controllers\Editor\ProjectFiles;

//Fist load file config
require_once 'Config.php';
use Engine\Core\Config;
$Config = new Config();

//Load all HTML widgets
require_once $Config->get('FILE_BASESQL');
require_once $Config->get('FILE_BASECONTROLLER');
require_once $Config->get('FILE_BASEFTP');
require_once($Config->get('ROOT_WIDGETS')."Alerts\ErrorMsg.php");
require_once($Config->get('ROOT_WIDGETS')."Alerts\ConfirmDeleteMsg.php");
require_once($Config->get('ROOT_WIDGETS')."Alerts\SuccessMsg.php");
require_once $Config->get('ROOT_WIDGETS')."Alerts\InputAlert.php";
require_once $Config->get('ROOT_WIDGETS')."ProjectObjects/FieldTrBd.php";

use Engine\Core\BaseSQL;
use Engine\Core\BaseController;
use Engine\Core\BaseFTP;
use Engine\Utils\Widgets\Alerts\ConfirmDeleteMsg;
use Engine\Utils\Widgets\Alerts\ErrorMsg;
use Engine\Utils\Widgets\Alerts\SuccessMsg;
use Engine\Utils\Widgets\Alerts\InputAlert;
use Engine\Utils\Widgets\ProjectObjects\FieldTrBd;
use Error;
use Exception;

class Index extends BaseController{

    public $data_projectname;
    public $data_projecturl;
    
    public $list_files = array();

    function __construct(){
        parent::__construct();
    }

    public function Prepare()
    {

        $this->data_projecturl = "";
        $this->data_projectname = "";

        if (isset($_POST['data-projectname'])){
            $this->data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg('Error', 'Project name not found');
            $ErrorMsg->render();
            die();
        }

        // Search Files
        if (isset($_POST['data-projecturl'])){
            $this->data_projecturl = $_POST['data-projecturl'];
        }else{
            $ErrorMsg = new ErrorMsg('Error', 'Project URL not found');
            $ErrorMsg->render();
            die();
        }

        // Search in URL for the project name

        $BaseFTP = new BaseFTP();
        $ScanDir = $BaseFTP->listFiles($this->data_projecturl);

        foreach ($ScanDir as $key => $value) {
            $this->list_files[] = $value;
        }

        $this->setVar('data-files', $this->list_files);
        
    }

}