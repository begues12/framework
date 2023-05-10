<?php
namespace MVC\Controllers\Projects;
// Si esta configurado PROJECTS_ROOT en Config.php entonces se muestra todos los proyectos que estan en la carpeta Projects

require_once 'Config.php';
use Engine\Core\Config;
use Engine\Core\BaseController;
use Engine\Core\BasePage;

class Index extends BaseController{

    public $Projects = array();

    function __construct(){
        parent::__construct();

    }

    public function Prepare()
    {
        
        $Projects_dir = scandir($this->Config->get('ROOT_PROJECTS'));

        foreach($Projects_dir as $Project){

            if($Project != "." && $Project != ".."){
                $this->Projects[] = $Project;
            }

        }

        $this->setVar('Projects', $this->Projects);
        $this->BasePage();
    }


    public function Execute()
    {

    }

    public function Finalize()
    {
    }


}


?>