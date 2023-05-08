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
require_once $Config->get('ROOT_WIDGETS')."Alerts\ErrorMsg.php";
require_once $Config->get('ROOT_WIDGETS')."ProjectObjects\TrProjectObject.php";
require_once $Config->get('ROOT_WIDGETS')."Actionbar.php";

use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Table;
use Engine\Utils\HTML\Tr;
use Engine\Utils\HTML\Th;
use Engine\Utils\HTML\Input;
use Engine\Utils\Widgets\Alerts\ErrorMsg;
use Engine\Utils\Widgets\ProjectObjects\TrProjectObject;
use Engine\Utils\Widgets\Actionbar;


class Index extends BaseView{

    public $data_projectname;
    public $data_tables;

    public $Label_Title;
    public $Actionbar;
    public $Button_Add;

    public $Table_Objects;
    public $Tr_Objects;
    public $Th_Index_Object;
    public $Th_Name_Object;
    public $Th_Actions_Object;

    function __construct(){
        parent::__construct();
        $this->class = "p-2";

        $this->Label_Title          = new Label();

        $this->Actionbar            = new Actionbar();
        $this->Button_Add           = new Button();

        $this->Table_Objects        = new Table();
        $this->Tr_Objects           = new Tr();
        $this->Th_Index_Object      = new Th();
        $this->Th_Name_Object       = new Th();
        $this->Th_Actions_Object    = new Th();
    }

    public function Prepare()
    {   

        $this->data_tables       = $this->getVar('data-tables');
        $this->data_projectname  = $this->getVar('data-projectname');


        $this->SetTitle("Project Objects");

        $this->Add($this->Label_Title);

        $this->Button_Add->class    = "btn bg-transparent material-icons";
        $this->Button_Add->text     = "add";
        $this->Actionbar->AddElement($this->Button_Add);

        $this->Add($this->Actionbar);

        $this->Table_Objects->class = "table table-striped table-light table-hover mt-3 ml-auto mr-auto";
        $this->Table_Objects->css   = [
            'max-width' => '50em',
        ];

        $this->Tr_Objects->class    = "thead-light";

        $this->Th_Index_Object->class   = "text-center";
        $this->Th_Index_Object->text    = "#";

        $this->Th_Name_Object->class    = "text-center";
        $this->Th_Name_Object->text     = "Nombre";

        $this->Th_Actions_Object->class = "text-center";
        $this->Th_Actions_Object->text  = "Accions";

        $this->Tr_Objects->Add($this->Th_Index_Object);
        $this->Tr_Objects->Add($this->Th_Name_Object);
        $this->Tr_Objects->Add($this->Th_Actions_Object);

        $this->Table_Objects->Add($this->Tr_Objects);

        foreach ($this->data_tables[0]['Rows'] as $key => $table) {
        
            $ObjectName         = $table['Tables_in_'.$this->data_projectname];
            $TrProjectObject    = new TrProjectObject($key, $ObjectName, $this->data_projectname);
        
            $this->Table_Objects->Add($TrProjectObject->Copy());
        }

        $this->Add($this->Table_Objects);

    }


}





?>