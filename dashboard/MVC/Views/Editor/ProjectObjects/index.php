<?php
namespace MVC\Views\Editor\ProjectObjects;

require_once "Config.php";

use Engine\Core\Config;
$Config = new Config();

use Engine\Core\BaseView;

require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Input.php";
require_once $Config->get('ROOT_HTML')."Table.php";
require_once $Config->get('ROOT_HTML')."Tr.php";
require_once $Config->get('ROOT_HTML')."Th.php";
require_once $Config->get('ROOT_WIDGETS')."ErrorMsg.php";
require_once $Config->get('ROOT_WIDGETS')."ProjectObjects\TrProjectObject.php";

use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Table;
use Engine\Utils\HTML\Tr;
use Engine\Utils\HTML\Th;
use Engine\Utils\HTML\Input;
use Engine\Utils\Widgets\ErrorMsg;
use Engine\Utils\Widgets\ProjectObjects\TrProjectObject;


class Index extends BaseView{

    public $ProjectName;
    public $Tables;

    function __construct(){
        parent::__construct();
    }

    public function Prepare()
    {   

        $this->Tables = $this->getVar('Tables');
        $this->ProjectName = $this->getVar('ProjectName');

        $Label_Title = new Label();
        $Label_Title->class = "form-control-label font-weight-bold h3 border-bottom d-block";
        $Label_Title->text = "Project Objects";

        $this->Add($Label_Title);

        $Table_Objects = new Table();
        $Table_Objects->class = "table table-striped table-light table-hover mt-3";

        $Tr_Objects = new Tr();
        $Tr_Objects->class = "thead-light";

        $Th_Index_Object = new Th();
        $Th_Index_Object->class = "text-center";
        $Th_Index_Object->text = "#";

        $Th_Name_Object = new Th();
        $Th_Name_Object->class = "text-center";
        $Th_Name_Object->text = "Nombre";

        $Th_Actions_Object = new Th();
        $Th_Actions_Object->class = "text-center";
        $Th_Actions_Object->text = "Accions";

        $Tr_Objects->Add($Th_Index_Object);
        $Tr_Objects->Add($Th_Name_Object);
        $Tr_Objects->Add($Th_Actions_Object);

        $Table_Objects->Add($Tr_Objects);

        foreach ($this->Tables[0]['Rows'] as $key => $table) {
        
            $ObjectName = $table['Tables_in_'.$this->ProjectName];
            $TrProjectObject = new TrProjectObject($key, $ObjectName, $this->ProjectName);
            $Table_Objects->Add($TrProjectObject->Copy());
        }

        $this->Add($Table_Objects);

    }


}





?>