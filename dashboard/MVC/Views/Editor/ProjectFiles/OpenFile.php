<?php
namespace MVC\Views\Editor\ProjectFiles;

require_once "Config.php";

use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('ROOT_HTML')."TextArea.php";
$this->Config->autoload("ROOT_WIDGETS", "Alerts\ErrorMsg");
require_once $Config->get('ROOT_WIDGETS')."Alerts\ErrorMsg.php";
require_once $Config->get('ROOT_HTML')."Pre.php";

use Engine\Core\BaseView;
use Engine\Utils\HTML\TextArea;
use Engine\Utils\Widgets\Alerts\ErrorMsg;
use Engine\Utils\HTML\Pre;

class OpenFile extends BaseView{

    public $data_file;

    public $TextArea_File;

    function __construct(){
        parent::__construct();
        $this->class = "p-2";
        $this->css = [
            "width" => "100%",
            "height" => "100%",
            "display" => "flex",
            "flex-direction" => "column",
        ];
    }

    public function Prepare()
    {   

        if ($this->getVar('data-file')) {
            $this->data_file = $this->getVar('data-file');
        }else{
            $ErrorMsg = new ErrorMsg('Error', 'No file selected');
            $ErrorMsg->render();
            http_response_code(500);
            die();
        }

        $this->TextArea_File = new Pre();
        $this->TextArea_File->id = "file";
        $this->TextArea_File->name = "file";
        $this->TextArea_File->text = $this->data_file;
        $this->TextArea_File->css = [
        ];

        $this->Add($this->TextArea_File);
    }

}



?>