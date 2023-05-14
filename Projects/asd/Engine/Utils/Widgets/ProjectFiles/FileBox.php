<?php
namespace Engine\Utils\Widgets\ProjectFiles;

require_once "Config.php";
use Engine\Core\Config;

require_once $Config->get('ROOT_HTML')."Div.php";
require_once $Config->get('ROOT_HTML')."Label.php";
require_once $Config->get('ROOT_HTML')."Button.php";
require_once $Config->get('ROOT_HTML')."I.php";

use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\Button;
use Engine\Utils\HTML\I;

class FileBox extends Div{

    public $Config;

    public $FileName;
    public $FilePath;
    public $ProjectPath;
    public $ProjectName;
    public $Type;

    public $Button_File;
    public $I_File;
    public $Label_Name;

    function __construct(String $Type, String $FilePath, String $ProjectName){
        parent::__construct();
        $this->Config = new Config();

        $this->ProjectPath = $this->Config->base;

        $this->class = "text-center grid-item d-inline-block";
        $this->id = "FileBox";
        $this->css = [
            'width' => '6em',
            'height' => '6em',
        ];
        
        $this->FileName = basename($FilePath);
        $this->FilePath = $FilePath;
        $this->Type = $Type;

        $this->Button_File = new Button();
        $this->Button_File->class = "btn bg-transparent";
        $this->Button_File->id = "FileBox";
        $this->Button_File->css = [
            'width' => '6em',
            'height' => '6em',
        ];
        
        $this->Button_File->AddAttribute("data-filepath", $this->FilePath);
        $this->Button_File->AddAttribute("data-url", $this->Config->get('URL_DASHBOARD'));
        $this->Button_File->AddAttribute("data-absolutepath", str_replace("\\", "/", $this->ProjectPath."/".$this->FilePath));
        $this->Button_File->AddAttribute("data-projectname", $ProjectName);

        $this->I_File = new I();
        $this->I_File->class = "material-icons text-center d-block";

        if ($this->Type == "dir"){
            $this->I_File->text = "folder";
            $this->Button_File->onclick = "OpenDirBox(this);";
        }else{
            $this->I_File->text = "insert_drive_file";
            $this->Button_File->onclick = "OpenFileBox(this);";
        }

        $this->Label_Name = new Label();
        $this->Label_Name->class = "text-center";
        $this->Label_Name->text = $this->FileName;

        $Max_length = 9;
        if(strlen($this->Label_Name->text) > $Max_length){
            $this->Label_Name->text = substr($this->Label_Name->text, 0, $Max_length)."...";
        }

        $this->Button_File->Add($this->I_File);
        $this->Button_File->Add($this->Label_Name);

        $this->Add($this->Button_File);
    
    }

}   