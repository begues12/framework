<?php

namespace MVC\Views\Projects;

use Engine\Core\Config;
$Config = new Config();

$Config->autoload('ROOT_HTML', 'H1');
$Config->autoload('ROOT_HTML', 'Div');
$Config->autoload('ROOT_WIDGETS', 'ScrollDiv');
$Config->autoload('ROOT_HTML', 'A');
$Config->autoload('ROOT_HTML', 'I');
$Config->autoload('ROOT_HTML', 'Label');
$Config->autoload('FILE_BASEUTILS');

// Que esta mal para que no me recoja el namespace?
// use Engine\Utils\HTML\A;
use Engine\Utils\HTML\Div;
use Engine\Utils\HTML\H1;
use Engine\Utils\Widgets\ScrollDiv;
use Engine\Utils\HTML\I;
use Engine\Utils\HTML\Label;
use Engine\Utils\HTML\A;
use Engine\Core\BaseView;
use Engine\Core\BaseUtils;


class Index extends BaseView{

    public $Projects = array();

    function __construct(){
        parent::__construct();
    }

    public function Prepare()
    {
        $this->Projects = $this->getVar('Projects');

        $Content = new Div();
        $Content->class = "content p-5";
        
        $Project_title_text = new H1();
        $Project_title_text->text = "Projects";
        $Project_title_text->class = "h3 mb-3 font-weight-normal";
        
        $Content->Add($Project_title_text);
        
        // Crea el scroll
        $Scroll = new ScrollDiv();
        $Scroll->class = "scrol m-2 row";
        $Scroll->id = "scroll";
        $Scroll->css = [
            'height' => '2em',
        ];
        
        // Crea el div que contendrá los proyectos
        $ProjectsDiv = new Div();
        $ProjectsDiv->class = "projects col-md-12";
        $ProjectsDiv->id = "projects";
        
        foreach($this->Projects as $Project){
            
            $ProjectsDiv->Add($this->LinkBox($Project));

        }
        
        $Scroll->Add($ProjectsDiv);
        
        $Content->Add($Scroll);
        
        $this->Add($Content);
    
    }

    /*
    *   @param $ProjectName: Name of the project
    *   @return $ProjectsDiv: Div with the project
    */

    private function LinkBox(String $ProjectName)
    {
        $Link_div = new Div();
        $Link_div->class = "col-sm-12";
    
        $Project_link = new A();
        $Project_link->href = $this->Config->get("URL_EDITOR")."&Project=".$ProjectName;
    
        $DivProject = new Div();
        $DivProject->class = "project row border border m-2 p-2";
    
        $Icon_div = new Div();
        $Icon_div->class = "col-sm-1 text-center align-middle";
    
        $Icon = new I();
        $Icon->class = "material-icons mt-auto mb-auto";
        $Icon->text = "folder";
    
        $Icon_div->Add($Icon);
    
        $DivProject->Add($Icon_div);
    
        $Name_div = new Div();
        $Name_div->class = "col-sm-11 text-left align-middle";
    
        $Project_name = new Label();
        $Project_name->text = $ProjectName;
        $Project_name->class = "project-name mt-auto mb-auto";
    
        $Name_div->Add($Project_name);
    
        $DivProject->Add($Name_div);
    
        $Project_link->Add($DivProject);
    
        $Link_div->Add($Project_link);
    
        return $Link_div;

    }

    

}

?>