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

class OpenFile extends BaseController{

    public $data_filePath;
    public $data_absolutefilepath;
    
    public $list_files = array();

    function __construct(){
        parent::__construct();
        $this->data_filePath = "";
        $this->data_absolutefilepath = "";

          // Search Files
          if (isset($_POST['data-filePath'])){
            $this->data_filePath = $_POST['data-filePath'];
        }else{
            $ErrorMsg = new ErrorMsg('Error', 'File path not found');
            $ErrorMsg->render();
            die();
        }

        // Search Files
        if (isset($_POST['data-absolutepath'])){
            $this->data_absolutefilepath = $_POST['data-absolutepath'];
        }else{
            $ErrorMsg = new ErrorMsg('Error', 'Absolute file path not found');
            $ErrorMsg->render();
            die();
        }
    }

    public function Prepare()
    {

        // Search in URL for the project name
        if(file_exists($this->data_absolutefilepath)){
            $fileContent = \file_get_contents($this->data_absolutefilepath);
        } else{
            $ErrorMsg = new ErrorMsg('Error', 'File not found '.$this->data_absolutefilepath);
            $ErrorMsg->render();
            die();
        }

        $this->setVar('data-file', $fileContent);

    }

}