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

    public $Button_File;
    public $I_File;
    public $Label_Name;

    function __construct(String $FilePath){
        parent::__construct();
        $this->Config = new Config();
        $this->class = "p-2 text-center";
        $this->id = "FileBox";
        
        $this->FileName = basename($FilePath);
        $this->FilePath = $FilePath;

        $this->Button_File = new Button();
        $this->Button_File->class = "btn bg-transparent";
        $this->Button_File->id = "FileBox";
        $this->Button_File->css = [
            'width' => '6em',
            'height' => '6em',
        ];
        
        $this->Button_File->AddAttribute("data-filepath", $this->FilePath);
        $this->Button_File->AddAttribute("data-filename", $this->FileName);

        $this->I_File = new I();
        $this->I_File->class = "material-icons text-center d-block";

        if (is_dir($this->FilePath)) {
            $this->I_File->text = "folder";
        }else{
            $this->I_File->text = "insert_drive_file";
        }

        $this->Label_Name = new Label();
        $this->Label_Name->class = "text-center";
        $this->Label_Name->text = $this->FileName;

        //Si se pasa de 20 caracteres, se corta y se agrega "..."
        $Max_length = 15;
        if(strlen($this->Label_Name->text) > $Max_length){
            $this->Label_Name->text = substr($this->Label_Name->text, 0, $Max_length)."...";
        }

        $this->Button_File->Add($this->I_File);
        $this->Button_File->Add($this->Label_Name);

        $this->Add($this->Button_File);
    
    }


}   