<?php
namespace MVC\Views\Editor\ProjectFiles;

require_once "Config.php";

use Engine\Core\Config;
$Config = new Config();

require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";
require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Input.php";
require_once $Config->get('ROOT_WIDGETS')."ProjectFiles/FileBox.php";
$this->Config->autoload("ROOT_WIDGETS", "Alerts\ErrorMsg");

use Engine\Core\BaseView;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Input;
use Engine\Utils\Widgets\Alerts\ErrorMsg;
use Engine\Utils\Widgets\ProjectFiles\FileBox;

class Index extends BaseView{

    public $data_files;
    
    public $data_projectname;
    public $data_projecturl;
    public $data_underurl;
    public $data_redourl;
    public $HasRedo = false;
    
    public $Div_Actionbar;
    public $Button_UndoUrl;
    public $Button_RedoUrl;
    public $Div_Wrapper;
    public $Input_Url;
    public $Button_SearchUrl;
    public $Div_ShowFiles;
    public $Div_OpenFile;

    function __construct(){
        parent::__construct();
        $this->class = "p-2";

        $this->Div_Actionbar    = new Div();
        $this->Button_UndoUrl   = new Button();
        $this->Button_RedoUrl   = new Button();

        $this->Div_Wrapper      = new Div();
        $this->Input_Url        = new Input();
        $this->Button_SearchUrl = new Button();

        $this->Div_ShowFiles        = new Div();
        $this->Div_OpenFile         = new Div();
    }

    public function Prepare()
    {   

        $this->data_files = $this->getVar('data-files');

        if (isset($_POST['data-projectname'])){
            $this->data_projectname = $_POST['data-projectname'];
        }else{
            $ErrorMsg = new ErrorMsg('Error', 'Project name not found.');
            $ErrorMsg->render();
        }

        if (isset($_POST['data-projecturl'])){
            $this->data_projecturl = $_POST['data-projecturl'];
        }else{
            $ErrorMsg = new ErrorMsg('Error', 'Project url not found.');
            $ErrorMsg->render();
        }

        if (isset($_POST['data-redourl'])){
            $this->data_redourl = $_POST['data-redourl'];
            $this->HasRedo = true;
        }
        
        $this->data_projecturl = $this->Config->get('ROOT_PROJECTS').$this->data_projectname."/";
        $this->data_underurl = $this->undoUrl($this->data_projecturl);

        $this->Div_Actionbar->class = "row flex-row w-100 m-0 p-0";

        $this->Button_UndoUrl->type = "button";
        $this->Button_UndoUrl->class = "btn bg-transparent material-icons d-inline p-2 m-1";
        $this->Button_UndoUrl->text = "undo";
        $this->Button_UndoUrl->onclick = "UndoUrl(this);";
        
        $this->Div_Actionbar->Add($this->Button_UndoUrl);

        $this->Button_RedoUrl->type = "button";
        $this->Button_RedoUrl->class = "btn bg-transparent material-icons d-inline p-2 m-1";
        $this->Button_RedoUrl->text = "redo";
        $this->Button_RedoUrl->onclick = "RedoUrl(this);";

        if (!$this->HasRedo){
            $this->Div_Actionbar->Add($this->Button_RedoUrl);
        }

        $this->Div_Wrapper->class = "input-wrapper d-inline col"; //

        $this->Input_Url->type = "text";
        $this->Input_Url->class = "form-control col pr-4";
        $this->Input_Url->id = "InputUrl";
        $this->Input_Url->placeholder = "Enter url";
        $this->Input_Url->onkeydown = "if (event.keyCode == 13) { InputUrl(this); }";
        $this->Input_Url->value = $this->data_projecturl;
        $this->Input_Url->css = [
            'position' => 'absolute',
            'top' => '50%',
            'right' => '10px',
            'transform' => 'translateY(-50%)',
            'font-size' => '18px',
            'color' => 'gray',
            'cursor' => 'pointer',
            'white-space' => 'nowrap',
            'overflow' => 'hidden',
            'text-overflow' => 'ellipsis',
        ];


        $this->Button_SearchUrl->type = "button";
        $this->Button_SearchUrl->class = "btn bg-transparent material-icons d-inline p-2 m-0";
        $this->Button_SearchUrl->text = "search";
        $this->Button_SearchUrl->onclick = "InputUrl(this);";
        $this->Button_SearchUrl->css = [
            'position' => 'absolute',
            'top' => '50%',
            'right' => '10px',
            'transform' => 'translateY(-50%)',
            'font-size' => '18px',
            'color' => 'gray',
            'cursor' => 'pointer',
        ];

        $this->Div_Wrapper->Add($this->Input_Url);
        $this->Div_Wrapper->Add($this->Button_SearchUrl);

        $this->Div_Actionbar->Add($this->Div_Wrapper);

        $this->Add($this->Div_Actionbar);

        $this->Div_ShowFiles->class = "container-grid m-0 p-0 FileView";
        $this->Div_ShowFiles->id    = "FileView_ShowFiles";

        $this->Div_OpenFile->class = "m-0 p-0 FileView";
        $this->Div_OpenFile->id    = "FileView_OpenFile";

        if (isset($this->data_files['dir'])){
            foreach($this->data_files['dir'] as $file){
                $FileBox = new FileBox('dir', $file, $this->data_projectname);
                $this->Div_ShowFiles->Add($FileBox);
            }
        }
        
        if (isset($this->data_files['file'])){
            foreach($this->data_files['file'] as $file){
                $FileBox = new FileBox('file', $file, $this->data_projectname);
                $this->Div_ShowFiles->Add($FileBox);
            }
        }

        $this->Add($this->Div_ShowFiles);
        $this->Add($this->Div_OpenFile);

    }

    private function undoUrl(String $url){
        $url = explode("/", $url);
        $url = array_slice($url, 0, count($url)-2);
        return implode("/", $url);
    }


}



?>